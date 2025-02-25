<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistCollection;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function index()
    {
        $wishlists = Wishlist::with('mountain')->get();
        return new WishlistCollection($wishlists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mountain_id' => 'required|exists:mountains,id',
        ]);
        $wishlist = Wishlist::create(
            [
                'user_id' => Auth::user()->id,
                'mountain_id' => $request->mountain_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        return response()->json([
            'success' => true,
            'message' => 'Data wishlist berhasil ditambahkan',
            'data' => $wishlist
        ]);
    }
    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data wishlist berhasil dihapus',
            'data' => $wishlist
        ]);
    }
}
