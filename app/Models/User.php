<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'fonction',
        'profile_picture',
        'is_admin',
        'is_active',
        'last_login_at',
        'password',
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
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function hasPermission(string $permission): bool
    {
        if (($this->is_admin ?? false) && in_array($this->role, ['super_admin', 'admin'], true)) {
            return true;
        }

        $roleName = $this->role ?: null;
        if (!$roleName) {
            return false;
        }

        $role = Role::query()->where('name', $roleName)->where('is_active', true)->first();
        if (!$role) {
            return false;
        }

        $permissions = is_array($role->permissions) ? $role->permissions : [];

        return in_array($permission, $permissions, true);
    }

    public function articles()
    {
        return $this->hasMany(BlogPost::class);
    }
}
