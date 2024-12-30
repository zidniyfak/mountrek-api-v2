<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HikingCollection;
use App\Http\Resources\HikingResource;
use App\Models\Hiking;
use App\Models\HikingRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HikingController extends Controller
{
    //
    public function index()
    {
        try {
            $dateNow = now()->format('Y-m-d');
            $user = Auth::user();
            $hikings = Hiking::with('user', 'hiking_route.mountain')
                ->whereIn('status', ['Finished', 'Cancelled'])
                ->where('user_id', $user->id)
                ->orderBy('start_date', 'desc')
                ->get();
            return new HikingCollection($hikings);
            // return HikingResource::collection($hikings);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Error fetching hiking',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function journey()
    {
        try {
            $dateNow = now()->format('Y-m-d');

            $user = Auth::user();
            $hikings = Hiking::with('user', 'hiking_route.mountain')
                ->whereIn('status', ['Active', 'Scheduled'])
                ->where('user_id', $user->id)
                ->orderBy('start_date', 'asc')
                ->get();

            foreach ($hikings as $hiking) {
                if ($hiking->status === 'Scheduled' && $hiking->start_date === $dateNow) {
                    $hiking->status = 'Active';
                    $hiking->save();
                }
            }

            return new HikingCollection($hikings);

            // return HikingResource::collection($hikings);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Error fetching hiking',
                'error' => $e->getMessage(),
            ], 500);
        }
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
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'numb_of_teams' => 'required|integer',
                ]
            );
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $hiking_route_id = HikingRoute::where('name', $request->name)->value('id');

            $dateNow = now()->format('Y-m-d');
            $hiking = Hiking::create([
                'user_id' => Auth::user()->id,
                'hiking_route_id' => $hiking_route_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->start_date == $dateNow ? 'Active' : 'Scheduled',
                'numb_of_teams' => $request->numb_of_teams,
                'desc' => $request->desc,
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

    public function updateHikingStatus($id, Request $request)
    {
        $hiking = Hiking::find($id);

        if ($hiking) {
            $durationInSeconds = $request->duration;
            $durationFormatted = gmdate('H:i:s', $durationInSeconds);
            $hiking->status = $request->status;
            $hiking->duration = $durationFormatted;
            $hiking->save();

            return response()->json(['message' => 'Status updated successfully'], 200);
        }

        return response()->json(['message' => 'Hiking not found'], 404);
    }

    public function updateCancelled($id)
    {
        $hiking = Hiking::find($id);

        if ($hiking) {
            $hiking->status = "Cancelled";
            $hiking->save();

            return response()->json(['message' => 'Status updated successfully'], 200);
        }

        return response()->json(['message' => 'Hiking not found'], 404);
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
