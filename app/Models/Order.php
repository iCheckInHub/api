<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
  use HasUuids, HasFactory;

  public function place(): BelongsTo
  {
    return $this->belongsTo(Place::class, 'place_id', 'id');
  }

  public function items(): HasMany
  {
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
  }
}
