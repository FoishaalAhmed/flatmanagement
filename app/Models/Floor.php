<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'name',
    ];

    public static $validateRule = [
        'building_id' => ['required', 'numeric', 'min: 1'],
        'name' => ['required', 'string', 'max: 255'],
    ];

    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }

    public function storeFloor(Object $request)
    {
        $this->building_id = $request->building_id;
        $this->name = $request->name;
        $storeFloor = $this->save();

        $storeFloor
            ? session()->flash('success', 'New Floor Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateFloor(Object $request, Int $id)
    {
        $floor = $this::findOrFail($id);
        $floor->building_id = $request->building_id;
        $floor->name = $request->name;
        $updateFloor = $floor->save();

        $updateFloor
            ? session()->flash('success', 'Floor Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyFloor(Int $id)
    {
        $floor = $this::findOrFail($id);
        $destroyFloor = $floor->delete();

        $destroyFloor
            ? session()->flash('success', 'Floor Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
