<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
  use Searchable;

  protected $fillable = [
    'order_number',
    'customer_id',
    'measurement_snapshot',
    'total_amount',
    'status',
    'suit_quantity',
    'is_urgent',
    'notes',
    'order_date',
    'delivery_date'
  ];

  public array $selectionSearchColumns = [
    'order_number',
  ];

  protected $casts = [
    'measurement_snapshot' => 'array',
  ];

  public function getRemainingAmountAttribute()
  {
    return $this->total_amount - $this->paid_amount;
  }

  public function getPaidAmountAttribute()
  {
    return $this->payments()->sum('amount');
  }

  public function customer(): BelongsTo
  {
    return $this->belongsTo(Customer::class);
  }

  public function employees(): BelongsToMany
  {
    return $this->belongsToMany(Employee::class)
      ->withPivot('work_type')
      ->withTimestamps();
  }

  public function employeePayments(): HasMany
  {
    return $this->hasMany(EmployeePayment::class);
  }

  public function payments(): HasMany
  {
    return $this->hasMany(Payment::class);
  }
}
