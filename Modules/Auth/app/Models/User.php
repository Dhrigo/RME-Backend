<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Database\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_locked',
        'is_active',
        'active_until',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_locked' => 'boolean',
            'is_active' => 'boolean',
            'active_until' => 'date',
            'password_changed_at' => 'datetime',
        ];
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
