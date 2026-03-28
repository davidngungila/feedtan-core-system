@extends('layouts.app')

@section('title', 'Two-Factor Authentication Setup')
@section('page-title', '2FA Setup')
@section('page-description', 'Configure two-factor authentication for enhanced security')

@section('content')
<div class="max-w-4xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h6m2 4h6a2 2 0 012-2v6a2 2 0 01-2 2H6a2 2 0 00-2-2v6a2 2 0 002 2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-4">Two-Factor Authentication Setup</h1>
                <p class="text-green-100 text-lg">Enhance your account security with 2FA protection</p>
            </div>
        </div>

        <div class="p-8">
            <!-- QR Code Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- QR Code -->
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Scan QR Code</h3>
                    <div class="bg-gray-100 p-8 rounded-xl inline-block">
                        <!-- Real QR Code using Google Charts API -->
                        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=otpauth://totp/FEEDTAN%20DIGITAL:{{ Auth::user()->email }}?secret={{ Str::random(32) }}&issuer=FEEDTAN%20DIGITAL" 
                             alt="2FA QR Code" 
                             class="w-48 h-48 border-4 border-white rounded-lg shadow-lg">
                    </div>
                    <p class="text-sm text-gray-600 mt-4">Use Google Authenticator, Authy, or any TOTP app</p>
                </div>

                <!-- Manual Entry -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Or Enter Code Manually</h3>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Secret Key</label>
                                <div class="bg-white border border-gray-300 rounded-lg px-4 py-3 font-mono text-lg text-center">
                                    {{ Str::random(32) }}
                                </div>
                                <button onclick="copySecret()" class="mt-2 text-sm text-green-600 hover:text-green-500 font-medium">
                                    Copy to clipboard
                                </button>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Account Name</label>
                                <div class="bg-white border border-gray-300 rounded-lg px-4 py-2">
                                    FEEDTAN DIGITAL:{{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-blue-900 mb-4">Verify Setup</h3>
                <form method="POST" action="{{ route('profile.enable-2fa') }}" class="space-y-4 max-w-md">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-2">Enter 6-digit code from your app</label>
                        <input type="text" 
                               name="auth_code" 
                               class="w-full px-4 py-3 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-xl font-mono"
                               placeholder="000000"
                               maxlength="6"
                               required>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Enable Two-Factor Authentication
                    </button>
                </form>
            </div>

            <!-- Instructions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-600 font-bold">1</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Download App</h4>
                    <p class="text-sm text-gray-600">Get Google Authenticator, Authy, or any TOTP app</p>
                </div>
                
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-600 font-bold">2</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Scan QR Code</h4>
                    <p class="text-sm text-gray-600">Point your camera at the QR code above</p>
                </div>
                
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-600 font-bold">3</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Verify Code</h4>
                    <p class="text-sm text-gray-600">Enter the 6-digit code to complete setup</p>
                </div>
            </div>

            <!-- Security Features -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Security Features Enabled</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-green-800">🔒 Password Hashing</h4>
                                <p class="text-sm text-green-700">bcrypt / Argon2 encryption</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-yellow-800">🚫 Prevent Reuse</h4>
                                <p class="text-sm text-yellow-700">Old passwords never reused</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h6m2 4h6a2 2 0 012-2v6a2 2 0 01-2 2H6a2 2 0 00-2-2v6a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-purple-800">🔑 Two-Factor Auth</h4>
                                <p class="text-sm text-purple-700">TOTP & backup codes</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-red-800">🔢 OTP Login</h4>
                                <p class="text-sm text-red-700">Secure token verification</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 border border-gray-300 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800">🔁 Password Reset</h4>
                                <p class="text-sm text-gray-700">Secure token with expiry</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h6m2 4h6a2 2 0 012-2v6a2 2 0 01-2 2H6a2 2 0 00-2-2v6a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-indigo-800">🔑 2FA Options</h4>
                                <p class="text-sm text-indigo-700">Authenticator app support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Warning -->
            @if(Auth::user()->roles->first()->slug === 'super-admin')
                <div class="mt-8 bg-red-100 border border-red-300 rounded-lg p-6">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div>
                            <h4 class="text-lg font-semibold text-red-800 mb-2">⚠️ Admin Security Requirement</h4>
                            <p class="text-sm text-red-700">As a Super Administrator, 2FA is mandatory for security compliance. Please complete the setup to continue accessing admin features.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function copySecret() {
    const secretElement = document.querySelector('.font-mono.text-lg');
    const secret = secretElement.textContent;
    
    navigator.clipboard.writeText(secret).then(function() {
        // Show success message
        const button = event.target;
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        button.classList.add('text-green-500');
        
        setTimeout(function() {
            button.textContent = originalText;
            button.classList.remove('text-green-500');
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endsection
