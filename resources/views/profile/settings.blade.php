@extends('layouts.app')

@section('title', 'Profile Settings')
@section('page-title', 'Profile Settings')
@section('page-description', 'Manage your account security and preferences')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Quick Actions Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Personal Information -->
        <a href="{{ route('profile.personal-info') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 group">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors duration-200">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600">Personal Information</h3>
                <p class="text-sm text-gray-600 mt-2">Update your personal details</p>
            </div>
        </a>

        <!-- Change Password -->
        <a href="{{ route('profile.change-password-page') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 group">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors duration-200">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h6m2 4h6a2 2 0 012-2v6a2 2 0 01-2 2H6a2 2 0 00-2-2v6a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600">Change Password</h3>
                <p class="text-sm text-gray-600 mt-2">Update your password</p>
            </div>
        </a>

        <!-- Two-Factor Authentication -->
        <a href="{{ route('profile.two-factor-page') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 group">
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors duration-200">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h6m2 4h6a2 2 0 012-2v6a2 2 0 01-2 2H6a2 2 0 00-2-2v6a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600">Two-Factor Auth</h3>
                <p class="text-sm text-gray-600 mt-2">Manage 2FA settings</p>
            </div>
        </a>

        <!-- Backup Codes -->
        <a href="{{ route('profile.backup-codes-page') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 group">
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors duration-200">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-600">Backup Codes</h3>
                <p class="text-sm text-gray-600 mt-2">Manage recovery codes</p>
            </div>
        </a>
    </div>

    <!-- Security Status Overview -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Security Status</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Password Status -->
            <div class="text-center">
                <div class="w-12 h-12 @if($user->password_changed_at && $user->password_changed_at->diffInDays(now()) < 90) bg-green-100 @else bg-red-100 @endif rounded-full flex items-center justify-center mx-auto mb-3">
                    @if($user->password_changed_at && $user->password_changed_at->diffInDays(now()) < 90)
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-900">Password</h3>
                <p class="text-sm @if($user->password_changed_at && $user->password_changed_at->diffInDays(now()) < 90) text-green-600 @else text-red-600 @endif">
                    @if($user->password_changed_at && $user->password_changed_at->diffInDays(now()) < 90)
                        Strong
                    @else
                        Expired
                    @endif
                </p>
            </div>

            <!-- 2FA Status -->
            <div class="text-center">
                <div class="w-12 h-12 @if($user->two_factor_enabled ?? false) bg-green-100 @else bg-red-100 @endif rounded-full flex items-center justify-center mx-auto mb-3">
                    @if($user->two_factor_enabled ?? false)
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-900">Two-Factor Auth</h3>
                <p class="text-sm @if($user->two_factor_enabled ?? false) text-green-600 @else text-red-600 @endif">
                    @if($user->two_factor_enabled ?? false)
                        Enabled
                    @else
                        Disabled
                    @endif
                </p>
            </div>

            <!-- Backup Codes Status -->
            <div class="text-center">
                <div class="w-12 h-12 @if($user->backup_codes) bg-green-100 @else bg-yellow-100 @endif rounded-full flex items-center justify-center mx-auto mb-3">
                    @if($user->backup_codes)
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-900">Backup Codes</h3>
                <p class="text-sm @if($user->backup_codes) text-green-600 @else text-yellow-600 @endif">
                    @if($user->backup_codes)
                        Available
                    @else
                        Not Generated
                    @endif
                </p>
            </div>

            <!-- Profile Completion -->
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Profile</h3>
                <p class="text-sm text-blue-600">Complete</p>
            </div>
        </div>
    </div>

    <!-- Security Features Overview -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Security Features Enabled</h2>
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
</div>
@endsection
