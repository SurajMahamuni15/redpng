@extends('layouts.app')

@section('title', 'Settings - RedPNG')

@section('content')
<div class="px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#E8304F] mb-2">Settings</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your account settings</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-[#111318] dark:text-white mb-4">Profile Information</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" readonly class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role</label>
                        <input type="text" value="{{ auth()->user()->isAdmin() ? 'Administrator' : 'User' }}" readonly class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-500">
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">Profile editing functionality coming soon!</p>
            </div>
        </div>
    </div>
</div>
@endsection
