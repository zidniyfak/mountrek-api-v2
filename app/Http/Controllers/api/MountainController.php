<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MountainCollection;
use App\Http\Resources\MountainResource;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MountainController extends Controller
{
    public function index()
    {
        try {
            $mountains = Mountain::with('hiking_route')->get();
            return new MountainCollection($mountains);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving mountains',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            $mountains = Mountain::where('name', 'like', '%' . $keyword . '%');

            return MountainResource::collection($mountains->get());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving mountains',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
