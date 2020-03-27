<?php

namespace App\Http\Requests;

use Wallet\Models\Wallet;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'type' => [
                'required',
                Rule::in([Wallet::TYPE_CASH, Wallet::TYPE_CREDIT_CARD])
            ]
        ];
    }
}
