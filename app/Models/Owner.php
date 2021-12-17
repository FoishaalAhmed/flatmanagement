<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'present_address', 'permanent_address', 'photo',
    ];

    public function flats()
    {
        return $this->belongsToMany('App\Models\Flat', 'flat_owners');
    }

    public function storeOwner(Object $request)
    {
        $image = $request->file('photo');
        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/owner/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->building_id = $request->building_id ;
        $this->name = $request->name ;
        $this->email = $request->email ;
        $this->phone = $request->phone ;
        $this->present_address = $request->present_address ;
        $this->permanent_address = $request->permanent_address ;
        $storeOwner = $this->save() ;

        foreach ($request->flat_id as $key => $value) {
            $flat_data[] = [
                'owner_id' => $this->id,
                'flat_id' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        FlatOwner::insert($flat_data);

        $user = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->address     = $request->permanent_address;
        $user->password    = Hash::make($request->password);
        $user->owner_id    = $this->id;
        $user->save();

        $ownerInfo = User::where('owner_id', $this->id)->firstOrFail();
        $role = Role::where('name', 'Owner')->first();
        $ownerInfo->assignRole($role);

        $storeOwner
            ? session()->flash('success', 'New Owner Info Stored Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateOwner(Object $request, Object $owner)
    {
        $image = $request->file('photo');
        if ($image) {
            if(file_exists($owner->photo)) unlink($owner->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/owner/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $owner->photo    = $image_url;
        }

        $owner->building_id = $request->building_id ;
        $owner->name = $request->name ;
        $owner->email = $request->email ;
        $owner->phone = $request->phone ;
        $owner->present_address = $request->present_address ;
        $owner->permanent_address = $request->permanent_address ;
        $updateOwner = $owner->save() ;

        FlatOwner::where('owner_id', $owner->id)->delete();
        foreach ($request->flat_id as $key => $value) {
            $flat_data[] = [
                'owner_id' => $owner->id,
                'flat_id' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        FlatOwner::insert($flat_data);

        $updateOwner
            ? session()->flash('success', 'Owner Info Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyOwner(Object $owner)
    {
        $user = User::where('owner_id', $owner->id)->firstOrFail();
        if (file_exists($user->photo)) unlink($user->photo);
        if(file_exists($owner->photo)) unlink($owner->photo);
        $user->removeRole($user->roles->first());
        $user->delete();
        $destroyOwner = $owner->delete() ;

        $destroyOwner
            ? session()->flash('success', 'Owner Info Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
