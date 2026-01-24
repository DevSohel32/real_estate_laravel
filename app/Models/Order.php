<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'agent_id', 'package_id', 'transaction_id', 'payment_method', 
        'paid_amount', 'purchase_date', 'expire_date', 'status', 'currently_active'
    ];
    public function agent(){
        return $this->belongsTo(Agent::class);
    } 
    public function package(){
        return $this->belongsTo(Package::class);
    } 
}
