<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Validation\Validator;

class PropertyTypeController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'property_id' => 'required',
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ]);
        }

        $property_type = new PropertyType();
        $property_type->property_id = request()->property_id;
        $property_type->type_id = request()->type_id;
        $property_type->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Property Type has been created.',
        ]);
    }

    public function update()
    {

    }
}
