@extends('layouts.app')

@section('title', 'Backup Codes')
@section('page-title', 'Backup Codes')
@section('page-description', 'Manage your 2FA backup codes for account recovery')

@section('content')
<div class="max-w-4xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white p-8">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">Backup Codes</h1>
                    <p class="text-orange-100">Manage your 2FA backup codes for account recovery</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Warning Message -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Important Security Notice</h3>
                        <p class="text-sm text-yellow-700 mb-3">
                            Backup codes are one-time use codes that allow you to access your account if you lose access to your authenticator app. Each code can only be used once.
                        </p>
                        <ul class="text-sm text-yellow-700 space-y-1">
                            <li>• Store these codes in a secure location (safe, encrypted file, etc.)</li>
                            <li>• Don't store them on your computer or phone</li>
                            <li>• Each code can only be used once</li>
                            <li>• Generate new codes if you suspect they've been compromised</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Current Backup Codes -->
            @if($backupCodes && count($backupCodes) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Your Backup Codes
                    </h3>
                    
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            @foreach($backupCodes as $index => $code)
                                <div class="bg-white border border-gray-300 rounded-lg p-3 text-center">
                                    <div class="font-mono text-lg font-bold text-gray-900">{{ $code }}</div>
                                    <div class="text-xs text-gray-500 mt-1">Code {{ $index + 1 }}</div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">{{ count($backupCodes) }}</span> codes available
                            </div>
                            <button onclick="downloadBackupCodes()" class="text-sm text-orange-600 hover:text-orange-500 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Codes
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Backup Codes -->
                <div class="text-center py-12 mb-8">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Backup Codes Generated</h3>
                    <p class="text-gray-600 mb-6">You haven't generated backup codes yet. Generate them now to ensure you can access your account if you lose your authenticator app.</p>
                </div>
            @endif

            <!-- Generate New Codes -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Generate New Backup Codes
                </h3>
                
                <form method="POST" action="{{ route('profile.generate-backup-codes') }}" class="space-y-4 max-w-md">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" 
                               name="password" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                               required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-red-800 mb-2">⚠️ Important</h4>
                        <p class="text-sm text-red-700">Generating new backup codes will invalidate all existing codes. Make sure you save the new codes in a secure location.</p>
                    </div>

                    <button type="submit" class="bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">
                        Generate New Codes
                    </button>
                </form>
            </div>

            <!-- How to Use Backup Codes -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    How to Use Backup Codes
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h4 class="font-semibold text-blue-900 mb-4">During Login</h4>
                        <ol class="text-sm text-blue-800 space-y-2">
                            <li class="flex items-start space-x-2">
                                <span class="font-medium">1.</span>
                                <span>Enter your username and password</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="font-medium">2.</span>
                                <span>When prompted for 2FA, click "Use backup code"</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="font-medium">3.</span>
                                <span>Enter one of your backup codes</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="font-medium">4.</span>
                                <span>Access your account successfully</span>
                            </li>
                        </ol>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <h4 class="font-semibold text-green-900 mb-4">After Using a Code</h4>
                        <ul class="text-sm text-green-800 space-y-2">
                            <li class="flex items-start space-x-2">
                                <svg class="w-4 h-4 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>The code becomes invalid after one use</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <svg class="w-4 h-4 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Generate new codes when running low</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <svg class="w-4 h-4 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Re-enable 2FA on your device as soon as possible</span>
                            </li>
                        </ul>
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
                <a href="{{ route('profile.two-factor-page') }}" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                    2FA Settings
                </a>
                <a href="{{ route('profile.settings') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                    Back to Settings
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function downloadBackupCodes() {
    const codes = [
        @foreach($backupCodes as $code)
            '{{ $code }}',
        @endforeach
    ];
    
    const content = `FEEDTAN DIGITAL - Backup Codes\n` +
                   `Generated: ${new Date().toLocaleString()}\n` +
                   `User: {{ Auth::user()->email }}\n\n` +
                   `Backup Codes:\n` +
                   codes.map((code, index) => `${index + 1}. ${code}`).join('\n') +
                   `\n\nStore these codes in a secure location.`;
    
    const blob = new Blob([content], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'backup-codes.txt';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}
</script>
@endsection
