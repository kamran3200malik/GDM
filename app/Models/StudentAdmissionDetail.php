<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAdmissionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'admission_date',
        'admission_year',
        'admission_type',
        'admission_class',
        'admission_section_id',
        'prospectus_issued',
        'card_generated_date',
        'previous_school',
        'admission_notes',
    ];

    protected $casts = [
        'admission_date' => 'date',
        'card_generated_date' => 'date',
        'prospectus_issued' => 'boolean',
        'admission_type' => 'string',
        'admission_class' => 'string',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function admissionSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'admission_section_id');
    }
}
