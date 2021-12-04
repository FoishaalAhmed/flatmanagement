<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Month;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    protected $employeeSalaryObject;

    public function __construct()
    {
        $this->employeeSalaryObject = new EmployeeSalary();
    }

    public function index()
    {
        $salaries = $this->employeeSalaryObject->getEmployeeSalaries();
        return view('backend.admin.salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employeeObject = new Employee();
        $employees = $employeeObject->getEmployeeWithDesignations();
        $months = Month::select('id', 'name')->get();
        return view('backend.admin.salaries.create', compact('employees', 'months'));
    }

    public function store(Request $request)
    {
        $request->validate(EmployeeSalary::$validateRule);
        $this->employeeSalaryObject->storeEmployeeSalaries($request);
        return back();
    }

    public function destroy(EmployeeSalary $employeeSalary)
    {
        $this->employeeSalaryObject->destroyEmployeeSalaries($employeeSalary);
        return back();
    }
}
