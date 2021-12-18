<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'name', 'email', 'phone', 'present_address', 'permanent_address', 'photo',
    ];

    public function getCommittees()
    {
        $committees = $this::join('buildings', 'committees.building_id', '=', 'buildings.id')
            ->orderBy('buildings.name', 'asc')
            ->orderBy('committees.name', 'asc')
            ->select('committees.*', 'buildings.name as building')
            ->get();
        return $committees;
    }

    public function storeCommittee(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/committees/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->building_id = $request->building_id;
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->present_address = $request->present_address;
        $this->permanent_address = $request->permanent_address;
        $storeCommittee = $this->save();

        $user = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->address     = $request->permanent_address;
        $user->password    = Hash::make($request->password);
        $user->committee_id = $this->id;
        $user->save();

        $committeeInfo = User::where('committee_id', $this->id)->firstOrFail();
        $role = Role::where('name', 'Committee')->first();
        $committeeInfo->assignRole($role);

        $storeCommittee
            ? session()->flash('success', 'New Committee Member Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCommittee(Object $request, Object $committee)
    {
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($committee->photo)) unlink($committee->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/committees/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $committee->photo = $image_url;
        }

        $committee->building_id = $request->building_id;
        $committee->name = $request->name;
        $committee->email = $request->email;
        $committee->phone = $request->phone;
        $committee->present_address = $request->present_address;
        $committee->permanent_address = $request->permanent_address;
        $updateCommittee = $committee->save();

        $updateCommittee
            ? session()->flash('success', 'Committee Member Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCommittee(Object $committee)
    {
        $user = User::where('committee_id', $committee->id)->firstOrFail();
        if (file_exists($committee->photo)) unlink($committee->photo);
        if (file_exists($user->photo)) unlink($user->photo);
        $user->removeRole($user->roles->first());
        $user->delete();
        $destroyCommittee = $committee->save();

        $destroyCommittee
            ? session()->flash('success', 'Committee Member Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
