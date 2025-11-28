<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Sign Up — RedPNG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ef4444',
                    },
                    fontFamily: {
                        display: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="font-display bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
        <!-- Left Side: Illustration -->
        <div class="lg:w-2/5 bg-gradient-to-br from-red-500 via-pink-500 to-red-600 p-12 flex flex-col justify-center items-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10 text-center space-y-6">
                <div class="flex justify-center">
                    <svg class="w-32 h-32" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="40" y="40" width="120" height="120" rx="20" fill="white" opacity="0.9"/>
                        <path d="M80 100L100 120L140 80" stroke="#ef4444" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="160" cy="60" r="15" fill="white" opacity="0.7"/>
                        <path d="M160 50L160 70M150 60L170 60" stroke="#ef4444" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold leading-tight">Welcome to RedPNG</h1>
                <p class="text-lg opacity-90 max-w-sm mx-auto">
                    Save PNGs. Upload PNGs. Free forever on RedPNG.
                </p>
            </div>
        </div>

        <!-- Right Side: Forms -->
        <div class="lg:w-3/5 p-8 md:p-12">
            <div class="max-w-md mx-auto">
                <!-- Tab Switcher -->
                <div class="flex gap-2 mb-8 bg-gray-100 p-1 rounded-lg">
                    <button onclick="switchTab('login')" id="loginTab" class="flex-1 py-3 px-6 rounded-lg font-semibold transition-all bg-white text-gray-900 shadow-sm">
                        Login
                    </button>
                    <button onclick="switchTab('signup')" id="signupTab" class="flex-1 py-3 px-6 rounded-lg font-semibold transition-all text-gray-600 hover:text-gray-900">
                        Sign Up
                    </button>
                </div>

                <!-- Messages -->
                <div id="authMessage" class="hidden mb-4 p-4 rounded-lg"></div>

                <!-- Login Form -->
                <form id="loginForm" class="space-y-5">
                    @csrf
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Welcome back!</h2>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" placeholder="your@email.com">
                        <span class="text-red-500 text-sm error-message" id="login-email-error"></span>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" placeholder="••••••••">
                        <span class="text-red-500 text-sm error-message" id="login-password-error"></span>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm font-medium text-red-600 hover:text-red-700">Forgot password?</a>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold text-lg hover:bg-red-600 transition-colors shadow-lg shadow-red-500/30">
                        Login
                    </button>
                </form>

                <!-- Sign Up Form -->
                <form id="signupForm" class="space-y-5 hidden">
                    @csrf
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Create an account</h2>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" placeholder="John Doe">
                        <span class="text-red-500 text-sm error-message" id="signup-name-error"></span>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" placeholder="your@email.com">
                        <span class="text-red-500 text-sm error-message" id="signup-email-error"></span>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" placeholder="••••••••">
                        <span class="text-red-500 text-sm error-message" id="signup-password-error"></span>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" placeholder="••••••••">
                    </div>

                    <div>
                        <label class="flex items-start">
                            <input type="checkbox" required class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mt-1">
                            <span class="ml-2 text-sm text-gray-600">
                                I agree to RedPNG <a href="#" class="text-red-600 hover:text-red-700 font-medium">Terms of Service</a> and <a href="#" class="text-red-600 hover:text-red-700 font-medium">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold text-lg hover:bg-red-600 transition-colors shadow-lg shadow-red-500/30">
                        Create Account
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-600">
                    <a href="/" class="text-red-600 hover:text-red-700 font-medium">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const loginTab = document.getElementById('loginTab');
            const signupTab = document.getElementById('signupTab');
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            const messageDiv = document.getElementById('authMessage');

            // Clear messages and errors
            messageDiv.classList.add('hidden');
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

            if (tab === 'login') {
                loginTab.className = 'flex-1 py-3 px-6 rounded-lg font-semibold transition-all bg-white text-gray-900 shadow-sm';
                signupTab.className = 'flex-1 py-3 px-6 rounded-lg font-semibold transition-all text-gray-600 hover:text-gray-900';
                loginForm.classList.remove('hidden');
                signupForm.classList.add('hidden');
            } else {
                signupTab.className = 'flex-1 py-3 px-6 rounded-lg font-semibold transition-all bg-white text-gray-900 shadow-sm';
                loginTab.className = 'flex-1 py-3 px-6 rounded-lg font-semibold transition-all text-gray-600 hover:text-gray-900';
                signupForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            }
        }

        // Login form handler
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const messageDiv = document.getElementById('authMessage');
            const submitBtn = e.target.querySelector('button[type="submit"]');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Logging in...';
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

            try {
                const response = await fetch('{{ route("login") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    messageDiv.className = 'mb-4 p-4 rounded-lg bg-green-100 text-green-800';
                    messageDiv.textContent = data.message;
                    messageDiv.classList.remove('hidden');
                    setTimeout(() => window.location = data.redirect, 1000);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorEl = document.getElementById(`login-${key}-error`);
                            if (errorEl) errorEl.textContent = data.errors[key][0];
                        });
                    }
                    messageDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-800';
                    messageDiv.textContent = data.message;
                    messageDiv.classList.remove('hidden');
                }
            } catch (error) {
                messageDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-800';
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Login';
            }
        });

        // Sign up form handler
        document.getElementById('signupForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const messageDiv = document.getElementById('authMessage');
            const submitBtn = e.target.querySelector('button[type="submit"]');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating account...';
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

            try {
                const response = await fetch('{{ route("register") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    messageDiv.className = 'mb-4 p-4 rounded-lg bg-green-100 text-green-800';
                    messageDiv.textContent = data.message;
                    messageDiv.classList.remove('hidden');
                    setTimeout(() => window.location = data.redirect, 1000);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorEl = document.getElementById(`signup-${key}-error`);
                            if (errorEl) errorEl.textContent = data.errors[key][0];
                        });
                    }
                    messageDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-800';
                    messageDiv.textContent = data.message || 'Registration failed.';
                    messageDiv.classList.remove('hidden');
                }
            } catch (error) {
                messageDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-800';
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Create Account';
            }
        });
    </script>
</body>
</html>
