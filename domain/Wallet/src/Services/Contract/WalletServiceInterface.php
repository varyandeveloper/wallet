<?php

namespace Wallet\Services\Contract;

use Wallet\ValueObjects\Wallet;
use Wallet\ValueObjects\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface WalletServiceInterface
{
    public function transaction(Transaction $transaction);

    public function create(Wallet $wallet);

    public function getWallet(int $walletId);

    public function getUserWallets(int $userId): Collection;

    public function getUserBalance(int $userId): float;
}
