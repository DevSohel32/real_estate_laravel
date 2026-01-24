<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_id', 'product_name', 'quantity', 'amount', 
        'currency', 'payer_name', 'payer_email', 
        'payment_status', 'payment_method', 'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
    public function package()
    {
        return $this->belongsTo(Package::class, 'product_name', 'name'); 
    }
}
