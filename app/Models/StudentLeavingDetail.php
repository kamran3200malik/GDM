<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentLeavingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date_left',
        'slc_no',
        'reason',
        'note',
        'leaving_type',
        'transferred_to',
    ];

    protected $casts = [
        'date_left' => 'date',
        'leaving_type' => 'string',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
