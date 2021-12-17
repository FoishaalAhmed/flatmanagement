<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerRequest;
use App\Models\Flat;
use App\Models\FlatOwner;
use App\Models\Owner;

class OwnerController extends Controller
{
    protected $ownerObject;

    public function __construct()
    {
        $this->ownerObject = new Owner();
    }

    public function index()
    {
        $owners = Owner::with(['flats' => function ($query) {
            $query->select('flats.id', 'flats.name');
        }])->orderBy('name', 'asc')->get();
        return view('backend.admin.owners.index', compact('owners'));
    }

    public function create()
    {
        $flats = Flat::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.owners.create', compact('flats'));
    }

    public function store(OwnerRequest $request)
    {
        $this->ownerObject->storeOwner($request);
        return back();
    }

    public function edit(Owner $owner)
    {
        $flats = Flat::orderBy('name', 'asc')->select('id', 'name')->get();
        $flatOwners = FlatOwner::where('owner_id', $owner->id)->pluck('flat_id')->toArray();
        return view('backend.admin.owners.edit', compact('flats', 'owner', 'flatOwners'));
    }

    public function update(OwnerRequest $request, Owner $owner)
    {
        $this->ownerObject->updateOwner($request, $owner);
        return redirect()->route('admin.owners.index');
    }

    public function destroy(Owner $owner)
    {
        $this->ownerObject->destroyOwner($owner);
        return back();
    }
}
