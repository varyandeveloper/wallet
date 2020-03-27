<?php

namespace Currency\Services;

use Currency\Models\CurrencyVault;
use Illuminate\Support\Facades\DB;
use Currency\Services\Contract\CurrencyVaultServiceInterface;

class CurrencyVaultService implements CurrencyVaultServiceInterface
{
    protected $currencyVaultModel;

    public function __construct(CurrencyVault $currencyVault)
    {
        $this->currencyVaultModel = $currencyVault;
    }

    public function refill(array $rates)
    {
        try {
            DB::beginTransaction();
            $this->currencyVaultModel::query()->truncate();
            $this->currencyVaultModel::query()->insert($rates);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getRate(int $currencyId): ?CurrencyVault
    {
        return $this->currencyVaultModel::query()->find($currencyId);
    }
}
