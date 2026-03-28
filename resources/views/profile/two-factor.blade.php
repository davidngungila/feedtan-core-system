@extends('layouts.app')

@section('title', 'Two-Factor Authentication')
@section('page-title', 'Two-Factor Authentication')
@section('page-description', 'Manage your 2FA settings for enhanced security')

@section('content')
<div class="max-w-4xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white p-8">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h6m2 4h6a2 2 0 012-2v6a2 2 0 01-2 2H6a2 2 0 00-2-2v6a2 2 0 002 2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">Two-Factor Authentication</h1>
                    <p class="text-purple-100">Manage your 2FA settings for enhanced security</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- 2FA Status -->
            <div class="mb-8">
                <div class="@if($user->two_factor_enabled ?? false) bg-green-50 border-green-200 @else bg-red-50 border-red-200 @endif border rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 @if($user->two_factor_enabled ?? false) bg-green-100 @else bg-red-100 @endif rounded-full flex items-center justify-center">
                                @if($user->two_factor_enabled ?? false)
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @else
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xl font-bold @if($user->two_factor_enabled ?? false) text-green-800 @else text-red-800 @endif">
                                    2FA Status: @if($user->two_factor_enabled ?? false) Enabled @else Disabled @endif
                                </h3>
                                <p class="@if($user->two_factor_enabled ?? false) text-green-700 @else text-red-700 @endif">
                                    @if($user->two_factor_enabled ?? false)
                                        Your account is protected with two-factor authentication
                                    @else
                                        Your account is not protected with two-factor authentication
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            @if($user->two_factor_enabled ?? false)
                                <form method="POST" action="{{ route('profile.disable-2fa') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                                        Disable 2FA
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('profile.2fa-setup') }}" class="inline-block bg-green-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                                    Enable 2FA
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2FA Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- What is 2FA -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        What is Two-Factor Authentication?
                    </h3>
                    <p class="text-sm text-blue-800 mb-4">
                        Two-factor authentication (2FA) adds an extra layer of security to your account by requiring a second form of verification in addition to your password.
                    </p>
                    <ul class="text-sm text-blue-800 space-y-2">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Prevents unauthorized access</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Protects against password breaches</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Required for admin accounts</span>
                        </li>
                    </ul>
                </div>

                <!-- How it Works -->
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        How it Works
                    </h3>
                    <ol class="text-sm text-purple-800 space-y-3">
                        <li class="flex items-start space-x-3">
                            <span class="font-bold text-purple-600">1.</span>
                            <span>Enter your password as usual</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="font-bold text-purple-600">2.</span>
                            <span>Open your authenticator app to get a 6-digit code</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="font-bold text-purple-600">3.</span>
                            <span>Enter the code to complete login</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="font-bold text-purple-600">4.</span>
                            <span>Use backup codes if you lose access to your app</span>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Supported Apps -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Supported Authenticator Apps</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <span class="text-blue-600 font-bold">GA</span>
                        </div>
                        <h4 class="font-semibold text-gray-900">Google Authenticator</h4>
                        <p class="text-xs text-gray-600 mt-1">Free & reliable</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <span class="text-red-600 font-bold">A</span>
                        </div>
                        <h4 class="font-semibold text-gray-900">Authy</h4>
                        <p class="text-xs text-gray-600 mt-1">Cloud backup</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <span class="text-purple-600 font-bold">M</span>
                        </div>
                        <h4 class="font-semibold text-gray-900">Microsoft Authenticator</h4>
                        <p class="text-xs text-gray-600 mt-1">Microsoft ecosystem</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <span class="text-green-600 font-bold">1P</span>
                        </div>
                        <h4 class="font-semibold text-gray-900">1Password</h4>
                        <p class="text-xs text-gray-600 mt-1">All-in-one solution</p>
                    </div>
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

            <!-- Quick Actions -->
            <div class="flex justify-center space-x-4 mt-8">
                <a href="{{ route('profile.backup-codes-page') }}" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                    Manage Backup Codes
                </a>
                <a href="{{ route('profile.settings') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                    Back to Settings
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
