<?php

namespace App\Http\Controllers;

use App\Models\PropertyCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class PropertyCategoryController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            "property_id" => "required",
            "category_id" => "required",
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->all()[0]
            ]);
        }

        $property_category = new PropertyCategory();
        $property_category->property_id = request()->property_id;
        $property_category->category_id = request()->category_id;
        $property_category->save();

        return response()->json([
            "status" => "success",
            "message" => "Property Amenity has been created."
        ]);
    }

    public function update()
    {

    }
}
