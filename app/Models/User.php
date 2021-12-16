<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function posts()
    {
        return $this -> hasMany('App\Models\Post');
    }

    public function comments()
    {
        return $this -> hasMany('App\Models\Comment');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasRoles($role)
    {
        return null !== $this->roles()->whereIn('name', $role)->first();
    }
}
