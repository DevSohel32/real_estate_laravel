<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function package()
    {

        return $this->hasMany(Package::class);
        
        }
    public function property()
    {
        return $this->hasMany(Property::class);
    }


    //  protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'photo',
    //     'phone',
    //     'company',
    //     'designation',
    //     'biography',
    //     'address',
    //     'country',
    //     'state',
    //     'city',
    //     'zip',
    //     'website',
    //     'facebook',
    //     'linkedin',
    //     'twitter',
    //     'instagram',
    //     'token',
    //     'status',
    // ];
    //  protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
}
