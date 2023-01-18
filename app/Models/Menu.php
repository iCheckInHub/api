<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Menu extends Model
{
  use HasUuids, HasFactory;


  /**
   * The "booted" method of the model.
   *
   * @return void
   */
  protected static function booted()
  {
    static::created(function ($item) {
      Log::info('Menu created 1: ' . $item);
    });
  }

  public function scopeHasPlace(Builder $query, array $args)
  {
    $placeIds = Auth::user()->placeIds;
    $query->whereIn('place_id', $placeIds);
  }


  public function items(): HasMany
  {
    return $this->hasMany(MenuItem::class, 'parent_id', 'id');
  }

  /**
   * Scope a query to only include popular users.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeParentIsNull($query)
  {
    return $query->whereNull('parent_id');
  }
}
