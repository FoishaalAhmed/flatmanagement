<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommitteeRequest;
use App\Models\Building;
use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    protected $committeeObject;

    public function __construct()
    {
        $this->committeeObject = new Committee();
    }

    public function index()
    {
        $committees = $this->committeeObject->getCommittees();
        return view('backend.admin.committees.index', compact('committees'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.committees.create', compact('buildings'));
    }

    public function store(CommitteeRequest $request)
    {
        $this->committeeObject->storeCommittee($request);
        return back();
    }

    public function edit(Committee $committee)
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.committees.edit', compact('buildings', 'committee'));
    }

    public function update(CommitteeRequest $request, Committee $committee)
    {
        $this->committeeObject->updateCommittee($request, $committee);
        return redirect()->route('admin.committees.index');
    }

    public function destroy(Committee $committee)
    {
        $this->committeeObject->destroyCommittee($committee);
        return back();
    }
}
