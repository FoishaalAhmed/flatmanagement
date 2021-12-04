<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Building;
use App\Models\Designation;
use App\Models\Employee;

class EmployeeController extends Controller
{
    protected $employeeObject;

    public function __construct()
    {
        $this->employeeObject = new Employee();
    }

    public function index()
    {
        $employees = $this->employeeObject->getEmployees();
        return view('backend.admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $designations = Designation::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.employees.create', compact('buildings', 'designations'));
    }

    public function store(EmployeeRequest $request)
    {
        $this->employeeObject->storeEmployee($request);
        return back();
    }

    public function edit(Employee $employee)
    {
        $buildings = Building::orderBy('name', 'asc')->select('id', 'name')->get();
        $designations = Designation::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.admin.employees.edit', compact('buildings', 'designations', 'employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $this->employeeObject->updateEmployee($request, $employee);
        return redirect()->route('admin.employees.index');
    }

    public function destroy(Employee $employee)
    {
        $this->employeeObject->destroyEmployee($employee);
        return back();
    }
}
