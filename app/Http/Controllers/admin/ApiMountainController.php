<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use Illuminate\Http\Request;


class ApiMountainController extends Controller
{
    public function getHikingRoutes(Mountain $mountain)
    {
        return response()->json($mountain->hiking_route); // Pastikan relasi hiking_routes sudah didefinisikan
    }
}
