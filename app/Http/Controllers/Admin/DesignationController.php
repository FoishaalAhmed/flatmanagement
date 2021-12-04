<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    protected $designationObject;

    public function __construct()
    {
        $this->designationObject = new Designation();
    }

    public function index()
    {
        $designations = Designation::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.designation', compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate(Designation::$validateRule);
        $this->designationObject->storeDesignation($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(Designation::$validateRule);
        $this->designationObject->updateDesignation($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->designationObject->destroyDesignation($id);
        return back();
    }
}
