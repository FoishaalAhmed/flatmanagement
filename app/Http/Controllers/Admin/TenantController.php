<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Floor;
use App\Models\Month;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $tenantObject;

    public function __construct()
    {
        $this->tenantObject = new Tenant();
    }

    public function index()
    {
        $tenants = $this->tenantObject->getTenants();
        return view('backend.admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $months = Month::select('id', 'name')->get();
        return view('backend.admin.tenants.create', compact('buildings', 'months'));
    }

    public function store(TenantRequest $request)
    {
        $this->tenantObject->storeTenant($request);
        return back();
    }

    public function edit(Tenant $tenant)
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $floors = Floor::where('building_id', $tenant->building_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $flats = Flat::where('building_id', $tenant->building_id)->where('floor_id', $tenant->floor_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $months = Month::select('id', 'name')->get();
        return view('backend.admin.tenants.edit', compact('buildings', 'floors', 'flats', 'tenant', 'months'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $this->tenantObject->updateTenant($request, $tenant);
        return redirect()->route('admin.tenants.index');
    }

    public function destroy(Tenant $tenant)
    {
        $this->tenantObject->destroyTenant($tenant);
        return back();
    }
}
