<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'max: 255', 'string', 'unique:designations,name']
    ];

    public function storeDesignation(Object $request)
    {
        $this->name = $request->name;
        $storeDesignation = $this->save();

        $storeDesignation
            ? session()->flash('success', 'New Designation Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateDesignation(Object $request, Int $id)
    {
        $designation = $this::findOrFail($id);
        $designation->name = $request->name;
        $updateDesignation = $designation->save();

        $updateDesignation
            ? session()->flash('success', 'Designation Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyDesignation(Int $id)
    {
        $designation = $this::findOrFail($id);
        $destroyDesignation = $designation->delete();

        $destroyDesignation
            ? session()->flash('success', 'Designation Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
