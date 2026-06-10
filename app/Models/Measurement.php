<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    protected $fillable = [
        'customer_id',
        'length_type',
        'length_value',
        'length_cotton',
        'length_washing_wear',
        'shoulder',
        'shoulder_type',
        'chest',
        'waist',
        'hips',
        'sleeve',
        'cuff_type',
        'cuff',
        'front_pati',
        'collar',
        'collar_nok',
        'pacho_extra',
        'pocket_style',
        'extra_pocket_style',
        'front_pati_length',
        'cover_pati',
        'sherwani',
        'collar_value',
        'suit_type',
        'khasi',
        'shirt_type',
        'shalwar_value',
        'shalwar_type',
        'aasam',
        'ankle_opening_value',
        'ankle_type',
        'sewing_type',
        'notes',
        'cuff_single',
        'cuff_double',
        'golpati',
        'golkani',
        'chhati',
        'extra_request_waist',
        'pocket_type',
        'pocket_size',
        'extra_request_pocket',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
