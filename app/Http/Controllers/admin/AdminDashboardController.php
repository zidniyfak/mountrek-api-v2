<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        // if (auth()->user()->can('view_dashboard')) {
        //     return view('dashboard');
        // }
        return view('dashboard');

        return abort(403);
    }
}
