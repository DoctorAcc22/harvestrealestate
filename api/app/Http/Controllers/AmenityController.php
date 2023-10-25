<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class AmenityController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            "code" => "required",
            "name" => "required",
            "status" => "required",
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->all()[0]
            ]);
        }

        $amenity = new Amenity();
        $amenity->code = request()->code;
        $amenity->name = request()->name;
        $amenity->status = request()->status;
        $amenity->save();

        return response()->json([
            "status" => "success",
            "message" => "Amenity has been created."
        ]);
    }
}
