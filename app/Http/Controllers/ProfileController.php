<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        $user->load(['roles', 'branch']);
        
        return view('profile.show', compact('user'));
    }

    /**
     * Display the profile settings page.
     */
    public function settings()
    {
        $user = Auth::user();
        $user->load(['roles', 'branch']);
        
        return view('profile.settings', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile_images'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile.settings')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Change user password.
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&].{8,12}$/'],
            'password_confirmation' => ['required', 'string'],
        ], [
            'password.regex' => 'Password must be 8-12 characters long, contain uppercase, lowercase, numbers, and symbols.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.settings')
            ->with('success', 'Password changed successfully!');
    }

    /**
     * Enable Two-Factor Authentication.
     */
    public function enable2FA(Request $request)
    {
        $user = Auth::user();
        
        // In a real implementation, this would integrate with Google Authenticator, Authy, etc.
        // For demo purposes, we'll simulate 2FA setup
        
        $user->update([
            'two_factor_enabled' => true,
            'two_factor_secret' => Str::random(32), // In real app, this would be a proper secret
        ]);

        return redirect()->route('profile.settings')
            ->with('success', 'Two-factor authentication enabled!');
    }

    /**
     * Disable Two-Factor Authentication.
     */
    public function disable2FA(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password is incorrect.']);
        }

        $user->update([
            'two_factor_enabled' => false,
            'two_factor_secret' => null,
        ]);

        return redirect()->route('profile.settings')
            ->with('success', 'Two-factor authentication disabled!');
    }

    /**
     * Generate backup codes for 2FA.
     */
    public function generateBackupCodes(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password is incorrect.']);
        }

        // Generate 10 backup codes
        $backupCodes = [];
        for ($i = 0; $i < 10; $i++) {
            $backupCodes[] = Str::random(6);
        }

        $user->update([
            'backup_codes' => json_encode($backupCodes),
        ]);

        return redirect()->route('profile.settings')
            ->with('success', 'Backup codes generated! Save these codes in a secure location.');
    }

    /**
     * Show the personal information page.
     */
    public function personalInfo()
    {
        $user = Auth::user();
        $user->load(['roles', 'branch']);
        
        return view('profile.personal-info', compact('user'));
    }

    /**
     * Show the change password page.
     */
    public function changePasswordPage()
    {
        $user = Auth::user();
        
        return view('profile.change-password', compact('user'));
    }

    /**
     * Show the two-factor authentication page.
     */
    public function twoFactorPage()
    {
        $user = Auth::user();
        
        return view('profile.two-factor', compact('user'));
    }

    /**
     * Show the backup codes page.
     */
    public function backupCodesPage()
    {
        $user = Auth::user();
        $backupCodes = $user->backup_codes ? json_decode($user->backup_codes, true) : [];
        
        return view('profile.backup-codes', compact('user', 'backupCodes'));
    }

    /**
     * Show password expired page.
     */
    public function passwordExpired()
    {
        $user = Auth::user();
        
        return view('profile.password-expired', compact('user'));
    }

    /**
     * Show 2FA setup page.
     */
    public function twoFactorSetup()
    {
        $user = Auth::user();
        
        return view('profile.2fa-setup', compact('user'));
    }
}
