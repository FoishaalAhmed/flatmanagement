<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'date', 'month', 'year', 'salary', 'paid',
    ];

    public static $validateRule = [
        'employee_id' => ['required', 'numeric', 'min: 1'],
        'date' => ['required', 'date'],
        'month' => ['required', 'string', 'max: 15'],
        'year' => ['required', 'numeric',],
        'salary' => ['required', 'numeric',],
        'paid' => ['required', 'numeric',],
    ];

    public function getEmployeeSalaries()
    {
        $salaries = $this::join('employees', 'employee_salaries.employee_id', '=', 'employees.id')
            ->join('designations', 'employees.designation_id', '=', 'designations.id')
            ->orderBy('employee_salaries.date', 'desc')
            ->orderBy('designations.name', 'asc')
            ->orderBy('employees.name', 'asc')
            ->select('employees.name as employee', 'designations.name as designation', 'employee_salaries.*')
            ->get();
        return $salaries;
    }

    public function storeEmployeeSalaries(Object $request)
    {
        $this->employee_id = $request->employee_id;
        $this->date = date('Y-m-d', strtotime($request->date));
        $this->month = $request->month;
        $this->year = $request->year;
        $this->salary = $request->salary;
        $this->paid = $request->paid;
        $storeEmployeeSalaries = $this->save();

        $storeEmployeeSalaries
            ? session()->flash('success', 'Employee Salary Paid Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyEmployeeSalaries(Object $salary)
    {
        $destroyEmployeeSalaries = $salary->delete();

        $destroyEmployeeSalaries
            ? session()->flash('success', 'Employee Salary Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
