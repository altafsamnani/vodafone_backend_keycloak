<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SwRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'People id is required!',
            'id.integer' => 'Id should be integer',
        ];
    }
}
