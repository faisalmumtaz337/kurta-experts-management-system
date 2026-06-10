<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use Searchable;

    protected $searchable = [
        'amount',
        'payment_method',
        'payment_type',
    ];

    protected $searchableRelations = [
        'order' => ['order_number'],
        'customer' => ['name', 'phone']
    ];

    protected $fillable = [
        'order_id',
        'customer_id',
        'amount',
        'payment_method',
        'payment_type',
        'payment_date',
        'notes',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
