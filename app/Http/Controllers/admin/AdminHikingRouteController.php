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
    public function index()
    {
        $hikingroutes = HikingRoute::with('mountain')->get();
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
                'elevation_gain' => 'required|integer',
                'operating_hours' => 'nullable|string',
                'numb_of_posts' => 'required|integer',
                'contact' => 'nullable|string',
                'fee' => 'nullable|integer',
                'img' => 'nullable',
                'link' => 'nullable',
                'rules' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menangani gambar jika ada
        $img = $request->file('img');
        $img->storeAs('public/hikingroutes', $img->hashName());

        HikingRoute::create([
            'mountain_id' => $request->mountain_id,
            'name' => $request->name,
            'status' => $request->status,
            'difficulty' => $request->difficulty,
            'location' => $request->location,
            'distance' => $request->distance,
            'duration' => $request->duration,
            'elevation_gain' => $request->elevation_gain,
            'operating_hours' => $request->operating_hours,
            'numb_of_posts' => $request->numb_of_posts,
            'contact' => $request->contact,
            'fee' => $request->fee,
            'img' => $img->hashName(),
            'link' => $request->link,
            'rules' => $request->rules,
        ]);

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
                    'elevation_gain' => 'required',
                    'operating_hours' => 'nullable',
                    'numb_of_posts' => 'nullable',
                    'contact' => 'nullable',
                    'fee' => 'nullable',
                    'img' => 'nullable',
                    'link' => 'nullable',
                    'rules' => 'nullable',
                ],
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $hikingroute = HikingRoute::findOrFail($id);
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $img->storeAs('public/hikingroutes', $img->hashName());

                $path = str_replace('http://127.0.0.1:8000/storage/', '', $hikingroute->img);
                Storage::delete('public/' . $path);

                $hikingroute->update([
                    'mountain_id' => $request->mountain_id,
                    'name' => $request->name,
                    'status' => $request->status,
                    'difficulty' => $request->difficulty,
                    'location' => $request->location,
                    'distance' => $request->distance,
                    'duration' => $request->duration,
                    'elevation_gain' => $request->elevation_gain,
                    'operating_hours' => $request->operating_hours,
                    'numb_of_posts' => $request->numb_of_posts,
                    'contact' => $request->contact,
                    'fee' => $request->fee,
                    'img' => $img->hashName(),
                    'link' => $request->link,
                    'rules' => $request->rules,
                ]);
            } else {
                $hikingroute->update([
                    'mountain_id' => $request->mountain_id,
                    'name' => $request->name,
                    'status' => $request->status,
                    'difficulty' => $request->difficulty,
                    'location' => $request->location,
                    'distance' => $request->distance,
                    'duration' => $request->duration,
                    'elevation_gain' => $request->elevation_gain,
                    'operating_hours' => $request->operating_hours,
                    'numb_of_posts' => $request->numb_of_posts,
                    'contact' => $request->contact,
                    'fee' => $request->fee,
                    'link' => $request->link,
                    'rules' => $request->rules,
                ]);
            }

            return redirect()->route('admin.hikingroutes.index')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('admin.hikingroutes.index')->with('error', 'Data gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $hikingroute = HikingRoute::findOrFail($id);

        try {
            if ($hikingroute->img) {
                $path = str_replace('http://127.0.0.1:8000/storage/', '', $hikingroute->img);
                Storage::delete('public/' . $path);
            }
            $hikingroute->delete();
            return redirect()->route('admin.hikingroutes.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.hikingroutes.index')->with('error', 'Data gagal dihapus');
        }
    }
}
