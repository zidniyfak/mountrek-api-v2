<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HikingCollection;
use App\Http\Resources\HikingResource;
use App\Models\Hiking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HikingController extends Controller
{
    //
    public function index()
    {
        // try {
        //     $hikings = Hiking::with('user', 'hiking_route.mountain')->get();
        //     return new HikingCollection($hikings);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Error fetching hiking',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
        $hikings = Hiking::with('user', 'hiking_route.mountain')->get();
        return new HikingCollection($hikings);
    }

    public function show($id)
    {
        $hiking = Hiking::with('user', 'hiking_route.mountain')->find($id);
        return new HikingResource($hiking);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'user_id' => 'required|integer',
                    'hiking_route_id' => 'required|integer',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'numb_of_teams' => 'required|integer',
                    'notes' => 'nullable|string',
                    'status' => 'required',
                    'duration' => 'required|integer',
                ]
            );
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $hiking = Hiking::create([
                'user_id' => $request->user_id,
                'hiking_route_id' => $request->hiking_route_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'numb_of_teams' => $request->numb_of_teams,
                'notes' => $request->notes,
                'status' => $request->status,
                'duration' => $request->duration,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Hiking created successfully',
                'data' => $hiking,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating hiking',
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
                    'user_id' => 'required|integer',
                    'hiking_route_id' => 'required|integer',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'numb_of_teams' => 'required|integer',
                    'notes' => 'nullable|string',
                    'status' => 'required',
                    'duration' => 'required|integer',
                ]
            );
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $hiking = Hiking::findOrFail($id);
            $hiking->update([
                'user_id' => $request->user_id,
                'hiking_route_id' => $request->hiking_route_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'numb_of_teams' => $request->numb_of_teams,
                'notes' => $request->notes,
                'status' => $request->status,
                'duration' => $request->duration,
                'updated_at' => now(),
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Hiking updated successfully',
                'data' => $hiking,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating hiking',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $hiking = Hiking::findOrFail($id);
            $hiking->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hiking deleted successfully',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting hiking',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
