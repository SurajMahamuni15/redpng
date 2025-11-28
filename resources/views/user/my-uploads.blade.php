@extends('layouts.app')

@section('title', 'My Uploads - RedPNG')

@section('content')
<div class="px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#E8304F] mb-2">My Uploads</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your uploaded PNG images</p>
        </div>

        @if($images->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($images as $image)
                    <div class="flex flex-col gap-3 pb-3 group cursor-pointer" onclick="window.location.href='{{ route('image.show', $image->slug) }}'">
                        <div class="relative w-full bg-white dark:bg-gray-800 aspect-square rounded-xl shadow-sm hover:shadow-lg transition-shadow overflow-hidden border border-gray-100 dark:border-gray-700">
                            <!-- Checkerboard for transparency -->
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 10px 10px;"></div>
                            
                            <img class="relative w-full h-full object-contain p-4 transition-transform duration-300 group-hover:scale-105" 
                                 src="{{ asset($image->thumbnail_path) }}" 
                                 alt="{{ $image->title }}">
                            
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                @if($image->is_approved)
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Approved</span>
                                @else
                                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">Pending</span>
                                @endif
                            </div>

                            <a href="{{ route('image.download', $image) }}" 
                               onclick="event.stopPropagation();"
                               class="absolute bottom-3 right-3 flex items-center justify-center size-9 bg-primary text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity shadow-md hover:bg-primary/90">
                                <span class="material-symbols-outlined text-xl">download</span>
                            </a>
                        </div>
                        <div>
                            <p class="text-[#111318] dark:text-white text-base font-medium leading-normal truncate">{{ $image->title }}</p>
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $image->width }}x{{ $image->height }}</span>
                                <span>•</span>
                                <span>{{ round($image->file_size_bytes / 1024) }} KB</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $images->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">upload_file</span>
                <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">No uploads yet</h3>
                <p class="text-gray-500 mb-4">Start uploading your PNG images to see them here</p>
                <button onclick="openUploadModal()" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors">
                    Upload Your First Image
                </button>
            </div>
        @endif
    </div>
</div>
@endsection
