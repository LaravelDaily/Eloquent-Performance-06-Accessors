<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function networks()
    {
        return $this->hasMany(Network::class);
    }

    public function ghosts()
    {
        return $this->hasMany(Ghost::class);
    }

    public function getIdentityAttribute()
    {
        if ($this->is_full_identified()) {
            return 1;
        }
        elseif ($this->is_ghost()) {
            return 3;
        }
        else return 0;
    }

    public function is_full_identified()
    {
        return $this->networks->isNotEmpty() || (!is_null($this->name) && !is_null($this->phone));
    }

    /**
     * Spécifie si un utilisateur est juste un ghost
     * @return bool
     */
    public function is_ghost()
    {
        return $this->ghosts->isNotEmpty() && is_null($this->email) && $this->networks->isEmpty();
    }


}
