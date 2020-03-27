<?php

namespace App\Services;

use Currency\Services\Contract\CurrencyServiceInterface;
use Currency\Services\Contract\CurrencyVaultServiceInterface;

class CurrencyService
{
    protected $currencyService;

    protected $currencyVaultService;

    public function __construct(
        CurrencyServiceInterface $currencyService,
        CurrencyVaultServiceInterface $currencyVaultService)
    {
        $this->currencyService = $currencyService;
        $this->currencyVaultService = $currencyVaultService;
    }

    public function convert(int $from, float $amount, int $to = null): float
    {
        if ($from == $to) {
            return $amount;
        }

        $baseCurrency = $this->currencyVaultService->getRate($this->currencyService->getDefaultCurrency()->id);
        $rateTo = $baseCurrency;

        if (null !== $to) {
            $rateTo = $this->currencyVaultService->getRate($to);
        }

        $rateFrom = $this->currencyVaultService->getRate($from);
        return $amount * $rateFrom->exchange_rate / $baseCurrency->exchange_rate * $rateTo->exchange_rate;
    }
}
