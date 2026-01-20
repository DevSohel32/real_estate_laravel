<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;
     protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phone',
        'company',
        'designation',
        'biography',
        'address',
        'country',
        'state',
        'city',
        'zip',
        'website',
        'facebook',
        'linkedin',
        'twitter',
        'instagram',
        'token',
        'status',
    ];
     protected $hidden = [
        'password',
        'remember_token',
    ];
}
