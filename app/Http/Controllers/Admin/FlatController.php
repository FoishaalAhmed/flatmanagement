<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Floor;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    protected $flatObject;

    public function __construct()
    {
        $this->flatObject = new Flat();
    }

    public function index()
    {
        $flats = $this->flatObject->getFlats();
        return view('backend.admin.flats.index', compact('flats'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.flats.create', compact('buildings'));
    }

    public function store(Request $request)
    {
        $request->validate(Flat::$validateRule);
        $this->flatObject->storeFlat($request);
        return back();
    }

    public function edit(Flat $flat)
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $floors = Floor::where('building_id', $flat->building_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.flats.edit', compact('buildings', 'floors', 'flat'));
    }

    public function update(Request $request, Flat $flat)
    {
        $request->validate(Flat::$validateRule);
        $this->flatObject->updateFlat($request, $flat);
        return redirect()->route('admin.flats.index');
    }

    public function destroy(Flat $flat)
    {
        $this->flatObject->destroyFlat($flat);
        return back();
    }
}
