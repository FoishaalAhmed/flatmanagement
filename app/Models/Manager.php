<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Manager extends Model
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
        'building_id',
    ];

    public function storeManager(Object $request)
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

        $this->name        = $request->name;
        $this->email       = $request->email;
        $this->phone       = $request->phone;
        $this->address     = $request->address;
        $this->password    = Hash::make($request->password);
        $managerStore      = $this->save();

        foreach ($request->building_id as $key => $value) {
            $category_data[] = [
                'user_id' => $this->id,
                'building_id' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        BuildingUser::insert($category_data);

        $manager = User::findOrFail($this->id);
        $role = Role::where('name', 'Manager')->first();
        $manager->assignRole($role);

        $managerStore
            ? session()->flash('success', 'New Manager Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateManager(Object $request, Object $manager)
    {
        $image = $request->file('photo');
        if ($image) {

            if (file_exists($manager->photo)) unlink($manager->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $manager->photo     = $image_url;
        }

        $manager->name     = $request->name;
        $manager->email    = $request->email;
        $manager->phone    = $request->phone;
        $manager->address  = $request->address;
        $managerUpdate     = $manager->save();
        BuildingUser::where('user_id', $manager->id)->delete();
        foreach ($request->building_id as $key => $value) {
            $data[] = [
                'user_id' => $manager->id,
                'building_id' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        BuildingUser::insert($data);

        $managerUpdate
            ? session()->flash('success', 'Manager Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyManager(Object $manager)
    {
        if (file_exists($manager->photo)) unlink($manager->photo);
        $manager->removeRole($manager->roles->first());
        $managerDelete = $manager->delete();

        $managerDelete
            ? session()->flash('success', 'Manager Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
