@extends('layouts.app')

@section('title', 'RedPNG - High-Quality Transparent PNG Images')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#E8304F] via-[#D62C4A] to-[#C42846] py-16 md:py-24">
    <!-- Decorative blur elements -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-black/10 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto text-center px-6">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 drop-shadow-lg">
            High-Quality Transparent PNG Images
        </h1>
        <p class="text-lg md:text-xl text-white/90 mb-8 drop-shadow-md">
            Discover and download the best transparent PNG images for free.
        </p>
        
        <!-- Search Bar -->
        <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto">
            <div class="flex items-center bg-white rounded-full shadow-2xl overflow-hidden">
                <div class="pl-6 text-[#E8304F]">
                    <span class="material-symbols-outlined text-2xl">search</span>
                </div>
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Search PNG images..." 
                    value="{{ request('q') }}"
                    class="flex-1 px-4 py-4 text-gray-800 placeholder-gray-400 bg-transparent border-0 focus:outline-none focus:ring-0"
                />
                <button type="submit" class="bg-gradient-to-r from-[#E8304F] to-[#D62C4A] text-white px-8 py-4 font-bold hover:from-[#D62C4A] hover:to-[#C42846] transition-all">
                    Search
                </button>
            </div>
        </form>
        
        <!-- Trending Tags -->
        <div class="flex flex-wrap justify-center gap-3 mt-8">
            <span class="text-white/80 text-sm font-medium">Trending:</span>
            @foreach(['business', 'food', 'emoji', 'abstract', 'animals'] as $tag)
                <a href="{{ route('search', ['q' => $tag]) }}" 
                   class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white text-sm px-4 py-2 rounded-full transition-all duration-300 border border-white/30 hover:border-white/50">
                    {{ $tag }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Popular Categories Section -->
<div class="py-10">
    <h2 class="text-[#E8304F] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 md:px-6 pb-3">Popular Categories</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-4 md:px-6 pb-10">
        <a href="{{ route('search', ['category' => 'indian-politician']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Indian Politician</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'indian-politician'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'marathi-wedding-calligraphy']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Marathi Wedding</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'marathi-wedding-calligraphy'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'hindu-religious-calligraphy']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Hindu Religious</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'hindu-religious-calligraphy'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'historical-warrior']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1533093818801-e9dfe492a7f2?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Historical / Warrior</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'historical-warrior'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'events-greeting']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Events & Greeting</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'events-greeting'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'signature-calligraphy-names']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Signature & Names</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'signature-calligraphy-names'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'food']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Food / Restaurant</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'food'); })->count() }} Images</p>
            </div>
        </a>
        <a href="{{ route('search', ['category' => 'nature']) }}" class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style='background-image: url("https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80");'></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-white text-lg font-bold mb-1">Nature</h3>
                <p class="text-white/80 text-sm">{{ \App\Models\Image::whereHas('category', function($q) { $q->where('slug', 'nature'); })->count() }} Images</p>
            </div>
        </a>
    </div>
</div>

<!-- Trending Images Section -->
<div class="py-10 bg-gray-50 dark:bg-gray-900/50">
    <h2 class="text-[#E8304F] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 md:px-6 pb-3">Trending PNGs (Top Views)</h2>
    <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 px-4 md:px-6">
        @foreach($topViewsImages as $image)
            <div class="break-inside-avoid mb-6">
                <div class="relative group cursor-pointer bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition-all overflow-hidden border border-gray-100 dark:border-gray-700" onclick="window.location.href='{{ route('image.show', $image->slug) }}'">
                    <!-- Checkerboard for transparency -->
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 10px 10px;"></div>
                    
                    <img class="relative w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105" 
                         src="{{ asset($image->thumbnail_path) }}" 
                         alt="{{ $image->title }}">
                    
                    <!-- View count badge -->
                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                        <div class="flex items-center gap-1 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            <span>{{ $image->views_count }}</span>
                        </div>
                    </div>

                    <!-- Download button -->
                    <a href="{{ route('image.download', $image) }}" 
                       onclick="event.stopPropagation();"
                       class="absolute bottom-3 right-3 flex items-center justify-center size-9 bg-primary text-white rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-lg hover:scale-110 z-10">
                        <span class="material-symbols-outlined text-xl">download</span>
                    </a>
                    
                    <!-- Bottom overlay with title -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform">
                        <p class="text-white text-sm font-semibold truncate">{{ $image->title }}</p>
                        <p class="text-white/80 text-xs">{{ $image->width }}×{{ $image->height }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
