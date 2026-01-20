<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;
    //  protected $fillable = [
    //     'name',
    //     'email',
    //     'photo',
    //     'password',
    //     'phone',
    //     'address',
    //     'country',
    //     'state',
    //     'city',
    //     'zip',
    //     'token',
    //     'status',
    // ];
    //  protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
}
