<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'user_id',
        'name',
        'email',
        'content',
        'rating',
        'property_id',
        'company',
        'photo_url',
        'video_url',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
