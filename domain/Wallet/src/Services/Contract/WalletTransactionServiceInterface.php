<?php

namespace Wallet\Services\Contract;

interface WalletTransactionServiceInterface
{
    public function create(array $data): void;

    public function getWalletTransactions(int $walletId);
}
