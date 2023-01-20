<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProvider extends Model
{
  use HasFactory;

  protected $fillable = [
    'id',
    'provider',
    'name',
    'email',
    'avatar',
  ];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }
}
