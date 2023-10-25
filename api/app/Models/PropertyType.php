<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'property_id',
        'type_id',
    ];

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
