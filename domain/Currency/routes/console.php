<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('currency-update-vault', function () {

    $currencies = \Currency\Models\Currency::all();
    $rates = \Currency\Exchange\Facades\Exchange::driver()->rates(config('currency.default.code'), ...$currencies->pluck('code'));
    $grouped = $currencies->keyBy('code');
    $prepared = [];

    /**
     * @var \Currency\Exchange\Rate $rate
     */
    foreach ($rates as $rate) {
        $prepared[] = [
            'currency_id' => $grouped[$rate->getCode()]->id,
            'exchange_rate' => $rate->getRate(),
            'created_at' => $rate->getDate(),
            'updated_at' => $rate->getDate()
        ];
    }

    app(\Currency\Services\CurrencyVaultService::class)->refill($prepared);

})->describe('Updating currency vault');
