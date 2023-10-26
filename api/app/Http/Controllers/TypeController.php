<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Validation\Validator;

class TypeController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ]);
        }

        $type = new Type();
        $type->code = request()->code;
        $type->name = request()->name;
        $type->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Type has been created.',
        ]);
    }

    public function update()
    {

    }
}
