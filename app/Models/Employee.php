<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'name', 'email', 'phone', 'present_address', 'permanent_address', 'nid', 'designation_id', 'join_date', 'leave_date', 'salary', 'status', 'photo',
    ];

    public function getEmployeeWithDesignations()
    {
        $employees = $this::join('designations', 'employees.designation_id', '=', 'designations.id')
            ->orderBy('employees.name', 'asc')
            ->select('employees.id', 'employees.name', 'employees.salary', 'designations.name as designation')
            ->get();
        return $employees;
    }
    
    public function getEmployees()
    {
        $employees = $this::join('buildings', 'employees.building_id', '=', 'buildings.id')
            ->join('designations', 'employees.designation_id', '=', 'designations.id')
            ->orderBy('buildings.name', 'asc')
            ->orderBy('designations.name', 'asc')
            ->orderBy('employees.name', 'asc')
            ->select('employees.*', 'buildings.name as building', 'designations.name as designation')
            ->get();
        return $employees;
    }

    public function storeEmployee(Object $request)
    {
        $image = $request->file('photo');
        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/employees/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->building_id = $request->building_id;
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->present_address = $request->present_address;
        $this->permanent_address = $request->permanent_address;
        $this->nid = $request->nid;
        $this->designation_id = $request->designation_id;
        $this->join_date = date('Y-m-d', strtotime($request->join_date));
        $this->leave_date = $request->leave_date != null ? date('Y-m-d', strtotime($request->leave_date)) : null;
        $this->salary = $request->salary;
        $storeEmployee = $this->save();

        $user = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->address     = $request->permanent_address;
        $user->password    = Hash::make($request->password);
        $user->employee_id = $this->id;
        $user->save();

        $employeeInfo = User::where('employee_id', $this->id)->firstOrFail();
        $role = Role::where('name', 'Employee')->first();
        $employeeInfo->assignRole($role);

        $storeEmployee
            ? session()->flash('success', 'New Employee Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateEmployee(Object $request, Object $employee)
    {
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($employee->photo)) unlink($employee->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/employees/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $employee->photo = $image_url;
        }

        $employee->building_id = $request->building_id;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->nid = $request->nid;
        $employee->designation_id = $request->designation_id;
        $employee->status = $request->status;
        $employee->join_date = date('Y-m-d', strtotime($request->join_date));
        $employee->leave_date = $request->leave_date != null ? date('Y-m-d', strtotime($request->leave_date)) : null;
        $employee->salary = $request->salary;
        $updateEmployee = $employee->save();

        $updateEmployee
            ? session()->flash('success', 'Employee Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyEmployee(Object $employee)
    {
        if (file_exists($employee->photo)) unlink($employee->photo);
        $updateEmployee = $employee->delete();
        $updateEmployee
            ? session()->flash('success', 'Employee Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
