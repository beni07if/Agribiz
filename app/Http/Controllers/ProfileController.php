<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'     => ['nullable', 'string', 'max:50'],
            'level'    => ['nullable', 'string', 'max:50'],
            'profile_photo' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        // ✅ simpan foto jika ada upload baru
        if ($request->hasFile('profile_photo')) {
            // hapus foto lama kalau ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // simpan foto baru
            $path = $request->file('profile_photo')->store('profile', 'public');

            // update database
            $user->profile_photo = $path;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->level = $request->level;

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    // update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required', 'current_password'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password); // ✅ sekarang sudah ada Hash
        $user->save();

        return back()->with('success_password', 'Password berhasil diubah.');
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}