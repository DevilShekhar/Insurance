<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('designer.users.index', compact('users'));
    }

    public function create()
    {
        return view('designer.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|string|max:20',
            'gender' => 'required|string|max:20',
            'role' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'password' => 'required|confirmed|min:6',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
        ]);

        $profilePhotoPath = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('users', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'role' => $request->role,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('designer.users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('designer.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile_number' => 'required|string|max:20',
            'gender' => 'required|string|max:20',
            'role' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;
        $user->role = $request->role;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('users', 'public');
            $user->profile_photo = $profilePhotoPath;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (!empty($user->profile_photo)) {
            $filePath = public_path('storage/' . $user->profile_photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}