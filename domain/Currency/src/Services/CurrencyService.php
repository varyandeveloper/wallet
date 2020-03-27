<?php

namespace Currency\Services;

use Currency\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Currency\Services\Contract\CurrencyServiceInterface;
use Currency\Services\Contract\CurrencyVaultServiceInterface;

class CurrencyService implements CurrencyServiceInterface
{
    protected $currencyModel;

    protected $currencyVaultService;

    public function __construct(Currency $currencyModel, CurrencyVaultServiceInterface $currencyVaultService)
    {
        $this->currencyModel = $currencyModel;
        $this->currencyVaultService = $currencyVaultService;
    }

    public function getDefaultCurrency(): ?Currency
    {
        return $this->currencyModel->whereCode(config('currency.default.code'))->first();
    }

    public function fetchAll(): Collection
    {
        return $this->currencyModel->all();
    }

    public function fetch(int $id): ?Currency
    {
        return $this->currencyModel->identifier($id)->first();
    }
}
