<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'property_id',
        'category_id',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
