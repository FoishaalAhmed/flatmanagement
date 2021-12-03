<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'floor', 'flat', 'cctv', 'guard', 'parking', 'address', 'photo',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255'],
        'floor' => ['required', 'numeric', 'min: 1'],
        'flat' => ['required', 'numeric', 'min: 1'],
        'cctv' => ['required', 'numeric', 'between:0,1'],
        'guard' => ['required', 'numeric', 'between:0,1'],
        'parking' => ['required', 'numeric', 'between:0,1'],
        'address' => ['required', 'string'],
        'photo' => ['nullable', 'max: 100', 'mimes:jpeg,jpg,png,gif,webp'],
    ];

    public function storeBuilding(Object $request)
    {
        $image = $request->file('photo');
        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/buildings/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->name = $request->name;
        $this->floor = $request->floor;
        $this->flat = $request->flat;
        $this->cctv = $request->cctv;
        $this->guard = $request->guard;
        $this->parking = $request->parking;
        $this->address = $request->address;
        $storeBuilding = $this->save();

        $storeBuilding
            ? session()->flash('success', 'New Building Info Stored Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateBuilding(Object $request, Object $building)
    {
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($building->photo)) unlink($building->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/buildings/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $building->photo = $image_url;
        }

        $building->name = $request->name;
        $building->floor = $request->floor;
        $building->flat = $request->flat;
        $building->cctv = $request->cctv;
        $building->guard = $request->guard;
        $building->parking = $request->parking;
        $building->address = $request->address;
        $updateBuilding = $building->save();

        $updateBuilding
            ? session()->flash('success', 'Building Info Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyBuilding(Object $building)
    {
        if (file_exists($building->photo)) unlink($building->photo);
        $destroyBuilding = $building->delete();

        $destroyBuilding
            ? session()->flash('success', 'Building Info Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
