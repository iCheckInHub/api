<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
  use HasUuids, HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'birthday' => 'date',
  ];


  public function scopeHasPlace(Builder $query, array $args)
  {

    DB::enableQueryLog();
    $placeIds = Auth::user()->placeIds;
    $query->whereRelation('places', fn ($place) => $place->whereIn('id', $placeIds));
    DB::getQueryLog();
  }

  /**
   * Get the place's ids of employee.
   *
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function placeIds(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => $this->places()->allRelatedIds()->toArray(),
      // set: fn ($value) => $this->places()->sync($value),
    );
  }

  public function setPlaceIdsAttribute($value)
  {
    return $this->places()->sync($value);
  }


  public function places(): BelongsToMany
  {
    return $this->belongsToMany(Place::class, 'employee_place', 'employee_id', 'place_id');
  }
}
