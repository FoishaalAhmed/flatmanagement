<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    private $userObject;

    public function __construct()
    {
        $this->userObject = new User();
    }

    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('backend.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $this->userObject->storeUser($request);
        return back();
    }

    public function edit(User $user)
    {
        return view('backend.admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->userObject->updateUser($request, $user);
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $this->userObject->destroyUser($user);
        return back();
    }
}
