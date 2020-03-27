<?php

namespace Currency\Services\Contract;

use Currency\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyServiceInterface
{
    public function getDefaultCurrency(): ?Currency;

    public function fetchAll(): Collection;

    public function fetch(int $id): ?Currency;
}
