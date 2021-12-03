<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'photo',
    ];

    public static $validatePassword = [
        'old_password' => ['required', 'string', 'min: 8'],
        'password' => ['required', 'confirmed', 'string', 'min: 8'],
    ];

    public static $validatePhoto = [
        'photo' => ['mimes:jpeg,jpg,png,gif,webp', 'required', 'max:100',]
    ];

    public function updateProfilePhoto(Object $request)
    {
        $user  = $this::findOrFail(auth()->id());
        $image = $request->file('photo');
        if (file_exists($user->photo)) unlink($user->photo);

        $image_name      = date('YmdHis');
        $ext             = strtolower($image->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $upload_path     = 'public/images/users/';
        $image_url       = $upload_path . $image_full_name;
        $success         = $image->move($upload_path, $image_full_name);
        $user->photo     = $image_url;
        $userUpdate      = $user->save();

        $userUpdate
            ? session()->flash('success', 'User Photo Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateProfilePassword(Object $request)
    {
        $user = $this::findOrFail(auth()->id());

        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            session()->flash('success', 'User Password Updated Successfully!');
        } else {
            session()->flash('error', 'Something Went Wrong!');
        }
    }

    public function updateProfileInfo(Object $request)
    {
        $user  = $this::findOrFail(auth()->id());
        $user->name      = $request->name;
        $user->address   = $request->address;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $userUpdate      = $user->save();

        $userUpdate
            ? session()->flash('success', 'User Info Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
