<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgBuilderDirective;

final class WhereRelationDirective extends BaseDirective implements ArgBuilderDirective
{

  public function handleBuilder($builder, $value)
  {
    if (!$value) return $builder;

    return $builder->whereRelation(
      $this->directiveArgValue('relation'),
      $this->directiveArgValue('key', $this->nodeName()),
      $this->directiveArgValue('operator', '='),
      $value
    );
  }


  public static function definition(): string
  {
    return
      /** @lang GraphQL */
      <<<'GRAPHQL'
"""
Use an input value as a [where filter](https://laravel.com/docs/queries#where-clauses).
"""
directive @whereRelation(
  """
  Specify the operator to use within the WHERE condition.
  """
  operator: String = "="

  """
  Specify the database column to compare.
  Only required if database column has a different name than the attribute in your schema.
  """
  key: String

  """
  Relation name with the model.
  """
  relation: String
) repeatable on ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION
GRAPHQL;
  }
}
