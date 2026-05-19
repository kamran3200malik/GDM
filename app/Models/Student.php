<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
        'class',
        'place_of_birth',
        'image',
        'nationality',
        'religion',
        'bloodgroup',
        'polio_vaccination',
        'is_active',
    ];

    protected $casts = [
        'dob' => 'date',
        'is_active' => 'boolean',
        'class' => 'string',
        'bloodgroup' => 'string',
        'polio_vaccination' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function currentAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type', 'current');
    }

    public function permanentAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type', 'permanent');
    }

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function primaryContact()
    {
        return $this->morphOne(Contact::class, 'contactable')->where('is_primary', true);
    }

    public function admissionDetail(): HasOne
    {
        return $this->hasOne(StudentAdmissionDetail::class);
    }

    public function transport(): HasOne
    {
        return $this->hasOne(StudentTransport::class);
    }

    public function leavingDetail(): HasOne
    {
        return $this->hasOne(StudentLeavingDetail::class);
    }

    public function guardianDetail(): MorphOne
    {
        return $this->morphOne(GuardianDetail::class, 'personalable');
    }

    public function getFullNameAttribute(): string
    {
        return $this->student_name;
    }
}
