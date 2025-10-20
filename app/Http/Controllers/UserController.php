<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users (Admin only).
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nip', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }
        
        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        $users = $query->paginate(15);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:20|unique:users,nip',
            'role' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nip' => $request->nip,
            'role' => $request->role,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
                        ->with('success', 'User berhasil dibuat!');
    }

    /**
     * Display the specified user.
     */
    public function show($nip)
    {
        $user = User::findOrFail($nip);
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($nip)
    {
        $user = User::findOrFail($nip);
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $nip)
    {
        $user = User::findOrFail($nip);
        
        $request->validate([
            'nip' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->nip, 'nip')],
            'role' => 'required|string|max:50',
            'department' => 'required|string|max:100',
        ]);

        $user->update([
            'nip' => $request->nip,
            'role' => $request->role,
            'department' => $request->department,
        ]);

        return redirect()->route('users.show', $user->nip)
                        ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($nip)
    {
        $user = User::findOrFail($nip);
        
        // Prevent admin from deleting themselves
        if (auth()->user()->nip === $user->nip) {
            return redirect()->back()
                           ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }
        
        $user->delete();
        
        return redirect()->route('users.index')
                        ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Change user password (Admin only).
     */
    public function changePassword(Request $request, $nip)
    {
        $user = User::findOrFail($nip);
        
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()
                        ->with('success', 'Password berhasil diubah!');
    }

    /**
     * Show user profile.
     */
    public function profile()
    {
        $user = auth()->user();
        
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing user profile.
     */
    public function editProfile()
    {
        $user = auth()->user();
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'role' => 'required|string|max:50',
            'department' => 'required|string|max:100',
        ]);

        $user->update([
            'role' => $request->role,
            'department' => $request->department,
        ]);

        return redirect()->route('profile.show')
                        ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Change own password.
     */
    public function changeOwnPassword(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                           ->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()
                        ->with('success', 'Password berhasil diubah!');
    }
}
