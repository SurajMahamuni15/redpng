<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function show(string $slug)
    {
        $image = Image::with(['category', 'license', 'uploader', 'tags'])->where('slug', $slug)->firstOrFail();
        
        // Increment views
        $image->increment('views_count');
        
        // Check if user has favorited this image
        $isFavorited = auth()->check() ? auth()->user()->hasFavorited($image->id) : false;
        
        // Get related images by category
        $related = Image::where('category_id', $image->category_id)
            ->where('id', '!=', $image->id)
            ->where('is_approved', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        return view('png-detail', compact('image', 'related', 'isFavorited'));
    }

    public function download(Image $image)
    {
        $image->increment('downloads_count');

        // For external URLs (demo), we'll proxy the download
        if (filter_var($image->file_path, FILTER_VALIDATE_URL)) {
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification for development
            ])->get($image->file_path);
            
            if ($response->successful()) {
                return response($response->body())
                    ->header('Content-Type', 'image/png')
                    ->header('Content-Disposition', 'attachment; filename="' . $image->slug . '.png"');
            }
            return redirect($image->file_path); // Fallback
        }

        // For local files - remove leading slash if present
        $filePath = ltrim($image->file_path, '/');
        $fullPath = public_path($filePath);
        
        if (!file_exists($fullPath)) {
            abort(404, 'File not found');
        }

        return response()->download($fullPath, $image->slug . '.png');
    }
}
