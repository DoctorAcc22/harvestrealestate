<?php

namespace App\Http\Controllers;

use App\Models\PropertyAmenity;
use Illuminate\Validation\Validator;

class PropertyAmenityController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'property_id' => 'required',
            'amenity_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ]);
        }

        $property_amenity = new PropertyAmenity();
        $property_amenity->property_id = request()->property_id;
        $property_amenity->amenity_id = request()->amenity_id;
        $property_amenity->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Property Amenity has been created.',
        ]);
    }

    public function update()
    {

    }
}
