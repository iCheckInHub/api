<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MenuServiceExtra extends Model
{
  use HasUuids, HasFactory;

  /**
   * The "booting" method of the model.
   * @return void
   */
  public static function booted()
  {

    /**
     * Add place_id to MenuServiceExtra was created
     * @var MenuServiceExtra $item
     */
    static::creating(function ($item) {
      $item->place_id = $item->service->place_id;
    });
  }

  public function service()
  {
    return $this->belongsTo(MenuService::class, 'service_id', 'id');
  }

  public function options()
  {
    return $this->hasMany(MenuServiceExtraOption::class, 'extra_id', 'id');
  }
}
