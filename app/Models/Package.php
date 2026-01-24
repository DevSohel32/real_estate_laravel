<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
   use HasFactory, Notifiable;
   public function order(){
    return $this->hasMany(Order::class);
   }
   public function payments()
   {
      return $this->hasMany(Payment::class, 'product_name', 'name');
   }
}
