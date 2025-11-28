<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class UserController extends Controller
{
    public function myUploads()
    {
        $images = Image::where('uploader_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('user.my-uploads', compact('images'));
    }

    public function favorites()
    {
        $favorites = auth()->user()->favorites()
            ->with('category', 'license', 'uploader')
            ->orderBy('favorites.created_at', 'desc')
            ->paginate(20);
        
        return view('user.favorites', compact('favorites'));
    }

    public function toggleFavorite(Request $request)
    {
        $imageId = $request->input('image_id');
        $user = auth()->user();

        if ($user->hasFavorited($imageId)) {
            $user->favorites()->detach($imageId);
            return response()->json(['favorited' => false, 'message' => 'Removed from favorites']);
        } else {
            $user->favorites()->attach($imageId);
            return response()->json(['favorited' => true, 'message' => 'Add to favorites']);
        }
    }

    public function settings()
    {
        return view('user.settings');
    }
}
