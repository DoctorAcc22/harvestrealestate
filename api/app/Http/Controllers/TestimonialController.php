<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class TestimonialController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            "code" => "required",
            "user_id" => "required",
            "name" => "required",
            "email" => "required",
            "content" => "required",
            "rating" => "required",
            "property_id" => "required",
            "company" => "required",
            "photo_url" => "required",
            "video_url" => "required",
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->all()[0]
            ]);
        }

        $testimoninal = new Testimonial();
        $testimoninal->code = request()->code;
        $testimoninal->user_id = request()->user_id;
        $testimoninal->name = request()->name;
        $testimoninal->email = request()->email;
        $testimoninal->content = request()->content;
        $testimoninal->rating = request()->rating;
        $testimoninal->property_id = request()->property_id;
        $testimoninal->company = request()->company;
        $testimoninal->photo_url = request()->photo_url;
        $testimoninal->video_url = request()->video_url;
        $testimoninal->save();

        return response()->json([
            "status" => "success",
            "message" => "Testimonial has been created."
        ]);
    }

    public function update()
    {

    }
}
