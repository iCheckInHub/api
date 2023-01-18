<?php

namespace App\GraphQL\Directives;

use GraphQL\Error\Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LoginDirective extends BaseDirective implements FieldResolver
{
  public function resolveField(FieldValue $fieldValue): FieldValue
  {


    $fieldValue->setResolver(function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): ?Model {
      // \DB::enableQueryLog(); // Enable query log

      // $keyname = $this->directiveHasArgument('key') ? $this->directiveArgValue('key') : 'username';

      // $query = $this->getModelClass()::query()->where($keyname, $args[$keyname]);

      $account = $resolveInfo
        ->enhanceBuilder(
          $this->getModelClass()::query(),
          $this->directiveArgValue('scopes', [])
        )
        ->first();

      // dd($account);
      // dd(\DB::getQueryLog()); // Show results of log
      if (!$account || !Hash::check($args['password'], $account->password)) {
        throw new Error('Login information is incorrect');
      }

      $account->token = $account->createToken('authToken')->plainTextToken;

      return $account;
    });

    return $fieldValue;
  }

  public static function definition(): string
  {
    return '';
    //     return
    //       /** @lang GraphQL */
    //       <<<'GRAPHQL'
    // directive @login on ARGUMENT_DEFINITION
    // GRAPHQL;
  }
}
