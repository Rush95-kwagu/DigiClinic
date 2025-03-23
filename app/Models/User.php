<?php

namespace App\Models;

use App\Models\Service;
use Laravel\Sanctum\HasApiTokens;
use App\Models\DepartementGenerale;
use App\Models\DepartementSpeciale;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role_id'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function DepartementGenerale()
    {
        return $this ->belongsTo(DepartementGenerale::class);
    }

    public function DepartementSpeciale()
    {
        return $this->belongsTo(DepartementSpeciale::class);
    }

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}