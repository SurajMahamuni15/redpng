<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'PNG World - High-Quality Transparent PNG Images')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ef4444",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#111318] dark:text-gray-200">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 justify-center w-full">
                <div class="layout-content-container flex flex-col flex-1 w-full">
                    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-700 px-4 md:px-6 py-3 bg-white dark:bg-background-dark sticky top-0 z-50">
                        <div class="flex items-center gap-8">
                            <a href="/" class="flex items-center gap-3 text-primary">
                                <div class="size-6">
                                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <h2 class="text-[#111318] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">RedPNG</h2>
                            </a>
                        </div>
                        
                        <!-- Search Bar -->
                        <form action="{{ route('search') }}" method="GET" class="hidden lg:flex flex-1 justify-center px-8">
                            <label class="flex flex-col w-full !h-10 max-w-lg">
                                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                    <div class="text-gray-500 dark:text-gray-400 flex border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark items-center justify-center pl-4 rounded-l-lg border-r-0">
                                        <span class="material-symbols-outlined text-base">search</span>
                                    </div>
                                    <input type="text" name="q" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-[#111318] dark:text-gray-200 focus:outline-0 focus:ring-0 border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-4 text-sm font-normal leading-normal border-l-0" placeholder="Search PNG images..." value="{{ request('q') }}"/>
                                </div>
                            </label>
                        </form>

                        <div class="flex gap-2 items-center">
                            @auth
                                <!-- Logged in user -->
                                <div class="relative dropdown-container">
                                    <button class="dropdown-trigger flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <div class="size-8 rounded-full bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                        <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name }}</span>
                                        <span class="material-symbols-outlined text-lg">expand_more</span>
                                    </button>
                                    <!-- Dropdown -->
                                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-purple-600 dark:text-purple-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold">
                                                <span class="material-symbols-outlined text-sm align-middle">admin_panel_settings</span>
                                                Admin Panel
                                            </a>
                                            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                                        @endif
                                        <a href="{{ route('user.uploads') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">My Uploads</a>
                                        <a href="{{ route('user.favorites') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Favorites</a>
                                        <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
                                        <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                                        </form>
                                    </div>
                                </div>
                                <button onclick="openUploadModal()" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-background-light dark:bg-gray-800 text-[#111318] dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                    <span class="material-symbols-outlined text-xl">upload</span>
                                </button>
                            @else
                                <!-- Not logged in -->
                                <a href="{{ route('login') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 border border-gray-200 dark:border-gray-700 text-[#111318] dark:text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <span class="truncate">Login</span>
                                </a>
                                <a href="{{ route('login') }}" class="hidden sm:flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                                    <span class="truncate">Sign Up</span>
                                </a>
                            @endauth
                        </div>
                    </header>
                    
                    <main class="mt-6">
                        @yield('content')
                    </main>

                    <footer class="mt-16 border-t border-gray-200 dark:border-gray-700 py-8 px-4 md:px-6">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400">© 2024 PNG World. All rights reserved.</p>
                            <div class="flex items-center gap-6 text-sm">
                                <a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">About</a>
                                <a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">License</a>
                                <a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">Contact</a>
                                <a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">Privacy Policy</a>
                                <a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">Terms</a>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-[#111318] dark:text-white">Upload PNG Image</h2>
                <button onclick="closeUploadModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>
            
            <form id="uploadForm" method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <div id="uploadMessage" class="hidden mb-4 p-4 rounded-lg"></div>
                
                <div class="space-y-5">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-bold text-[#111318] dark:text-white mb-2">Title *</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-gray-900 text-[#111318] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter image title">
                        <span class="text-red-500 text-sm error-message" id="title-error"></span>
                    </div>

                    <!-- Image File -->
                    <div>
                        <label class="block text-sm font-bold text-[#111318] dark:text-white mb-2">Image File (PNG only, max 5MB) *</label>
                        <input type="file" name="image" accept=".png" required class="w-full px-4 py-3 rounded-lg border-gray-200 dark:border-gray-700 bg-background-light dark:bg-gray-900 text-[#111318] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                        <span class="text-red-500 text-sm error-message" id="image-error"></span>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-bold text-[#111318] dark:text-white mb-2">Category *</label>
                        <select name="category_id" required class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-gray-900 text-[#111318] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Select a category</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-red-500 text-sm error-message" id="category_id-error"></span>
                    </div>

                    <!-- License -->
                    <div>
                        <label class="block text-sm font-bold text-[#111318] dark:text-white mb-2">License *</label>
                        <select name="license_id" required class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-gray-900 text-[#111318] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Select a license</option>
                            @foreach(\App\Models\License::all() as $license)
                                <option value="{{ $license->id }}">{{ $license->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-red-500 text-sm error-message" id="license_id-error"></span>
                    </div>

                    <!-- Background Type -->
                    <div>
                        <label class="block text-sm font-bold text-[#111318] dark:text-white mb-2">Background Type *</label>
                        <select name="background_type" required class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-gray-900 text-[#111318] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Select background type</option>
                            <option value="transparent">Transparent</option>
                            <option value="colored">Colored</option>
                        </select>
                        <span class="text-red-500 text-sm error-message" id="background_type-error"></span>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label class="block text-sm font-bold text-[#111318] dark:text-white mb-2">Tags (comma-separated)</label>
                        <input type="text" name="tags" class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-gray-900 text-[#111318] dark:text-white focus:outline-none focus:ring-2 focus:ring-primary" placeholder="e.g. business, icon, logo">
                        <span class="text-red-500 text-sm error-message" id="tags-error"></span>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeUploadModal()" class="flex-1 h-12 bg-gray-200 dark:bg-gray-700 text-[#111318] dark:text-white rounded-lg font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" id="uploadBtn" class="flex-1 h-12 bg-primary text-white rounded-lg font-bold hover:bg-primary/90 transition-colors">
                        Upload Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dropdown toggle
        document.querySelectorAll('.dropdown-trigger').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('hidden');
            });
        });

        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

        function openUploadModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('uploadForm').reset();
            document.getElementById('uploadMessage').classList.add('hidden');
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        }

        document.getElementById('uploadForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const uploadBtn = document.getElementById('uploadBtn');
            const messageDiv = document.getElementById('uploadMessage');
            
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            messageDiv.classList.add('hidden');
            
            uploadBtn.disabled = true;
            uploadBtn.textContent = 'Uploading...';
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    messageDiv.textContent = data.message || 'Image uploaded successfully!';
                    messageDiv.className = 'mb-4 p-4 rounded-lg bg-green-100 text-green-700';
                    messageDiv.classList.remove('hidden');
                    
                    setTimeout(() => {
                        closeUploadModal();
                        window.location.reload();
                    }, 1500);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorEl = document.getElementById(`${key}-error`);
                            if (errorEl) {
                                errorEl.textContent = data.errors[key][0];
                            }
                        });
                    }
                    
                    messageDiv.textContent = data.message || 'Error uploading image';
                    messageDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
                    messageDiv.classList.remove('hidden');
                }
            } catch (error) {
                messageDiv.textContent = 'Network error. Please try again.';
                messageDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
                messageDiv.classList.remove('hidden');
            } finally {
                uploadBtn.disabled = false;
                uploadBtn.textContent = 'Upload Image';
            }
        });
    </script>
</body>
</html>
