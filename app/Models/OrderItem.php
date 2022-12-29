<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class OrderItem extends Model
{
  use HasUuids, HasFactory;

  protected $casts = [
    'optionIds' => AsArrayObject::class,
  ];

  /**
   * The "booting" method of the model.
   * @return void
   */
  public static function booted()
  {
    /**
     * Add place_id to OrderItem was created
     * @var OrderItem $item
     */
    static::creating(function ($item) {
      $item->place_id = $item->order->place_id;
    });
  }

  public function order()
  {
    return $this->belongsTo(Order::class, 'order_id', 'id');
  }

  public function service()
  {
    return $this->belongsTo(MenuService::class, 'service_id', 'id');
  }
}
