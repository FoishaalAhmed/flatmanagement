<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'floor_id', 'name', 'area', 'room', 'washroom', 'kitchen', 'balcony', 'drawing_dining', 'description', 'photo',
    ];

    public static $validateRule = [
        'building_id' => ['required', 'numeric', 'min: 1'],
        'floor_id' => ['required', 'numeric', 'min: 1'],
        'name' => ['required', 'string', 'max: 50'],
        'area' => ['required', 'numeric'],
        'room' => ['required', 'numeric', 'min: 1'],
        'washroom' => ['required', 'numeric', 'min: 1'],
        'kitchen' => ['required', 'numeric', 'min: 1'],
        'balcony' => ['required', 'numeric', 'min: 0'],
        'drawing_dining' => ['required', 'string', 'max: 100'],
        'description' => ['nullable', 'string'],
        'photo' => ['nullable', 'max: 100', 'mimes:jpeg,jpg,png,gif,webp'],
    ];

    public function getFlats()
    {
        $flats = $this::join('buildings', 'flats.building_id', '=', 'buildings.id')
            ->join('floors', 'flats.floor_id', '=', 'floors.id')
            ->orderBy('buildings.name', 'asc')
            ->orderBy('floors.name', 'asc')
            ->orderBy('flats.name', 'asc')
            ->select('flats.*', 'buildings.name as building', 'floors.name as floor')
            ->get();
        return $flats;
    }

    public function storeFlat(Object $request)
    {
        $image = $request->file('photo');
        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/flats/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->building_id = $request->building_id;
        $this->floor_id = $request->floor_id;
        $this->name = $request->name;
        $this->area = $request->area;
        $this->room = $request->room;
        $this->washroom = $request->washroom;
        $this->kitchen = $request->kitchen;
        $this->balcony = $request->balcony;
        $this->drawing_dining = $request->drawing_dining;
        $this->description = $request->description;
        $storeFlat = $this->save();

        $storeFlat
            ? session()->flash('success', 'New Flat Info Stored Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateFlat(Object $request, Object $flat)
    {
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($flat->photo)) unlink($flat->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/flats/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $flat->photo     = $image_url;
        }

        $flat->building_id = $request->building_id;
        $flat->floor_id = $request->floor_id;
        $flat->name = $request->name;
        $flat->area = $request->area;
        $flat->room = $request->room;
        $flat->washroom = $request->washroom;
        $flat->kitchen = $request->kitchen;
        $flat->balcony = $request->balcony;
        $flat->drawing_dining = $request->drawing_dining;
        $flat->description = $request->description;
        $updateFlat = $flat->save();

        $updateFlat
            ? session()->flash('success', 'Flat Info Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyFlat(Object $flat)
    {
        if (file_exists($flat->photo)) unlink($flat->photo);
        $destroyFlat = $flat->delete();

        $destroyFlat
            ? session()->flash('success', 'Flat Info Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
