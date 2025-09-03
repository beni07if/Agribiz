<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ✅ Tampilkan semua user
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    // ✅ Simpan user baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['required', 'email', 'max:255', 'unique:users'],
            'role'     => ['nullable', 'string', 'max:50'],
            'level'    => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
            'profile_photo' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile', 'public');
        }

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
            'level'    => $request->level,
            'password' => Hash::make($request->password),
            'profile_photo' => $path,
        ]);

        return back()->with('success', 'User berhasil ditambahkan.');
    }

    // ✅ Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'     => ['required', 'string'],
            'level'    => ['required', 'string'],
            'profile_photo' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile', 'public');
            $user->profile_photo = $path;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->level = $request->level;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            Auth::logout();
            $user->delete();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/login')->with('success', 'Akun Anda berhasil dihapus.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

}