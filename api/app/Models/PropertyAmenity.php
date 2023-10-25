<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAmenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'property_id',
        'amenity_id',
    ];

    public function amenities()
    {
        return $this->hasMany(Amenity::class);
    }
}
