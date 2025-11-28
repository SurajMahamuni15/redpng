<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;
use App\Models\Category;
use App\Models\License;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function showForm()
    {
        $categories = Category::all();
        $licenses = License::all();
        
        return view('upload', compact('categories', 'licenses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:png|max:5120',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'license_id' => 'required|exists:licenses,id',
            'background_type' => 'required|in:transparent,colored',
        ], [
            'image.mimes' => 'Only PNG images are allowed.',
            'image.max' => 'Image size must not exceed 5MB.',
        ]);

        try {
            // Store the uploaded file
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.png';
            
            // Get file size BEFORE moving (temp file will be gone after move)
            $fileSize = $file->getSize();
            
            // Ensure directory exists
            $imagesPath = storage_path('app/public/images');
            if (!is_dir($imagesPath)) {
                mkdir($imagesPath, 0755, true);
            }
            
            // Save the full-size image
            $fullImagePath = $imagesPath . '/' . $filename;
            $file->move($imagesPath, $filename);
            
            // Get image dimensions  
            $imageInfo = getimagesize($fullImagePath);
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            
            // Create thumbnail
            $thumbnailFilename = 'thumb_' . $filename;
            $thumbnailPath = $imagesPath . '/' . $thumbnailFilename;
            
            $img = imagecreatefrompng($fullImagePath);
            $thumbWidth = 400;
            $thumbHeight = ($height / $width) * $thumbWidth;
            $thumbnail = imagecreatetruecolor($thumbWidth, $thumbHeight);
            
            // Preserve transparency
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);
            
            imagecopyresampled($thumbnail, $img, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
            imagepng($thumbnail, $thumbnailPath);
            imagedestroy($img);
            imagedestroy($thumbnail);
            
            // Create the image record
            $image = Image::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . time(),
                'file_path' => Storage::url('images/' . $filename),
                'thumbnail_path' => Storage::url('images/' . $thumbnailFilename),
                'width' => $width,
                'height' => $height,
                'file_size_bytes' => $fileSize,
                'format' => 'png',
                'background_type' => $validated['background_type'],
                'category_id' => $validated['category_id'],
                'license_id' => $validated['license_id'],
                'uploader_id' => auth()->id() ?? 1, // Use authenticated user or default
                'is_approved' => false,
            ]);
            
            // Handle tags
            if (!empty($validated['tags'])) {
                $tagNames = array_map('trim', explode(',', $validated['tags']));
                $tagIds = [];
                
                foreach ($tagNames as $tagName) {
                    if (empty($tagName)) continue;
                    
                    $tag = Tag::firstOrCreate(
                        ['slug' => Str::slug($tagName)],
                        ['name' => $tagName]
                    );
                    $tagIds[] = $tag->id;
                }
                
                $image->tags()->attach($tagIds);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully! It will be visible after admin approval.',
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
