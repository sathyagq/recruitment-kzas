<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required',
            'name' => 'required',
            'cpf' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cep' => 'required|size:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'company_id.required' => 'Company is required',
            'name.required' => 'Name is required',
            'cpf.required' => 'CPF is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone is required',
            'cep.required' => 'CEP is required',
            'cep.size' => 'Invalid CEP',
            'street.required' => 'Street is required',
            'number.required' => 'Number is required',
            'neighborhood.required' => 'Neighborhood is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required'
        ];
    }
}
