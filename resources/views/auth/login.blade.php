<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - FEEDTAN DIGITAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        @media (min-width: 768px) {
            .login-container {
                flex-direction: row;
            }
        }
        
        .curved-shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #166534 0%, #14532d 100%);
            border-radius: 0 0 200px 0;
            z-index: 1;
        }
        
        .flame-icon {
            width: 40px;
            height: 40px;
            fill: currentColor;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="login-container">
        <!-- Left Panel - Welcome Section -->
        <div class="bg-gradient-to-br from-green-800 to-green-900 text-white flex-1 flex items-center justify-center p-8 relative overflow-hidden">
            <!-- Curved Shape Decoration -->
            <div class="curved-shape opacity-20"></div>
            
            <div class="text-center z-10 max-w-md">
                <!-- Logo -->
                <div class="flex items-center justify-center mb-8">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center p-2 shadow-lg">
                        <img src="/feedtan_logo.png" alt="FEEDTAN DIGITAL" class="h-full w-full object-contain">
                    </div>
                </div>
                
                <h1 class="text-4xl font-bold mb-4">Welcome Back!</h1>
                <p class="text-green-100 text-lg mb-8">To stay connected with us please login with your personal info.</p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="bg-white flex-1 flex items-center justify-center p-8 relative">
            <!-- Curved Shape Decoration -->
            <div class="curved-shape opacity-10"></div>
            
            <div class="w-full max-w-md z-10">
                <!-- Mobile Logo -->
                <div class="flex items-center justify-center mb-8 md:hidden">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center p-1 shadow-lg">
                        <img src="/feedtan_logo.png" alt="FEEDTAN DIGITAL" class="h-full w-full object-contain">
                    </div>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-800 mb-2">welcome</h1>
                <p class="text-gray-600 mb-8">Login in to your account to continue.</p>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email -->
                    <div class="mb-6">
                        <label for="login" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input 
                            id="login" 
                            name="login" 
                            type="email" 
                            value="{{ old('login') }}"
                            required 
                            autofocus
                            class="w-full px-4 py-3 bg-green-50 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                            placeholder="Enter your email"
                        >
                        @error('login')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            class="w-full px-4 py-3 bg-green-50 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                            placeholder="Enter your password"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Forgot Password -->
                    <div class="flex justify-end mb-6">
                        <a href="#" class="text-sm text-green-600 hover:text-green-500 transition-colors duration-200">
                            Forgot your password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-green-700 to-green-800 text-white font-semibold py-3 px-4 rounded-lg hover:from-green-800 hover:to-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-[1.02]"
                    >
                        LOG IN
                    </button>
                </form>

            

                            </div>
        </div>
    </div>
</body>
</html>
