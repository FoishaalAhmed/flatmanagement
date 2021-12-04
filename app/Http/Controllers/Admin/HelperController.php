<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function floor(Request $request)
    {
        $floors = Floor::where('building_id', $request->building_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        echo json_encode($floors);
    }
}
