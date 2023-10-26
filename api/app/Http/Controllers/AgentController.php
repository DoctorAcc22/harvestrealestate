<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class AgentController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            "code" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "phone_number" => "required",
            "date_of_birth" => "required",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "zip" => "required",
            "hire_date" => "required",
            "employment_status" => "required",
            "commision_rate" => "required",
            "specialization" => "required",
            "years_of_experience" => "required",
            "properties_sold" => "required"
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->all()[0]
            ]);
        }

        $agent = new Agent();
        $agent->code = request()->code;
        $agent->first_name = request()->first_name;
        $agent->last_name = request()->last_name;
        $agent->email = request()->email;
        $agent->phone_number = request()->phone_number;
        $agent->date_of_birth = request()->date_of_birth;
        $agent->address = request()->address;
        $agent->city = request()->city;
        $agent->state = request()->state;
        $agent->zip = request()->zip;
        $agent->hire_date = request()->hire_date;
        $agent->employment_status = request()->employment_status;
        $agent->commision_rate = request()->commision_rate;
        $agent->specialization = request()->specialization;
        $agent->years_of_experience = request()->years_of_experience;
        $agent->properties_sold = request()->properties_sold;
        $agent->save();

        return response()->json([
            "status" => "success",
            "message" => "Agent has been created."
        ]);
    }

    public function update()
    {

    }
}
