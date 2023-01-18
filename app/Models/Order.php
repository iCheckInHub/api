<?php

namespace App\Models;

use App\Casts\InvoiceNumber;
use Faker\Core\Number;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Double;

class Order extends Model
{
  use HasUuids, HasFactory;

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'no' => InvoiceNumber::class,
  ];

  public function scopeHasPlace(Builder $query, array $args)
  {
    $placeIds = Auth::user()->placeIds;
    $query->whereIn('place_id', $placeIds);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function place(): BelongsTo
  {
    return $this->belongsTo(Place::class, 'place_id', 'id');
  }

  public function items(): HasMany
  {
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
  }
}
