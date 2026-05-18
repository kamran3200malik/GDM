<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_number',
        'student_name',
        'father_name',
        'mother_name',
        'dob',
        'gender',
        'bloodgroup',
        'unit_id',
        'admission_type',
        'class',
        'pak_no',
        'trade_id',
        'section_id',
        'religion_id',
        'rank_id',
        'admission_class',
        'admission_section_id',
        'office_phone',
        'whatsapp_no',
        'mobile_no',
        'address',
        'category',
        'admission_date',
        'student_group',
        'using_van',
        'place_of_birth',
        'admission_year',
        'directress',
        'reason',
        'devices_health_issues',
        'note',
        'polio_vaccination',
        'grandparents_alive',
        'prospectus_issued',
        'date_left',
        'slc_no',
        'stu_image',
        'card_generated_date',
        'is_active',
    ];

    protected $casts = [
        'dob' => 'date',
        'admission_date' => 'date',
        'date_left' => 'date',
        'card_generated_date' => 'date',
        'using_van' => 'boolean',
        'devices_health_issues' => 'boolean',
        'polio_vaccination' => 'boolean',
        'grandparents_alive' => 'boolean',
        'prospectus_issued' => 'boolean',
        'is_active' => 'boolean',
        'bloodgroup' => 'string',
        'admission_type' => 'string',
        'class' => 'string',
        'admission_class' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function trade(): BelongsTo
    {
        return $this->belongsTo(Trade::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function admissionSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'admission_section_id');
    }

    public function getFullNameAttribute(): string
    {
        return $this->student_name;
    }
}
