<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

  public function menu()
  {
    return $this->belongsTo(Menu::class, 'menu_id', 'id');
  }

  public function extras()
  {
    return $this->hasMany(MenuServiceExtra::class, 'service_id', 'id');
  }
}
