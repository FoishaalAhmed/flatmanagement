<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Cost;
use App\Models\Flat;
use App\Models\Floor;
use Illuminate\Http\Request;

class CostController extends Controller
{
    protected $costObject;

    public function __construct()
    {
        $this->costObject = new Cost();
    }

    public function index()
    {
        $costs = $this->costObject->getMaintainCost();
        return view('backend.admin.costs.index', compact('costs'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.costs.create', compact('buildings'));
    }

    public function store(Request $request)
    {
        $request->validate(Cost::$validateRule);
        $this->costObject->storeCost($request);
        return back();
    }

    // public function edit(Cost $cost)
    // {
    //     $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
    //     $floors = Floor::where('building_id', $cost->building_id)->orderBy('name', 'asc')->select('id', 'name')->get();
    //     $flats = Flat::where('floor_id', $cost->floor_id)->orderBy('name', 'asc')->select('id', 'name')->get();
    //     return view('backend.admin.costs.edit', compact('buildings', 'floors', 'flats', 'cost'));
    // }

    // public function update(Request $request, Cost $cost)
    // {
    //     $request->validate(Cost::$validateRule);
    //     $this->costObject->updateCost($request, $cost);
    //     return redirect()->route('admin.costs.index');
    // }

    public function destroy(Cost $cost)
    {
        $this->costObject->destroyCost($cost);
        return back();
    }
}
