<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'machine_number',
        'caste',
        'phone',
        'role',
        'employee_payments',
        'joining_date',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('work_type')
            ->withTimestamps();
    }

    public function works(): HasMany
    {
        return $this->hasMany(EmployeeWork::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(EmployeePayment::class);
    }

    public function getTotalEarnedAttribute()
    {
        return $this->works()->sum('amount');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return $this->total_earned - $this->total_paid;
    }
}
