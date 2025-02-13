<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('put')) {
            return $this->update();
        } else {
            return $this->store();
        }
    }

    public function store() :array
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
            "photo" =>"nullable"
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $this->user,
            'email' => 'required|email|unique:users,email,' . $this->user,
            'password' => 'nullable|min:6|confirmed',
            'phone' => 'required',
            "photo" =>"nullable"
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يجب ادخال الاسم',
            'email.required' => 'يجب ادخال الإيميل',
            'email.unique' => 'الإيميل مستخدم من قبل',
            'password.required_without' => 'يجب ادخال كلمة مرور',
            'password.min' => 'الحد الادني لكلمة المرور : 6 أحرف',
        ];
    }
}
