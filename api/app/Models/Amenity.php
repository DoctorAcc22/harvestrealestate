<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'code',
        'name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function propertyAmenities()
    {
        return $this->hasMany(PropertyAmenity::class);
    }
}
