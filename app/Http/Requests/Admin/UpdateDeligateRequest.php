<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeligateRequest extends FormRequest
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
        return [
            'name'      => 'required|max:191',
            'is_active' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'The Location field is required.',
            'is_active.required' => 'The Status field is required.',
        ];
    }
}
