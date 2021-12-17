<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    public function floor(Request $request)
    {
        $floors = Floor::where('building_id', $request->building_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        echo json_encode($floors);
    }

    public function flat(Request $request)
    {
        $flats = DB::table("flats")
            ->where('building_id', $request->building_id)
            ->where('floor_id', $request->floor_id)
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->whereNotIn('id', function ($query) use ($request) {
                $query->select('flat_id')
                    ->where('building_id', $request->building_id)
                    ->where('floor_id', $request->floor_id)
                    ->where('status', 1)
                    ->from('tenants');
            })
            ->get();
        echo json_encode($flats);
    }

    public function flats(Request $request)
    {
        $flats = DB::table("flats")
            ->where('building_id', $request->building_id)
            ->where('floor_id', $request->floor_id)
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->get();
        echo json_encode($flats);
    }

    public function buildingFlats(Request $request)
    {
        $flats = DB::table("flats")
            ->where('building_id', $request->building_id)
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->get();
        echo json_encode($flats);
    }

    public function tenant(Request $request)
    {
        $tenants = Tenant::where('flat_id', $request->flat_id)
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'rent')
            ->get();
        echo json_encode($tenants);
    }
}
