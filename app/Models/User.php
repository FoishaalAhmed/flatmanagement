<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function storeUser(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->name      = $request->name;
        $this->email     = $request->email;
        $this->phone     = $request->phone;
        $this->address   = $request->address;
        $this->password  = Hash::make($request->password);
        $userStore       = $this->save();

        $user_info = $this::findOrFail($this->id);
        $role = Role::where('name', 'Admin')->first();
        $user_info->assignRole($role);

        $userStore
            ? session()->flash('success', 'New User Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateUser(Object $request, Object $user)
    {
        $image = $request->file('photo');
        if ($image) {

            if (file_exists($user->photo)) unlink($user->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $user->photo     = $image_url;
        }

        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $user->address   = $request->address;
        $userUpdate      = $user->save();

        $userUpdate
            ? session()->flash('success', 'User Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyUser(Object $user)
    {
        if (file_exists($user->photo)) unlink($user->photo);
        $user->removeRole($user->roles->first());
        $userDelete = $user->delete();

        $userDelete
            ? session()->flash('success', 'User Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
