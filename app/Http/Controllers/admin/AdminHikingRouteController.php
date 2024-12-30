<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HikingRoute;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminHikingRouteController extends Controller
{
    //
    // public function index()
    // {
    //     $hikingroutes = HikingRoute::with('mountain')->get();
    //     return view('hikingroutes.hiking_route_index', compact('hikingroutes'));
    // }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $hikingroutes = HikingRoute::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('difficulty', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhereHas('mountain', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
        })->get();

        return view('hikingroutes.hiking_route_index', compact('hikingroutes'));
    }

    public function create()
    {
        $mountains = Mountain::all();
        return view('hikingroutes.hiking_route_create', compact('mountains'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'mountain_id' => 'required',
                'name' => 'required|string|max:50',
                'status' => 'required',
                'difficulty' => 'required|string|max:50',
                'location' => 'required|string',
                'distance' => 'required|integer',
                'duration' => 'required|integer',
                'operating_hours' => 'nullable|string',
                'numb_of_posts' => 'required|integer',
                'contact' => 'nullable|string',
                'fee' => 'nullable|integer',
                'img' => 'nullable',
                'rules' => 'nullable',
                'lat' => 'required',
                'lng' => 'required',
                'file' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'mountain_id' => $request->mountain_id,
            'name' => $request->name,
            'status' => $request->status,
            'difficulty' => $request->difficulty,
            'location' => $request->location,
            'distance' => $request->distance,
            'duration' => $request->duration,
            'operating_hours' => $request->operating_hours,
            'numb_of_posts' => $request->numb_of_posts,
            'contact' => $request->contact,
            'fee' => $request->fee,
            'rules' => $request->rules,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $img->storeAs('public/hikingroutes', $img->hashName());
            $data['img'] = $img->hashName();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file->storeAs('public/gpx', $file->hashName());
            $data['file'] = $file->hashName();
        }

        HikingRoute::create($data);

        return redirect()->route('admin.hikingroutes.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $mountains = Mountain::all();
        $hikingroute = HikingRoute::findOrFail($id);
        return view('hikingroutes.hiking_route_edit', compact('mountains', 'hikingroute'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'mountain_id' => 'required',
                    'name' => 'required|string|max:50',
                    'status' => 'required',
                    'difficulty' => 'required|string|max:50',
                    'location' => 'required|string|max:50',
                    'distance' => 'required',
                    'duration' => 'required',
                    'operating_hours' => 'required',
                    'numb_of_posts' => 'required',
                    'contact' => 'required',
                    'fee' => 'nullable',
                    'lat' => 'required',
                    'lng' => 'required',
                ],
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $hikingroute = HikingRoute::findOrFail($id);
            $data = [
                'mountain_id' => $request->mountain_id,
                'name' => $request->name,
                'status' => $request->status,
                'difficulty' => $request->difficulty,
                'location' => $request->location,
                'distance' => $request->distance,
                'duration' => $request->duration,
                'operating_hours' => $request->operating_hours,
                'numb_of_posts' => $request->numb_of_posts,
                'contact' => $request->contact,
                'fee' => $request->fee,
                'rules' => $request->rules,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ];

            if ($request->hasFile('img')) {
                // Menangani gambar jika ada
                $img = $request->file('img');
                $img->storeAs('public/hikingroutes', $img->hashName());
                // Menghapus gambar lama jika ada
                if ($hikingroute->img) {
                    $path = str_replace('http://127.0.0.1:8000/storage/', '', $hikingroute->img);
                    Storage::delete('public/' . $path);
                }
                $data['img'] = $img->hashName();
            }

            if ($request->hasFile('file')) {
                // Menangani file jika ada
                $file = $request->file('file');
                $file->storeAs('public/gpx', $file->hashName());
                // Menghapus file lama jika ada
                if ($hikingroute->file) {
                    $pathFile = str_replace('http://127.0.0.1:8000/storage/', '', $hikingroute->file);
                    Storage::delete('public/' . $pathFile);
                }
                $data['file'] = $file->hashName();
            }

            $hikingroute->update($data);

            return redirect()->route('admin.hikingroutes.index')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('admin.hikingroutes.index')->with('error', 'Data gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $hikingroute = HikingRoute::findOrFail($id);

        try {
            $filesToDelete = [
                $hikingroute->img,
                $hikingroute->file
            ];

            // Loop untuk menghapus file jika ada
            foreach ($filesToDelete as $file) {
                if ($file) {
                    $path = str_replace('http://127.0.0.1:8000/storage/', '', $file);
                    Storage::delete('public/' . $path);
                }
            }

            $hikingroute->delete();
            return redirect()->route('admin.hikingroutes.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.hikingroutes.index')->with('error', 'Data gagal dihapus');
        }
    }
}
