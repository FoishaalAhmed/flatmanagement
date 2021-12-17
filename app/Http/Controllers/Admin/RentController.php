<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Floor;
use App\Models\Month;
use App\Models\Rent;
use App\Models\Tenant;
use Illuminate\Http\Request;

class RentController extends Controller
{
    protected $rentObject;

    public function __construct()
    {
        $this->rentObject = new Rent();
    }

    public function index()
    {
        $rents = $this->rentObject->getRents();
        return view('backend.admin.rents.index', compact('rents'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $months = Month::select('id', 'name')->get();
        return view('backend.admin.rents.create', compact('buildings', 'months'));
    }

    public function store(Request $request)
    {
        $request->validate(Rent::$validateRule);
        $this->rentObject->storeRent($request);
        return back();
    }

    public function show(Rent $rent)
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $floors = Floor::where('building_id', $rent->building_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $flats = Flat::where('floor_id', $rent->floor_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $tenants = Tenant::orderBy('name', 'asc')->select('id', 'name')->get();
        $months = Month::select('id', 'name')->get();
        return view('backend.admin.rents.show', compact('buildings', 'floors', 'flats', 'tenants', 'months', 'rent'));
    }

    public function destroy(Rent $rent)
    {
        $this->rentObject->destroyRent($rent);
        return back();
    }
}
