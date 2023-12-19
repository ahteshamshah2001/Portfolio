<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
     * @return arraya
     */
    public function rules()
    {
        return [
            'name'        => 'required|max:24',
            'slug'        => 'required|unique:permissions,slug,'.$this->permission.'|max:190',
            'description' => 'max:65535'
        ];
    }
}
