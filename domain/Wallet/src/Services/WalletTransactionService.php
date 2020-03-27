<?php

namespace Wallet\Services;

use Wallet\Models\WalletTransaction;
use Illuminate\Database\Eloquent\Collection;
use Wallet\Services\Contract\WalletTransactionServiceInterface;

class WalletTransactionService implements WalletTransactionServiceInterface
{
    protected $walletTransactionModel;

    public function __construct(WalletTransaction $walletTransaction)
    {
        $this->walletTransactionModel = $walletTransaction;
    }

    public function create(array $data): void
    {
        $this->walletTransactionModel::query()->create($data);
    }

    public function getWalletTransactions(int $walletId): Collection
    {
        return $this->walletTransactionModel
            ->ownedBy($walletId)
            ->with(['currency'])
            ->get()
        ;
    }
}
