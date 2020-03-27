<?php

namespace App\Services;

use Wallet\ValueObjects\Wallet;
use Wallet\ValueObjects\Transaction;
use App\Services\Contract\WalletServiceInterface;

class WalletService extends \Wallet\Services\WalletService implements WalletServiceInterface
{
    public function translateToWalletValueObject(array $input): Wallet
    {
        $wallet = $this->createWalletValueObject();

        $wallet
            ->setType($input['type'])
            ->setName($input['name'])
            ->setCurrencyId($input['currency'])
            ->setUserId(auth()->id())
        ;

        return $wallet;
    }

    public function translateToTransactionValueObject(array $input): Transaction
    {
        $transaction = $this->createTransactionValueObject($input);
        $wallet = $this->getWallet($input['wallet_id']);

        $transaction
            ->setType($input['type'])
            ->setAmount($input['amount'])
            ->setWalletId($input['wallet_id'])
            ->setCurrencyId($input['currency'])
            ->setTransactionDate(new \DateTimeImmutable)
            ->setAmountInWalletCurrency(
                $this->getCurrencyService()->convert(
                    $input['currency'],
                    $input['amount'],
                    $wallet->currency_id
                )
            )
        ;

        return $transaction;
    }

    protected function createWalletValueObject(): Wallet
    {
        return app(Wallet::class);
    }

    protected function createTransactionValueObject(array $input): Transaction
    {
        return app(Transaction::class);
    }

    protected function getCurrencyService(): CurrencyService
    {
       return app(CurrencyService::class);
    }
}
