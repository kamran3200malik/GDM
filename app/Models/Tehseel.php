<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tehseel extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
