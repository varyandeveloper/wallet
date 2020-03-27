<?php

namespace App\Services\Contract;

use Wallet\ValueObjects\Wallet;
use Wallet\ValueObjects\Transaction;

interface WalletServiceInterface extends \Wallet\Services\Contract\WalletServiceInterface
{
    public function translateToWalletValueObject(array $input): Wallet;

    public function translateToTransactionValueObject(array $input): Transaction;
}
