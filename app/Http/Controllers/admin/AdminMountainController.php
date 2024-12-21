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

        return view('mountains.mountains', compact('mountains'));
    }
    public function create()
    {
        return view('mountains.create');
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
                'long' => 'required|numeric',
                'desc' => 'nullable|string',
                'img' => 'nullable',
            ],
            [
                'name.required' => 'nama harus diisi',
                'location.required' => 'lokasi harus diisi',
                'altitude.required' => 'ketinggian harus diisi',
                'status.required' => 'status harus diisi',
                'type.required' => 'tipe harus diisi',
                'long.required' => 'longitude harus diisi',
                'lat.required' => 'latitude harus diisi',
                'img.required' => 'gambar harus diisi',
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
            'long' => $request->long,
            'desc' => $request->desc,
            'img' => $img->hashName(),
        ]);

        return redirect()->route('admin.mountains.index')->with('success', 'Mountain Created Successfully');
    }

    public function edit(Request $request, $id)
    {
        $mountain = Mountain::findOrFail($id);
        return view('mountains.edit', compact('mountain'));
    }

    public function update(Request $request, $id)
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
                'long' => 'required|numeric',
                'desc' => 'nullable|string',
                'img' => 'nullable',
            ],
            [
                'name.required' => 'nama harus diisi',
                'location.required' => 'lokasi harus diisi',
                'altitude.required' => 'ketinggian harus diisi',
                'status.required' => 'status harus diisi',
                'type.required' => 'tipe harus diisi',
                'long.required' => 'longitude harus diisi',
                'lat.required' => 'latitude harus diisi',
                'img.required' => 'gambar harus diisi',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mountain = Mountain::findOrFail($id);
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $img->storeAs('public/mountains', $img->hashName());

            Storage::delete('public/mountains/' . $mountain->img);

            $mountain->update([
                'name' => $request->name,
                'location' => $request->location,
                'altitude' => $request->altitude,
                'status' => $request->status,
                'type' => $request->type,
                'lat' => $request->lat,
                'long' => $request->long,
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
                'long' => $request->long,
                'desc' => $request->desc,
            ]);
        }

        return redirect()->route('admin.mountains.index')->with('success', 'Mountain Updated Successfully');
    }

    public function destroy($id)
    {
        $mountain = Mountain::findOrFail($id);

        // Menghapus gambar dari storage jika ada
        if ($mountain->img) {
            Storage::delete('public/mountains/' . $mountain->img);
        }

        $mountain->delete();

        return redirect()->route('admin.mountains.index')->with('success', 'Mountain Deleted Successfully');
    }
}
