<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $userObject;

    public function __construct()
    {
        $this->userObject = new User();
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('backend.admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return view('backend.admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->userObject->storeUser($request);
        return back();
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::select('id', 'name')->get();
        return view('backend.admin.users.edit', compact('user', 'roles'));
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
