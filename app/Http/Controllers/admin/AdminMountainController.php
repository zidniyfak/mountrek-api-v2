<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminMountainController extends Controller
{
    //
    public function index()
    {
        $mountains = Mountain::all();

        return view('mountains.mountain_index', compact('mountains'));
    }
    public function create()
    {
        return view('mountains.mountain_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50',
                'location' => 'required|string|max:50',
                'altitude' => 'required|integer',
                'status' => 'required|in:Aktif,Tidak Aktif',
                'type' => 'required|string|max:50',
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
                'desc' => 'nullable|string',
                'img' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menangani gambar jika ada
        $img = $request->file('img');
        $img->storeAs('public/mountains', $img->hashName());

        Mountain::create([
            'name' => $request->name,
            'location' => $request->location,
            'altitude' => $request->altitude,
            'status' => $request->status,
            'type' => $request->type,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'desc' => $request->desc,
            'img' => $img->hashName(),
        ]);

        return redirect()->route('admin.mountains.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $mountain = Mountain::findOrFail($id);
        return view('mountains.mountain_edit', compact('mountain'));
    }

    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:50',
                    'location' => 'required|string|max:50',
                    'altitude' => 'required|integer',
                    'status' => 'required|in:Aktif,Tidak Aktif',
                    'type' => 'required|string|max:50',
                    'lat' => 'required',
                    'lng' => 'required',
                    'desc' => 'nullable|string',
                    'img' => 'nullable',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $mountain = Mountain::findOrFail($id);
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $img->storeAs('public/mountains', $img->hashName());

                $path = str_replace('http://127.0.0.1:8000/storage/', '', $mountain->img);
                Storage::delete('public/' . $path);

                $mountain->update([
                    'name' => $request->name,
                    'location' => $request->location,
                    'altitude' => $request->altitude,
                    'status' => $request->status,
                    'type' => $request->type,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'desc' => $request->desc,
                    'img' => $img->hashName(),
                ]);
            } else {
                $mountain->update([
                    'name' => $request->name,
                    'location' => $request->location,
                    'altitude' => $request->altitude,
                    'status' => $request->status,
                    'type' => $request->type,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'desc' => $request->desc,
                ]);
            }

            return redirect()->route('admin.mountains.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('admin.mountains.index')->with('error', 'Data gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $mountain = Mountain::findOrFail($id);

        try {
            if ($mountain->img) {
                $path = str_replace('http://127.0.0.1:8000/storage/', '', $mountain->img);
                Storage::delete('public/' . $path);
            }
            $mountain->delete();
            return redirect()->route('admin.mountains.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.mountains.index')->with('error', 'Data gagal dihapus');
        }
    }
}
