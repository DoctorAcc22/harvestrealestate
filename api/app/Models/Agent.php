<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'date_of_birth',
        'address',
        'city',
        'state',
        'zip',
        'hire_date',
        'employment_status',
        'commision_rate',
        'specialization',
        'years_of_experience',
        'properties_sold',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function propertyAmenities()
    {
        return $this->belongsTo(PropertyAmenity::class);
    }

    public function properties()
    {
        return $this->hasMany(Branch::class);
    }
}
