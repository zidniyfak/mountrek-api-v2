<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hiking;
use App\Models\HikingRoute;
use App\Models\Mountain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminHikingController extends Controller
{
    //
    // public function index()
    // {
    //     $hikings = Hiking::with(['hiking_route.mountain', 'user'])->get();
    //     return view('hikings.hiking_index', compact('hikings'));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $hikings = Hiking::when($search, function ($query, $search) {
            return $query->where('status', 'like', "%{$search}%")
                ->orWhere('start_date', 'like', "%{$search}%")
                ->orWhere('end_date', 'like', "%{$search}%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('hiking_route', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhereHas('mountain', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                });
        })->with(['hiking_route.mountain', 'user'])->get();

        return view('hikings.hiking_index', compact('hikings'));
    }

    public function create()
    {
        $users = User::all(); // Untuk dropdown user
        $mountains = Mountain::all(); // Untuk dropdown mountain

        return view('hikings.hiking_create', compact('users', 'mountains'));
        // $user = User::all();
        // return view('hikings.hiking_create', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|integer',
                'hiking_route_id' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'numb_of_teams' => 'required|integer',
                'desc' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Hiking::create([
            'user_id' => $request->user_id,
            'hiking_route_id' => $request->hiking_route_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'numb_of_teams' => $request->numb_of_teams,
            'desc' => $request->desc,
        ]);

        return redirect()->route('admin.hikings.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $hiking = Hiking::findOrFail($id);
        $mountains = Mountain::all();
        $hikingRoutes = HikingRoute::where('mountain_id', $hiking->hiking_route->mountain_id)->get();
        $users = User::all(); // Pastikan data user tersedia jika ingin validasi
        $statuses = ['scheduled', 'active', 'finished', 'cancelled'];

        return view('hikings.hiking_edit', compact('hiking', 'mountains', 'hikingRoutes', 'users', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|integer',
                'hiking_route_id' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'numb_of_teams' => 'required|integer',
                'notes' => 'nullable|string',
                'status' => 'required|in:scheduled,active,finished,cancelled',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $hiking = Hiking::findOrFail($id);

        $hiking->update([
            'user_id' => $request->user_id, // Tidak diubah karena readonly
            'hiking_route_id' => $request->hiking_route_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'numb_of_teams' => $request->numb_of_teams,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.hikings.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $hiking = Hiking::findOrFail($id);
        $hiking->delete();

        return redirect()->route('admin.hikings.index')->with('success', 'Data berhasil dihapus');
    }
}
