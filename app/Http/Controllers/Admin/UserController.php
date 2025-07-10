<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)  // <-- ✅ Add Request $request
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function suspend(User $user)
    {
        $user->is_suspended = true;
        $user->save();

        return back()->with('success', 'User suspended successfully.');
    }

    public function enable(User $user)
    {
        $user->is_suspended = false;
        $user->save();

        return back()->with('success', 'User enabled successfully.');
    }
}
