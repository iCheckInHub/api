<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Place extends Model
{
  use HasUuids, HasFactory;

  public function menus()
  {
    return $this->hasMany(Menu::class, 'place_id', 'id');
  }

  public function scopeOfEmployee(Builder $query, array $args)
  {
    return $query->whereIn('id', Auth::user()->placeIds);
  }

  public function employees(): BelongsToMany
  {
    return $this->belongsToMany(Employee::class, 'employee_place', 'place_id', 'employee_id');
  }
}
