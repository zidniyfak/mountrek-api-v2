<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
            $mountains = Mountain::all();

            return new MountainResource(true, 'List data mountains', $mountains);
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
                    'img' => 'nullable',
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

            // Menangani gambar jika ada
            $img = $request->file('img');
            $img->storeAs('public/mountains', $img->hashName());

            $mountain = Mountain::create([
                'name' => $request->name,
                'location' => $request->location,
                'altitude' => $request->altitude,
                'status' => $request->status,
                'type' => $request->type,
                'lat' => $request->lat,
                'long' => $request->long,
                'desc' => $request->desc,
                'img' => $img->hashName(),
            ]);

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
                    'img' => 'nullable',
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

            /// Cari data mountain berdasarkan ID
            $mountain = Mountain::find($id);
            if (!$mountain) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mountain not found',
                ], 404);
            }

            // Menangani gambar jika ada
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $img->storeAs('public/mountains', $img->hashName());

                Storage::delete('public/mountains/' . basename($mountain->img));

                $mountain->update([
                    'name' => $request->name,
                    'location' => $request->location,
                    'altitude' => $request->altitude,
                    'status' => $request->status,
                    'type' => $request->type,
                    'lat' => $request->lat,
                    'long' => $request->long,
                    'desc' => $request->desc,
                    'img' => $img->hashName(),
                ]);
            } else {
                $mountain->update([
                    'name' => $request->name,
                    'location' => $request->location,
                    'altitude' => $request->altitude,
                    'status' => $request->status,
                    'type' => $request->type,
                    'lat' => $request->lat,
                    'long' => $request->long,
                    'desc' => $request->desc,
                ]);
            }

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

            Storage::delete('public/mountains/' . $mountain->img);

            $mountain->delete();

            return new MountainResource(true, 'Mountain deleted successfully', null);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting mountain',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
