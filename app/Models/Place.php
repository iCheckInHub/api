<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
  use HasUuids, HasFactory;

  public function menus()
  {
    return $this->hasMany(Menu::class, 'place_id', 'id');
  }
}
