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
        $files_rule_saler = $files_rule_appraiser = 'sometimes';
        if (request()->routeIs('customers.store')) {
            if (request()->user()->hasRole('saler')) $files_rule_saler = 'required';
            if (request()->user()->hasRole('appraiser')) $files_rule_appraiser = 'required';
        }

        return [
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
            'info.files.saler' => $files_rule_saler . '|array',
            'info.files.appraiser' => $files_rule_appraiser . '|array',
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
