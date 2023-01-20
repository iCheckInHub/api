<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class OrderItem extends Model
{
  use HasUuids, HasFactory;

  protected $casts = [
    'optionIds' => AsArrayObject::class,
    'data' => 'object',
  ];

  protected function data(): Attribute
  {
    return new Attribute(
      get: fn ($value) => json_decode($value, true),
    );
  }

  protected $touches = ['order'];
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
    static::creating(function (OrderItem $item) {
      $item->place_id = $item->order->place_id;

      $service = $item->service;
      $options = $service->options->whereIn('id', $item->optionIds);

      $item->data = [
        'service' => $service->only(['id', 'name', 'price', 'image', 'duration']),
        'options' => $options->map->only(['id', 'name', 'price', 'image', 'duration']),
      ];
      $item->duration = $service->duration + $options->sum('duration');
      $item->price = $service->price + $options->sum('price');
    });

    static::saved(function (OrderItem $item) {
      $item->order()->update(['total' => $item->order->items->sum('total')]);
    });
  }

  /**
   * Interact with the user's address.
   *
   * @return  \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function total(): Attribute
  {
    return Attribute::make(
      get: fn ($value, $attributes) => $attributes['price'] * $attributes['quantity'],
    );
  }

  public function order(): BelongsTo
  {
    return $this->belongsTo(Order::class, 'order_id', 'id');
  }

  public function employee(): BelongsTo
  {
    return $this->belongsTo(Employee::class, 'employee_id', 'id');
  }

  public function service(): BelongsTo
  {
    return $this->belongsTo(MenuService::class, 'service_id', 'id');
  }
}
