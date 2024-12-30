<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HikingRouteCollection;
use App\Http\Resources\HikingRouteResource;
use App\Models\HikingRoute;

class HikingRouteController extends Controller
{
    //
    public function index()
    {
        $hikingroutes = HikingRoute::all();
        return new HikingRouteCollection($hikingroutes);
    }

    public function show($id)
    {
        $hikingroute = HikingRoute::with('mountain')->find($id);
        return new HikingRouteResource($hikingroute);
    }
}
