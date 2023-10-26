<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'name',
    ];

    public function propertyTypes()
    {
        return $this->hasMany(PropertyType::class);
    }
}
