<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
             'name'          => 'required|max:64',
             'phone'         => 'required|max:24',
             'email'         => 'required|email:strict,filter|unique:users|max:128',
             'areas_of_expertise' => 'required',
             'roles'         => 'required',
             'is_active'     => 'required'
        ];
    }
}
