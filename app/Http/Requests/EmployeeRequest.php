<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'name'              => ['required', 'string', 'max:255'],
            'permanent_address' => ['required', 'string'],
            'present_address'   => ['required', 'string'],
            'building_id'       => ['required', 'numeric', 'min:1'],
            'designation_id'    => ['required', 'numeric', 'min:1'],
            'join_date'         => ['required', 'date'],
            'end_date'          => ['nullable', 'date'],
            'salary'            => ['required', 'numeric'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'password' => 'required|string|min:8|confirmed',
                'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone'    => ['required', 'string', 'max:15', 'unique:users,phone'],
                'nid'      => ['required', 'string', 'max:50', 'unique:employees,nid'],
                'photo'    => ['mimes:jpeg,jpg,png,gif,webp', 'max:100', 'required'],
            ];
        } else {
            return $rules + [
                'email'    => ['required', 'email', 'max:255', 'unique:employees,email,' . $this->employee->id],
                'phone'    => ['required', 'string', 'max:15', 'unique:employees,phone,' . $this->employee->id],
                'nid'      => ['required', 'string', 'max:50', 'unique:employees,nid,' . $this->employee->id],
                'photo'    => ['mimes:jpeg,jpg,png,gif,webp', 'max:100', 'nullable'],
            ];
        }
    }
}
