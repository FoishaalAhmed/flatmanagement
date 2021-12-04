<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'name'              => ['required', 'string', 'max:255'],
            'permanent_address' => ['required', 'string'],
            'building_id'       => ['required', 'numeric', 'min:1'],
            'floor_id'          => ['required', 'numeric', 'min:1'],
            'flat_id'           => ['required', 'numeric', 'min:1'],
            'advance'           => ['required', 'numeric'],
            'rent'              => ['required', 'numeric'],
            'issue_date'        => ['required', 'date'],
            'month'             => ['required', 'string', 'max:10',],
            'year'              => ['required', 'numeric'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'password' => 'required|string|min:8|confirmed',
                'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone'    => ['required', 'string', 'max:15', 'unique:users,phone'],
                'nid'      => ['required', 'string', 'max:50', 'unique:tenants,nid'],
                'photo'    => ['mimes:jpeg,jpg,png,gif,webp', 'max:100', 'required'],
            ];
        } else {

            return $rules + [
                'email'    => ['required', 'email', 'max:255', 'unique:tenants,email,' . $this->tenant->id],
                'phone'    => ['required', 'string', 'max:15', 'unique:tenants,phone,' . $this->tenant->id],
                'nid'      => ['required', 'string', 'max:50', 'unique:tenants,nid,' . $this->tenant->id],
                'photo'    => ['mimes:jpeg,jpg,png,gif,webp', 'max:100', 'nullable'],
            ];
        }
    }
}
