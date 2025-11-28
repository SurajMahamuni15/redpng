<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalImages' => Image::count(),
            'pendingImages' => Image::where('is_approved', false)->count(),
            'approvedImages' => Image::where('is_approved', true)->count(),
            'totalUsers' => User::count(),
        ];

        $pendingImages = Image::where('is_approved', false)
                              ->with(['uploader', 'category'])
                              ->latest()
                              ->paginate(20);

        return view('admin.dashboard', compact('stats', 'pendingImages'));
    }

    public function approveImage(Image $image)
    {
        $image->update(['is_approved' => true]);

        return back()->with('success', 'Image approved successfully!');
    }

    public function rejectImage(Image $image)
    {
        // Delete the image files
        if (file_exists(public_path($image->file_path))) {
            unlink(public_path($image->file_path));
        }
        if (file_exists(public_path($image->thumbnail_path))) {
            unlink(public_path($image->thumbnail_path));
        }

        $image->delete();

        return back()->with('success', 'Image rejected and deleted successfully!');
    }
}
