<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    protected $floorObject;

    public function __construct()
    {
        $this->floorObject = new Floor();
    }

    public function index()
    {
        $floors = Floor::with('building')->orderBy('name', 'asc')->get();
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.floor', compact('floors', 'buildings'));
    }

    public function store(Request $request)
    {
        $request->validate(Floor::$validateRule);
        $this->floorObject->storeFloor($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(Floor::$validateRule);
        $this->floorObject->updateFloor($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->floorObject->destroyFloor($id);
        return back();
    }
}
