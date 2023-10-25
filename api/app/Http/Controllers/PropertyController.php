<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class PropertyController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            "code" => "required",
            "area" => "required",
            "title" => "required",
            "description" => "required",
            "loc_city" => "required",
            "loc_latitude" => "required",
            "loc_longitude" => "required",
            "loc_address" => "required",
            "loc_state" => "required",
            "loc_neightborhood" => "required",
            "loc_zip" => "required",
            "loc_country" => "required",
            "price" => "required",
            "prce_label" => "required",
            "agent_id" => "required",
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->all()[0]
            ]);
        }

        $property = new Property();
        $property->code = request()->code;
        $property->area = request()->area;
        $property->title = request()->title;
        $property->description = request()->description;
        $property->loc_city = request()->loc_city;
        $property->loc_latitude = request()->loc_latitude;
        $property->loc_longitude = request()->loc_longitude;
        $property->loc_address = request()->loc_address;
        $property->loc_state = request()->loc_state;
        $property->loc_neightborhood = request()->loc_neightborhood;
        $property->loc_zip = request()->loc_zip;
        $property->loc_country = request()->loc_country;
        $property->price = request()->price;
        $property->price_label = request()->price_label;
        $property->agent_id = request()->agent_id;
        $property->save();

        return response()->json([
            "status" => "success",
            "message" => "Property has been created."
        ]);
    }
}
