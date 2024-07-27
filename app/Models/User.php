<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipe_user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function Penanganan()
    {
        return $this->belongsToMany(Penanganan::class, 'penanganan_user_pivot');
    }
    public function isTenantRelation()
    {
        return $this->usertype === 'tr';
    }

    public function isAssignedPelaksana($penanganan)
    {
        return $penanganan->users->contains($this->id);
    }
    public function Pemilik()
    {
        return $this->hasOne(Pemilik::class, 'user_id');
    }
    public function Penyewa()
    {
        return $this->hasOne(Penyewa::class, 'user_id');
    }
    public function tipeUser()
    {
        return $this->belongsTo(TipeUser::class, 'tipe_user_id');
    }
}
