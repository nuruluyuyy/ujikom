<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{
    use AuthorizesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Menampilkan daftar admin
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $admins = User::where('is_admin', true)
            ->orWhere('is_super_admin', true)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.users.index', compact('admins'));
    }

    /**
     * Menampilkan form tambah admin
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('admin.users.create');
    }

    /**
     * Menyimpan admin baru
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_super_admin' => ['sometimes', 'boolean'],
        ]);

        $isFirstAdmin = User::where('is_admin', true)
            ->orWhere('is_super_admin', true)
            ->count() === 0;
        
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
            'is_super_admin' => $isFirstAdmin ? true : ($validated['is_super_admin'] ?? false),
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit admin
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mengupdate data admin
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_super_admin' => ['sometimes', 'boolean'],
        ]);

        $updateData = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        // Hanya super admin yang bisa mengubah status super admin
        if (auth()->user()->is_super_admin) {
            $updateData['is_super_admin'] = $validated['is_super_admin'] ?? false;
        }

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data admin berhasil diperbarui');
    }

    /**
     * Menghapus admin
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        // Mencegah menghapus akun sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri');
        }

        // Mencegah menghapus super admin pertama
        $firstSuperAdmin = User::where('is_super_admin', true)
            ->orderBy('id', 'asc')
            ->first();
            
        if ($firstSuperAdmin && $firstSuperAdmin->id === $user->id) {
            return back()->with('error', 'Akun super admin pertama tidak dapat dihapus');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}