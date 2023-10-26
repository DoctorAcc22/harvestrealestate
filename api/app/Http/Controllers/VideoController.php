<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Validation\Validator;

class VideoController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'property_id' => 'required',
            'img_path' => 'file|required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ]);
        }

        $file = request()->file;
        if (! $file->isValid()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please select a valid file.',
            ]);
        }

        $extension = $file->getClientOriginalExtension();
        $image_extensions = ['png', 'jpeg', 'jpg'];

        if (! in_array($extension, $image_extensions)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please select a valid image file.',
            ]);
        }

        $img_path = 'img-path/'.time().'-'.$file->getClientOriginalName();
        $file->storeAs('/public', $img_path);

        $video = new Video();
        $video->propery_id = request()->propery_id;
        $video->img_path = request()->img_path;
        $video->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Image has been created.',
        ]);
    }

    public function update()
    {

    }
}
