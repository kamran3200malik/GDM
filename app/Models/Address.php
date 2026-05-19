<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'address_type',
        'colony',
        'address',
        'city',
        'district_id',
        'tehseel_id',
        'province_id',
        'postal_code',
    ];

    protected $casts = [
        'address_type' => 'string',
        'colony' => 'string',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function tehseel(): BelongsTo
    {
        return $this->belongsTo(Tehseel::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
