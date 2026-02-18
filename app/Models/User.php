<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Trabajador;

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
        'password',
        'role',
        'profile_photo_path',
    ];

    public function profilePhotoUrl(): ?string
    {
        if (!$this->profile_photo_path) {
            return null;
        }

        return asset('storage/' . ltrim($this->profile_photo_path, '/'));
    }

    public function trabajador(): HasOne
    {
        return $this->hasOne(Trabajador::class, 'user_id', 'id');
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }

    public function isUsuario()
    {
        return $this->role === 'usuario';
    }

    /**
     * Permite borrar backups solo al superadmin
     */
    public function canDeleteBackups()
    {
        return $this->isSuperAdmin();
    }

    /**
     * Permite borrar usuarios, excepto el superadmin principal
     */
    public function canDeleteUser(User $user)
    {
        // No se puede borrar al superadmin principal (id=1 por ejemplo)
        if ($user->isSuperAdmin() && $user->id === 1) {
            return false;
        }
        // Solo superadmin y admin pueden borrar, pero nunca al superadmin principal
        return $this->isSuperAdmin() || ($this->isAdmin() && !$user->isSuperAdmin());
    }

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
}
