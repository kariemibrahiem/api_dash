<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceApiRequest extends FormRequest
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
        if (request()->isMethod('put') || request()->isMethod('patch')) {
            return $this->update();
        } else {
            return $this->store();
        }
    }


        protected function store(): array
        {
            return [
                'user_id' => 'required',
                'login_at' => 'required',
                'logout_at' => 'nullable',
                'day_date' => 'required|date',
                'image' => 'required',
                'attend_time' => 'nullable',
            ];
        }

        protected function update(): array
        {
            return [
                'logout_at' => 'required',
                'image' => 'required',
            ];
        }

        public function messages()
        {
            return [
                'user_id.required' => 'يرجي اختيار المستخدم',
                'login_at.required' => 'يرجي اختيار وقت الدخول',
                'logout_at.required' => 'يرجي اختيار وقت الخروج',
                'date.required' => 'يرجي اختيار التاريخ',
                'day_date.required' => 'يرجي ادخال السبب',
            ];
        }

}
