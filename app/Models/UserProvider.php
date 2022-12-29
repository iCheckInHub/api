<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{
  use HasFactory;

  protected $fillable = [
    'id',
    'provider',
    'name',
    'email',
    'avatar',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
