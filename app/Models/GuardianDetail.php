<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class GuardianDetail extends Model
{
    use HasFactory;

    protected $table = 'gaurdian_details';

    protected $fillable = [
        'personalable_id',
        'personalable_type',
        'category',
        'pak_no',
        'cnic_number',
        'unit_id',
        'trade_id',
        'section',
        'rank_id',
    ];

    protected $casts = [
        'category' => 'string',
    ];

    public function personalable(): MorphTo
    {
        return $this->morphTo();
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function trade(): BelongsTo
    {
        return $this->belongsTo(Trade::class);
    }


    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }
}
