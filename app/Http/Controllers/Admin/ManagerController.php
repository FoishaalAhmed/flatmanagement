<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Models\Building;
use App\Models\BuildingUser;
use App\Models\Manager;
use App\Models\User;

class ManagerController extends Controller
{
    private $managerObject;

    public function __construct()
    {
        $this->managerObject = new Manager();
    }

    public function index()
    {
        $managers = User::whereHas("roles", function ($q) {
            $q->where("name", "Manager");
        })->orderBy('name', 'asc')->get();
        return view('backend.admin.managers.index', compact('managers'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.managers.create', compact('buildings'));
    }

    public function store(ManagerRequest $request)
    {
        $this->managerObject->storeManager($request);
        return back();
    }

    public function edit(Manager $manager)
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $buildingUser = BuildingUser::where('user_id', $manager->id)->pluck('building_id')->toArray();
        return view('backend.admin.managers.edit', compact('manager', 'buildings', 'buildingUser'));
    }

    public function update(ManagerRequest $request, Manager $manager)
    {
        $this->managerObject->updateManager($request, $manager);
        return redirect()->route('admin.managers.index');
    }

    public function destroy(Manager $manager)
    {
        $this->managerObject->destroyManager($manager);
        return back();
    }
}
