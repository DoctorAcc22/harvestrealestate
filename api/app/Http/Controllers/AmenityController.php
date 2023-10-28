<?php

namespace App\Http\Controllers;

use App\Actions\Randomizer\RandomizerActions;
use App\Models\Amenity;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AmenityController extends Controller
{
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'code' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ]);
        }

        $amenity = new Amenity();
        $amenity->code = request()->code;
        $amenity->name = request()->name;
        $amenity->status = request()->status;
        $amenity->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Amenity has been created.',
        ]);
    }

    public function read()
    {
        $amenities = Amenity::orderBy('name', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data has been fetched.',
            'amenities' => $amenities,
        ]);
    }

    public function update(Amenity $amenity)
    {
        $validator = Validator::make(request()->all(), [
            'code' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        $code = request()->code;
        if ($code == 'AUTO') {
            do {
                $code = $this->generateUniqueCode();
            } while (! $this->isUniqueCode($code, $amenity->id));
        } else {
            if (! $this->isUniqueCode($code, $amenity->id)) {
                return response()->error([
                    'code' => 'Code already used.',
                ], 422);
            }
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0],
            ]);
        }

        $amenity->code = request()->code;
        $amenity->name = request()->name;
        $amenity->status = request()->status;
        $amenity->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Amenity has been updated.',
        ]);
    }

    public function delete(Amenity $amenity)
    {
        DB::beginTransaction();

        try {
            $result = $amenity->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Amenity has been deleted.',
        ]);
    }

    public function generateUniqueCode(): string
    {
        $rand = app(RandomizerActions::class);
        $code = $rand->generateAlpha().$rand->generateNumeric();

        return $code;
    }

    public function isUniqueCode(string $code, int $exceptId = null): bool
    {
        $result = Amenity::where('code', '=', $code);

        if ($exceptId) {
            $result = $result->get()->where('id', '<>', $exceptId);
        }

        return $result->count() == 0 ? true : false;
    }
}
