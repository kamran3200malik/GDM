<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'service_number',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Get the role that owns the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Check if user is superadmin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role?->name === 'superadmin';
    }
    
    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role?->name === 'admin';
    }
    
    /**
     * Check if user is teacher
     */
    public function isTeacher(): bool
    {
        return $this->role?->name === 'teacher';
    }
    
    /**
     * Get user role label
     */
    public function getRoleLabel(): string
    {
        return $this->role?->display_name ?? 'Unknown';
    }
    
    /**
     * Get user role color
     */
    public function getRoleColor(): string
    {
        return $this->role?->color ?? '#6B7280';
    }
}
