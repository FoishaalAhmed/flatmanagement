<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'floor_id', 'flat_id', 'date', 'type', 'cause', 'amount',
    ];

    public static $validateRule = [
        'building_id' => ['required', 'numeric', 'min: 1'],
        'floor_id' => ['nullable', 'numeric', 'min: 1'],
        'flat_id' => ['nullable', 'numeric', 'min: 1'],
        'date' => ['required', 'date'],
        'type' => ['required', 'string', 'max: 10'],
        'cause' => ['required', 'string', 'max: 255'],
        'amount' => ['required', 'numeric', 'min: 1'],
    ];

    public function getMaintainCost()
    {
        $costs = $this->join('buildings', 'costs.building_id', '=', 'buildings.id')
            ->leftJoin('floors', 'costs.floor_id', '=', 'floors.id')
            ->leftJoin('flats', 'costs.flat_id', '=', 'flats.id')
            ->orderBy('costs.date', 'desc')
            ->orderBy('buildings.name', 'asc')
            ->orderBy('flats.name', 'asc')
            ->select('costs.*', 'buildings.name as building', 'flats.name as flat', 'floors.name as floor')
            ->get();
        return $costs;
    }

    public function storeCost(Object $request)
    {
        $this->building_id = $request->building_id;
        $this->floor_id = $request->floor_id;
        $this->flat_id = $request->flat_id;
        $this->date = date('Y-m-d', strtotime($request->date));
        $this->type = $request->type;
        $this->cause = $request->cause;
        $this->amount = $request->amount;
        $storeCost = $this->save();
        $storeCost
            ? session()->flash('success', 'New Maintain Cost Stored Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCost(Object $request, Object $cost)
    {
        $cost->building_id = $request->building_id;
        $cost->floor_id = $request->floor_id;
        $cost->flat_id = $request->flat_id;
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->type = $request->type;
        $cost->cause = $request->cause;
        $cost->amount = $request->amount;
        $updateCost = $cost->save();
        $updateCost
            ? session()->flash('success', 'Maintain Cost Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCost(Object $cost)
    {
        $destroyCost = $cost->delete();
        $destroyCost
            ? session()->flash('success', 'Maintain Cost Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
