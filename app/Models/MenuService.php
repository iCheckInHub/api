<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MenuService extends Model
{
  use HasUuids, HasFactory;


  /**
   * The "booting" method of the model.
   * @return void
   */
  protected static function booted()
  {
    /**
     * Add place_id to MenuService was created
     * @var MenuService $item
     */
    static::creating(function ($item) {
      $item->place_id = $item->menu->place_id;
    });
  }


  public function scopeHasPlace(Builder $query, array $args)
  {
    $placeIds = Auth::user()->placeIds;
    $query->whereIn('place_id', $placeIds);
  }

  public function menu()
  {
    return $this->belongsTo(Menu::class, 'menu_id', 'id');
  }

  public function extras()
  {
    return $this->hasMany(MenuServiceExtra::class, 'service_id', 'id');
  }

  public function options()
  {
    return $this->hasManyThrough(MenuServiceExtraOption::class, MenuServiceExtra::class, 'service_id', 'extra_id', 'id', 'id');
  }
}
