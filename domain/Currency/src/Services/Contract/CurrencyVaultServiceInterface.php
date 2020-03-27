<?php

namespace Currency\Services\Contract;

use Currency\Models\CurrencyVault;

interface CurrencyVaultServiceInterface
{
    public function refill(array $rates);

    public function getRate(int $currencyId): ?CurrencyVault;
}
