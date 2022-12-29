<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MenuServiceExtraOption extends Model
{
  use HasUuids, HasFactory;

  /**
   * The "booting" method of the model.
   * @return void
   */
  public static function booted()
  {

    /**
     * Add place_id to MenuServiceExtraOption was created
     * @var MenuServiceExtraOption $item
     */
    static::creating(function ($item) {
      $item->place_id = $item->extra->place_id;
    });
  }

  public function extra()
  {
    return $this->belongsTo(MenuServiceExtra::class, 'extra_id', 'id');
  }
}
