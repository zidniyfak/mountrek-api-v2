<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hiking;
use App\Models\HikingRoute;
use App\Models\Mountain;
use App\Models\User;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        // if (auth()->user()->can('view_dashboard')) {
        //     return view('dashboard');
        // }
        $mountain = Mountain::all();
        $user = User::all();
        $hikingroute = HikingRoute::all();
        $hiking = Hiking::all();

        return view('dashboard', compact('mountain', 'user', 'hikingroute', 'hiking'));
    }
}
