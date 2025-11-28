@extends('layouts.app')

@section('title', 'Red Apple with Leaf - RedPNG')

@section('content')
<div class="px-4 md:px-6">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column: Image Preview -->
        <div class="flex-1 flex flex-col gap-4">
            <div class="relative w-full bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden group">
                <!-- Checkerboard Background -->
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 16px 16px;"></div>
                
                <div class="relative flex items-center justify-center min-h-[400px] p-8">
                    <img src="{{ asset($image->file_path) }}" alt="{{ $image->title }}" class="max-w-full max-h-[600px] object-contain transition-transform duration-200" id="main-image">
                </div>

                <!-- Zoom Controls -->
                <div class="absolute bottom-4 right-4 flex gap-2">
                    <button class="flex items-center justify-center size-10 bg-white dark:bg-gray-700 text-gray-700 dark:text-white rounded-lg shadow-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors" onclick="zoomOut()">
                        <span class="material-symbols-outlined">remove</span>
                    </button>
                    <button class="flex items-center justify-center size-10 bg-white dark:bg-gray-700 text-gray-700 dark:text-white rounded-lg shadow-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors" onclick="zoomIn()">
                        <span class="material-symbols-outlined">add</span>
                    </button>
                </div>
            </div>
            
            <!-- Image Info Mobile -->
            <div class="lg:hidden flex flex-col gap-4">
                <h1 class="text-[#111318] dark:text-white text-2xl font-bold leading-tight">{{ $image->title }}</h1>
                <div class="flex flex-wrap gap-2">
                    @foreach($image->tags as $tag)
                        <span class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-sm px-3 py-1 rounded-full">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: Details & Actions -->
        <div class="w-full lg:w-[400px] flex flex-col gap-6 min-w-0">
            <div class="hidden lg:flex flex-col gap-4">
                <h1 class="text-[#111318] dark:text-white text-3xl font-bold leading-tight">{{ $image->title }}</h1>
                <div class="flex flex-wrap gap-2">
                    @foreach($image->tags as $tag)
                        <a href="{{ route('search', ['q' => $tag->name]) }}" class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-sm px-3 py-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('image.download', $image->id) }}" class="flex items-center justify-center gap-2 w-full h-12 bg-primary text-white text-base font-bold rounded-xl hover:bg-primary/90 transition-colors shadow-sm">
                    <span class="material-symbols-outlined">download</span>
                    <span>Download PNG ({{ round($image->file_size_bytes / 1024) }} KB)</span>
                </a>
                @auth
                    <button id="favoriteBtn" 
                            data-image-id="{{ $image->id }}"
                            data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
                            class="flex items-center justify-center gap-2 w-full h-12 bg-white dark:bg-gray-800 text-[#111318] dark:text-white border border-gray-200 dark:border-gray-700 text-base font-bold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <span class="material-symbols-outlined" id="favoriteIcon">{{ $isFavorited ? 'favorite' : 'favorite_border' }}</span>
                        <span id="favoriteText">{{ $isFavorited ? 'Remove from Favorites' : 'Save to Favorites' }}</span>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full h-12 bg-white dark:bg-gray-800 text-[#111318] dark:text-white border border-gray-200 dark:border-gray-700 text-base font-bold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <span class="material-symbols-outlined">favorite</span>
                        <span>Save to Favorites</span>
                    </a>
                @endauth
            </div>

            <!-- Details Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 flex flex-col gap-4">
                <h3 class="text-[#111318] dark:text-white text-lg font-bold">Image Details</h3>
                <div class="grid grid-cols-2 gap-y-4 text-sm">
                    <div class="text-gray-500 dark:text-gray-400">Resolution</div>
                    <div class="text-[#111318] dark:text-white font-medium text-right">{{ $image->width }}x{{ $image->height }}</div>
                    
                    <div class="text-gray-500 dark:text-gray-400">Size</div>
                    <div class="text-[#111318] dark:text-white font-medium text-right">{{ round($image->file_size_bytes / 1024) }} KB</div>
                    
                    <div class="text-gray-500 dark:text-gray-400">Format</div>
                    <div class="text-[#111318] dark:text-white font-medium text-right">{{ strtoupper($image->format) }}</div>
                    
                    <div class="text-gray-500 dark:text-gray-400">License</div>
                    <div class="text-[#111318] dark:text-white font-medium text-right">{{ $image->license->name ?? 'Free' }}</div>
                    
                    <div class="text-gray-500 dark:text-gray-400">Views</div>
                    <div class="text-[#111318] dark:text-white font-medium text-right">{{ number_format($image->views_count) }}</div>
                    
                    <div class="text-gray-500 dark:text-gray-400">Downloads</div>
                    <div class="text-[#111318] dark:text-white font-medium text-right">{{ number_format($image->downloads_count) }}</div>
                </div>
            </div>

            <!-- Uploader -->
            <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="size-12 rounded-full bg-gray-200 overflow-hidden">
                    <img src="{{ $image->uploader->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($image->uploader->name) }}" alt="Uploader" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <p class="text-[#111318] dark:text-white text-sm font-bold">{{ $image->uploader->name }}</p>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Uploaded {{ $image->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Images -->
    @if($related->count() > 0)
    <div class="mt-16">
        <h2 class="text-[#111318] dark:text-white text-2xl font-bold mb-6">Related PNGs</h2>
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
            @foreach($related as $relatedImage)
                <div class="break-inside-avoid mb-4">
                    <div class="relative group cursor-pointer bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition-all overflow-hidden border border-gray-100 dark:border-gray-700" onclick="window.location.href='{{ route('image.show', $relatedImage->slug) }}'">
                        <!-- Checkerboard for transparency -->
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 10px 10px;"></div>
                        
                        <img class="relative w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105" 
                             src="{{ asset($relatedImage->thumbnail_path) }}" 
                             alt="{{ $relatedImage->title }}">
                        
                        <!-- View count badge -->
                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                            <div class="flex items-center gap-1 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                <span>{{ $relatedImage->views_count }}</span>
                            </div>
                        </div>

                        <!-- Download button -->
                        <a href="{{ route('image.download', $relatedImage) }}" 
                           onclick="event.stopPropagation();"
                           class="absolute bottom-3 right-3 flex items-center justify-center size-9 bg-primary text-white rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-lg hover:scale-110 z-10">
                            <span class="material-symbols-outlined text-xl">download</span>
                        </a>
                        
                        <!-- Bottom overlay with title -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform">
                            <p class="text-white text-sm font-semibold truncate">{{ $relatedImage->title }}</p>
                            <p class="text-white/80 text-xs">{{ $relatedImage->width }}×{{ $relatedImage->height }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

<script>
    let currentZoom = 1;
    const image = document.getElementById('main-image');

    function zoomIn() {
        if (currentZoom < 2) {
            currentZoom += 0.2;
            updateZoom();
        }
    }

    function zoomOut() {
        if (currentZoom > 0.5) {
            currentZoom -= 0.2;
            updateZoom();
        }
    }

    function updateZoom() {
        image.style.transform = `scale(${currentZoom})`;
    }

    // Favorite button toggle
    document.addEventListener('DOMContentLoaded', function() {
        const favoriteBtn = document.getElementById('favoriteBtn');
        
        if (favoriteBtn) {
            favoriteBtn.addEventListener('click', async function() {
                const imageId = this.dataset.imageId;
                
                try {
                    const response = await fetch('{{ route("favorites.toggle") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ image_id: imageId })
                    });
                    
                    const data = await response.json();
                    
                    // Update button state
                    this.dataset.favorited = data.favorited ? 'true' : 'false';
                    document.getElementById('favoriteIcon').textContent = data.favorited ? 'favorite' : 'favorite_border';
                    document.getElementById('favoriteText').textContent = data.favorited ? 'Remove from Favorites' : 'Save to Favorites';
                    
                } catch (error) {
                    console.error('Error toggling favorite:', error);
                }
            });
        }
    });
</script>
</div>
@endsection
