<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'area',
        'title',
        'description',
        'loc_city',
        'loc_latitude',
        'loc_longitude',
        'loc_address',
        'loc_state',
        'loc_neightborhood',
        'loc_zip',
        'loc_country',
        'price',
        'prce_label',
        'agent_id',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function floorPlans()
    {
        return $this->hasMany(FloorPlan::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
