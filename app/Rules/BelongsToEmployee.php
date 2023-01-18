<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class BelongsToEmployee implements InvokableRule
{
  /**
   * Run the validation rule.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   * @return void
   */
  public function __invoke($attribute, $value, $fail)
  {

    if (!Auth::guard('employee')->check()) {
      throw new AuthenticationException(
        AuthenticationException::MESSAGE,
        ['employee']
      );
    }

    if (!$value) return;

    // Work with complex input types like whereHasCondition
    if (is_array($value) && array_key_exists('column', $value) && array_key_exists('value', $value)) {
      $value = $value['value'];
    }

    $value = is_array($value) ? $value : [$value];

    $placeIds = Auth::guard('employee')->user()->placeIds;

    if (array_diff($value, $placeIds)) {
      $fail('The selected place is invalid.');
    }
  }
}
