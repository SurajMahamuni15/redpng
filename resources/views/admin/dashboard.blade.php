@extends('layouts.app')

@section('title', 'Admin Dashboard - RedPNG')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-[#111318] dark:text-white">Admin Dashboard</h1>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-lg bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-lg bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Images</p>
                    <p class="text-3xl font-bold text-[#111318] dark:text-white mt-2">{{ $stats['totalImages'] }}</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-blue-500">image</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pending</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">{{ $stats['pendingImages'] }}</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-orange-500">pending</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Approved</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['approvedImages'] }}</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-green-500">check_circle</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                    <p class="text-3xl font-bold text-[#111318] dark:text-white mt-2">{{ $stats['totalUsers'] }}</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-purple-500">group</span>
            </div>
        </div>
    </div>

    <!-- Pending Images Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold text-[#111318] dark:text-white">Pending Images</h2>
        </div>

        @if($pendingImages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Uploader</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Uploaded</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($pendingImages as $image)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-900 rounded-lg flex items-center justify-center overflow-hidden">
                                        <img src="{{ asset($image->thumbnail_path) }}" alt="{{ $image->title }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-[#111318] dark:text-white">{{ $image->title }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $image->width }}x{{ $image->height }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-[#111318] dark:text-white">{{ $image->uploader->name }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded">
                                        {{ $image->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ round($image->file_size_bytes / 1024) }} KB
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $image->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <form method="POST" action="{{ route('admin.approve', $image) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition-colors">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reject', $image) }}" class="inline" onsubmit="return confirm('Are you sure you want to reject and delete this image?')">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition-colors">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $pendingImages->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-600">check_circle</span>
                <p class="mt-4 text-gray-500 dark:text-gray-400">No pending images to review</p>
            </div>
        @endif
    </div>
</div>
@endsection
