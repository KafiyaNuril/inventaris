<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->get();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $role = $request->role;
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required|in:admin,operator',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('emai1'),
        ]);

        $plainPassword = substr($request->email, 0, 4) . $user->id;

        $user->update([
            'password' => Hash::make($plainPassword),
            'password_plain' => $plainPassword,
        ]);

        return redirect()->back()->with('success', 'User added succeccfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
                'password_plain' => null
            ]);
        }

        if(Auth::user()->role == 'admin') {
            return redirect()->route('user.index', ['role' => $request->role])->with('success', 'User updated successfully');
        }

        return redirect()->back()->with('success', 'User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User delete succeccfully');
    }

    public function resetPassword(string $id)
    {
        $user = User::findOrFail($id);

        $plainPassword = substr($request->email, 0, 4) . $user->id;

        $user->update([
            'password' => Hash::make($plainPassword),
            'password_plain' => $plainPassword,
        ]);

        return redirect()->back()->with('success', 'Reset Password user succeccfully');
    }
}
