<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use Illuminate\Http\Request;

class MountainController extends Controller
{
    //
    public function index()
    {
        $mountains = Mountain::all();
        return response()->json($mountains);
    }
}
