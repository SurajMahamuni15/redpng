<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

class HomeController extends Controller
{
    public function index()
    {
        // Get top 15 viewed approved images (5 rows × 3 columns)
        $topViewsImages = Image::where('is_approved', true)
            ->orderBy('views_count', 'desc')
            ->take(15)
            ->get();
        
        return view('welcome', compact('topViewsImages'));
    }
}
