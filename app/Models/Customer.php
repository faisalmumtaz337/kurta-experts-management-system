<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
  use Searchable;

  protected $fillable = [
    'customer_number',
    'name',
    'caste',
    'phone',
    'address',
    'profile_image'
  ];

  // Default profile image
  const DEFAULT_PROFILE_IMAGE = 'profile_images/avatar.png';

  // Customer global search logic
  public function scopeSearch($query, $search)
  {
    return $query->where(function ($q) use ($search) {
      $q->where('name', 'like', "%{$search}%")
        ->orWhere('caste', 'like', "%{$search}%")
        ->orWhere('phone', 'like', "%{$search}%")
        ->orWhere('customer_number', 'like', "%{$search}%");
    });
  }

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class);
  }

  public function measurement(): HasOne
  {
    return $this->hasOne(Measurement::class);
  }

  public function payments(): HasMany
  {
    return $this->hasMany(Payment::class);
  }
}
