<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        return view('Admin.Users.index');
    }

    public function create(): View
    {
        return view('Admin.Users.create');
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function show(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user): View
    {
        return view('Admin.Users.edit', ['user' => $user]);
    }

    public function update(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }
}
