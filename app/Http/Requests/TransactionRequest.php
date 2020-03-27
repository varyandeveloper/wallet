<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'required',
            'currency' => [
                'required',
                Rule::exists('currencies', 'id')
            ],
            'amount' => 'required|numeric|min:1'
        ];
    }
}
