<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function ban(User $user)
    {
        $user->update(['banned' => true]); // extra field kerak bo‘ladi
        return back();
    }
}
