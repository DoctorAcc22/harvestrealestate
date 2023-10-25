<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'property_id',
        'img_path',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
