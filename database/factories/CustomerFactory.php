<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'info' => [
                'name' => '',
                'dob' => '',
                'cmnd' => [
                    'number' => '',
                    'date' => '',
                    'place' => '',
                ],
                'job' => '',
                'income' => '',
                'household_address' => '',
                'address' => '',
                'phone' => '',
                'loan_amt' => '',
                'time' => '',
                'note' => '',
                'relative_contacts' => [
                    [
                        'relative' => '',
                        'name' => '',
                        'phone' => '',
                    ], [
                        'relative' => '',
                        'name' => '',
                        'phone' => ''
                    ]
                ]
            ],
            'is_appraised' => false,
            'is_disbursed' => false
        ];
    }
}
