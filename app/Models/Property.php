<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Agent;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

protected $fillable = [
        'agent_id', 'location_id', 'type_id', 'amenities', 'name', 
        'slug', 'description', 'price', 'featured_photo', 'purpose', 
        'bedroom', 'bathroom', 'size', 'floor', 'garage', 'balcony', 
        'address', 'built_year', 'map', 'is_featured', 'status'
    ];
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
}
