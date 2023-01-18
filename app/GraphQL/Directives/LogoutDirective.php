<?php

namespace App\GraphQL\Directives;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\ArgDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgResolver;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class LogoutDirective extends BaseDirective implements FieldResolver
{

  public function resolveField(FieldValue $fieldValue)
  {
    $fieldValue->setResolver(function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): ?Model {

      $guard = Auth::guard($this->directiveArgValue('guard', 'web'));

      /** @var \App\Models\Employee|null $user */
      $user = $guard->user();
      $user->tokens()->delete();
      return $user;
    });

    return $fieldValue;
  }
  // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html

  public static function definition(): string
  {
    return '';
    //         return /** @lang GraphQL */ <<<'GRAPHQL'
    // directive @logout on ARGUMENT_DEFINITION
    // GRAPHQL;
  }
}
