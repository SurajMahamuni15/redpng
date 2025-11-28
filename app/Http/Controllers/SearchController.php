<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Image::query()->where('is_approved', true);

        // Search
        if ($request->has('q')) {
            $search = $request->get('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('tags', function ($tagQuery) use ($search) {
                      $tagQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        if ($request->has('orientation')) {
            if ($request->get('orientation') === 'horizontal') {
                $query->whereRaw('width > height');
            } elseif ($request->get('orientation') === 'vertical') {
                $query->whereRaw('height > width');
            } elseif ($request->get('orientation') === 'square') {
                $query->whereRaw('width = height');
            }
        }

        if ($request->has('background')) {
            $query->where('background_type', $request->get('background'));
        }

        if ($request->has('resolution')) {
            if ($request->get('resolution') === 'large') {
                $query->where('width', '>=', 1920);
            } elseif ($request->get('resolution') === 'medium') {
                $query->whereBetween('width', [800, 1919]);
            } elseif ($request->get('resolution') === 'small') {
                $query->where('width', '<', 800);
            }
        }

        // Sort
        if ($request->has('sort')) {
            switch ($request->get('sort')) {
                case 'latest':
                    $query->latest();
                    break;
                case 'downloads':
                    $query->orderByDesc('downloads_count');
                    break;
                default:
                    // Relevance is default if searching, otherwise latest
                    if (!$request->has('q')) {
                        $query->latest();
                    }
                    break;
            }
        } else {
            $query->latest();
        }

        $images = $query->with('category')->paginate(20)->withQueryString();
        $categories = Category::all();

        return view('search', compact('images', 'categories'));
    }
}
