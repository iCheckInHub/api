<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class MenuItem extends Model
{
  use HasUuids, HasFactory;

  protected $table = 'menus';

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

  public function menu(): BelongsTo
  {
    return $this->belongsTo(Menu::class, 'parent_id', 'id');
  }

  public function services(): HasMany
  {
    return $this->hasMany(MenuService::class, 'menu_id', 'id');
  }
}
