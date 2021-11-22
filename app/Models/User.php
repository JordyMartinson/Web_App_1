<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function posts()
    {
        return $this -> hasMany('App\Models\Post');
    }

    public function comments()
    {
        return $this -> hasMany('App\Models\Comment');
    }
}