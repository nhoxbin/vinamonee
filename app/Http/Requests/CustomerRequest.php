<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'info.images.saler' => 'array',
            'info.images.appraiser' => 'array',
            'info.name' => 'required|string',
            'info.dob' => 'required|string',
            'info.cmnd.number' => 'required|string|max:12',
            'info.cmnd.date' => 'required|string',
            'info.cmnd.place' => 'required|string',
            'info.work' => 'required|string',
            'info.income' => 'required|string',
            'info.household' => 'required|string',
            'info.place' => 'required|string',
            'info.phone' => 'required|string|max:15',
            'info.loan.amt' => 'required|string',
            'info.loan.time' => 'required|string',
            'info.assets' => 'required|string',
            'info.notes.saler' => 'string',
            'info.notes.appraiser' => 'string',
            'info.relative_contacts.*.phone' => 'required|string|max:15',
            'info.relative_contacts.*.relative' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'info.*.required' => 'Ô này không được bỏ trống.',
            'info.*.*.required' => 'Ô này không được bỏ trống.',
            'info.*.*.*.required' => 'Ô này không được bỏ trống.',
            'info.*.max' => 'Tối đa :max ký tự',
            'info.*.*.max' => 'Tối đa :max ký tự',
            'info.*.*.*.max' => 'Tối đa :max ký tự',
        ];
    }
}
