<?php

namespace App\Http\Controllers;

use App\Models\FloorPlan;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class FloorPlanController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            "property_id" => "required",
            "name" => "required",
            "img_path" => "file|required",
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->all()[0]
            ]);
        }

        $file = request()->file;
        if (!$file->isValid())
        {
            return response()->json([
                "status" => "error",
                "message" => "Please select a valid file."
            ]);
        }

        $extension =  $file->getClientOriginalExtension();
        $image_extensions = ["png", "jpeg", "jpg"]; 

        if (!in_array($extension, $image_extensions))
        {
            return response()->json([
                "status" => "error",
                "message" => "Please select a valid image file."
            ]);
        }

        $img_path = "img-path/" . time() . "-" . $file->getClientOriginalName();
        $file->storeAs("/public", $img_path);

        $floor_plan = new FloorPlan();
        $floor_plan->propery_id = request()->propery_id;
        $floor_plan->img_path = request()->img_path;
        $floor_plan->save();

        return response()->json([
            "status" => "success",
            "message" => "Image has been created."
        ]);
    }
}
