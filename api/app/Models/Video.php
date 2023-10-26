<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'property_id',
        'videos_id',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
