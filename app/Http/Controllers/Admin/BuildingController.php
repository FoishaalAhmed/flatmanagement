<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    protected $buildingObject;

    public function __construct()
    {
        $this->buildingObject = new Building();
    }

    public function index()
    {
        $buildings = Building::orderBy('name', 'asc')->get();
        return view('backend.admin.buildings.index', compact('buildings'));
    }

    public function create()
    {
        return view('backend.admin.buildings.create');
    }

    public function store(Request $request)
    {
        $request->validate(Building::$validateRule);
        $this->buildingObject->storeBuilding($request);
        return back();
    }

    public function edit(Building $building)
    {
        return view('backend.admin.buildings.edit', compact('building'));
    }

    public function update(Request $request, Building $building)
    {
        $request->validate(Building::$validateRule);
        $this->buildingObject->updateBuilding($request, $building);
        return redirect()->route('admin.buildings.index');
    }

    public function destroy(Building $building)
    {
        $this->buildingObject->destroyBuilding($building);
        return back();
    }
}
