<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        $users = User::where('is_admin', true)->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_super_admin' => ['boolean'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
            'is_super_admin' => $validated['is_super_admin'] ?? false,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit(User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_super_admin' => ['boolean'],
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_super_admin' => $validated['is_super_admin'] ?? false,
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data admin berhasil diperbarui');
    }

    /**
     * Toggle block status of the specified admin.
     */
    public function toggleBlock(User $user)
    {
        if (!$user->is_admin || $user->id === auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Admin berhasil $status");
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(User $user)
    {
        if (!$user->is_admin || $user->id === auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}
