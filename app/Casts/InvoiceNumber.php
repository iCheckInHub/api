<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Log;

class InvoiceNumber implements CastsAttributes
{
  /**
   * Cast the given value.
   *
   * @param  \Illuminate\Database\Eloquent\Model  $model
   * @param  string  $key
   * @param  mixed  $value
   * @param  array  $attributes
   * @return mixed
   */
  public function get($model, string $key, $value, array $attributes)
  {
    return $model->created_at->format('Y') . str_pad($value, 6, 0, STR_PAD_LEFT);
  }

  /**
   * Prepare the given value for storage.
   *
   * @param  \Illuminate\Database\Eloquent\Model  $model
   * @param  string  $key
   * @param  mixed  $value
   * @param  array  $attributes
   * @return mixed
   */
  public function set($model, string $key, $value, array $attributes)
  {
    return $value;
  }
}
