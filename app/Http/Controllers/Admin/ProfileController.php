<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $admin = Auth::user();
        $adminData = $this->formatAdminData($admin);
        return view('admin.profile.index', compact('adminData'));
    }

    public function edit()
    {
        return view('admin.profile.edit', ['admin' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $admin = Auth::user();
        $validatedData = $this->validateRequest($request, $admin);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_pic')) {
            $validatedData['profile_pic'] = $this->handleProfilePicture($request, $admin);
        }

        $admin->update($validatedData);
        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    private function formatAdminData($admin)
    {
        return [
            'name' => $admin->name,
            'email' => $admin->email,
            'contact' => $admin->contact ?? 'Not Set',
            'address' => $admin->address ?? 'Not Set',
            'joining_date' => optional($admin->joiningdate)->format('d-M-Y') ?? 'Not Set',
            'amount' => $admin->setamount ? '₹' . number_format($admin->setamount, 2) : 'Not Set',
            'role' => ucfirst($admin->role),
            'profile_pic' => $admin->profile_pic,
        ];
    }

    private function validateRequest(Request $request, $admin)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$admin->id}",
            'contact' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'joiningdate' => 'nullable|date',
            'setamount' => 'nullable|numeric|min:0',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    }

    private function handleProfilePicture(Request $request, $admin)
    {
        if ($admin->profile_pic && Storage::disk('public')->exists($admin->profile_pic)) {
            Storage::disk('public')->delete($admin->profile_pic);
        }

        $directory = 'users_pic';
        Storage::disk('public')->makeDirectory($directory);
        
        $customFileName = "user_{$admin->id}_" . now()->timestamp . '.' . $request->file('profile_pic')->getClientOriginalExtension();
        return $request->file('profile_pic')->storeAs($directory, $customFileName, 'public');
    }
}
