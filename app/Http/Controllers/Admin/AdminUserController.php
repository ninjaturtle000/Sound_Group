<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('reviews');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('userid', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userid' => ['required', 'string', 'min:3', 'max:50', 'alpha_dash', 'unique:users,userid'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:7', 'max:25', 'regex:/^[0-9\+\-\s\(\)]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:500'],
            'role' => ['required', 'in:user,admin'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'userid.required' => 'User ID is mandatory and must be unique.',
            'name.required' => 'Name is mandatory.',
            'email.required' => 'Email-id is mandatory.',
            'phone.required' => 'Phone number is mandatory.',
            'address.required' => 'Address is mandatory.',
        ]);

        $user = User::create([
            'userid' => strtolower($validated['userid']),
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'role' => $validated['role'],
            'is_active' => true,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', "User '{$user->userid}' created successfully.");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'min:7', 'max:25', 'regex:/^[0-9\+\-\s\(\)]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:500'],
            'role' => ['required', 'in:user,admin'],
            'is_active' => ['nullable', 'boolean'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->name = $validated['name'];
        $user->email = strtolower($validated['email']);
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->role = $validated['role'];
        $user->is_active = $request->boolean('is_active', true);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', "User '{$user->userid}' updated successfully.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own administrator account.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User '{$name}' deleted successfully.");
    }

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User '{$user->userid}' has been {$status}.");
    }
}
