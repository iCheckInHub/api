<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProvider;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class Authcontroller extends Controller
{
  /**
   * Redirect the user to the Provider authentication page.
   *
   * @param $provider
   * @return JsonResponse
   */
  public function redirectToProvider()
  {
    return [
      'google' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
      'facebook' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl()
    ];
    // $validated = $this->validateProvider($provider);
    // if (!is_null($validated)) {
    //   return $validated;
    // }
    // return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    // return Socialite::driver($provider)->redirect()->getTargetUrl();
  }

  /**
   * Obtain the user information from Provider.
   *
   * @param $provider
   * @return JsonResponse
   */
  public function handleProviderCallback($provider)
  {
    $validated = $this->validateProvider($provider);
    if (!is_null($validated)) {
      return $validated;
    }

    Log::info($provider);

    try {
      $socialiteAccount = Socialite::driver($provider)->stateless()->user();
    } catch (ClientException $exception) {
      Log::error($exception);
      return response()->json(['error' => 'Invalid credentials provided.'], 422);
    }

    $userProvider = UserProvider::firstOrNew(
      [
        'id' => $socialiteAccount->getId(),
        'provider' => $provider,
      ],
      [
        'name' => $socialiteAccount->getName(),
        'avatar' => $socialiteAccount->getAvatar(),
        'email' => $socialiteAccount->getEmail(),
      ]
    );

    $user = null;
    if (!$userProvider->user_id) {
      $user = User::firstOrCreate(
        [
          'email' => $userProvider->email,
        ],
        [
          'name' => $userProvider->name,
          'avatar' => $userProvider->avatar,
          'password' => bcrypt(Str::random(10)),
        ]
      );
      $user->providers()->save($userProvider);
    } else {
      $user = $userProvider->user;
    }

    $token = $user->createToken('token-name')->plainTextToken;
    return response()->json(['token' => $token]);
    // return response()->json($user, 200, ['Access-Token' => $token]);
  }

  /**
   * @param $provider
   * @return JsonResponse
   */
  protected function validateProvider($provider)
  {
    if (!in_array($provider, ['facebook', 'github', 'google'])) {
      return response()->json(['error' => 'Please login using facebook, github or google'], 422);
    }
  }
}
