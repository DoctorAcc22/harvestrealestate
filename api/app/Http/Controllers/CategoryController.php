<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
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

        $category = new Category();
        $category->code = request()->code;
        $category->name = request()->name;
        $category->save();

        return response()->json([
            "status" => "success",
            "message" => "Category has been created."
        ]);
    }
}
