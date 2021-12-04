<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'floor_id', 'flat_id', 'name', 'email', 'phone', 'permanent_address', 'nid', 'advance', 'rent', 'issue_date', 'month', 'year', 'photo', 'status',
    ];

    public function getTenants()
    {
        $tenants = $this::join('buildings', 'tenants.building_id', '=', 'buildings.id')
            ->join('floors', 'tenants.floor_id', '=', 'floors.id')
            ->join('flats', 'tenants.flat_id', '=', 'flats.id')
            ->orderBy('buildings.name', 'asc')
            ->orderBy('floors.name', 'asc')
            ->orderBy('flats.name', 'asc')
            ->orderBy('tenants.name', 'asc')
            ->select('tenants.*', 'buildings.name as building', 'floors.name as floor', 'flats.name as flat')
            ->get();
        return $tenants;
    }

    public function storeTenant(Object $request)
    {
        $image = $request->file('photo');
        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/tenants/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }
        $this->building_id = $request->building_id;
        $this->floor_id = $request->floor_id;
        $this->flat_id = $request->flat_id;
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->permanent_address = $request->permanent_address;
        $this->nid = $request->nid;
        $this->advance = $request->advance;
        $this->rent = $request->rent;
        $this->issue_date = $request->issue_date;
        $this->month = $request->month;
        $this->year = $request->year;
        $storeTenant = $this->save();

        $user = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->address     = $request->permanent_address;
        $user->password    = Hash::make($request->password);
        $user->tenant_id   = $this->id;
        $user->save();

        $tenantInfo = User::where('tenant_id', $this->id)->firstOrFail();
        $role = Role::where('name', 'Tenant')->first();
        $tenantInfo->assignRole($role);

        $storeTenant
            ? session()->flash('success', 'New Tenant Info Stored Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateTenant(Object $request, Object $tenant)
    {
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($tenant->photo)) unlink($tenant->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/tenants/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $tenant->photo     = $image_url;
        }
        $tenant->building_id = $request->building_id;
        $tenant->floor_id = $request->floor_id;
        $tenant->flat_id = $request->flat_id;
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->permanent_address = $request->permanent_address;
        $tenant->nid = $request->nid;
        $tenant->advance = $request->advance;
        $tenant->rent = $request->rent;
        $tenant->issue_date = $request->issue_date;
        $tenant->month = $request->month;
        $tenant->year = $request->year;
        $updateTenant = $tenant->save();

        $updateTenant
            ? session()->flash('success', 'Tenant Info Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyTenant(Object $tenant)
    {
        $user = User::where('tenant_id', $tenant->id)->firstOrFail();
        if (file_exists($user->photo)) unlink($user->photo);
        if (file_exists($tenant->photo)) unlink($tenant->photo);
        $user->removeRole($user->roles->first());
        $user->delete();

        $destroyTenant = $tenant->delete();

        $destroyTenant
            ? session()->flash('success', 'Tenant Info Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
