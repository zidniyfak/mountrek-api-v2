<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MountainResource;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MountainController extends Controller
{
    public function index()
    {
        try {
            $mountains = Mountain::all()->map(function ($mountain) {
                return new MountainResource(true, 'Mountain details', $mountain);
            });

            return response()->json([
                'success' => true,
                'message' => 'List of mountains',
                'data' => $mountains,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching mountains',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $mountain = Mountain::find($id);
            if (!$mountain) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mountain not found',
                ], 404);
            }

            return new MountainResource(true, 'Mountain details', $mountain);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching mountain',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:50',
                    'location' => 'required|string|max:50',
                    'altitude' => 'required|integer',
                    'status' => 'required|in:Aktif,Tidak Aktif',
                    'type' => 'required|string|max:50',
                    'lat' => 'required|numeric',
                    'long' => 'required|numeric',
                    'desc' => 'nullable|string',
                    'img' => 'nullable|string',
                ],
                [
                    'long.required' => 'longitude harus diisi',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'error' => $validator->errors(),
                ], 422);
            }

            $mountain = Mountain::create($validator->validated());
            return new MountainResource(true, 'Mountain created successfully', $mountain);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating mountain',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:50',
                    'location' => 'required|string|max:50',
                    'altitude' => 'required|integer',
                    'status' => 'required|in:Aktif,Tidak Aktif',
                    'type' => 'required|string|max:50',
                    'lat' => 'required|numeric',
                    'long' => 'required|numeric',
                    'desc' => 'nullable|string',
                    'img' => 'nullable|string',
                ],
                [
                    'long.required' => 'longitude harus diisi',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'error' => $validator->errors(),
                ], 422);
            }

            $mountain = Mountain::find($id);
            if (!$mountain) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mountain not found',
                ], 404);
            }

            $mountain->update($validator->validated());
            return new MountainResource(true, 'Mountain updated successfully', $mountain);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating mountain',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $mountain = Mountain::find($id);
            if (!$mountain) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mountain not found',
                ], 404);
            }

            $mountain->delete();
            return response()->json([
                'success' => true,
                'message' => 'Mountain deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting mountain',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
