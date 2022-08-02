<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:5|max:255',
            'address' => 'required|string|max:255|min:10',
            'email' => 'required|string|email|max:255|unique:students',
            'mobile' => 'required|min:8|numeric',
        ];
    }
}
