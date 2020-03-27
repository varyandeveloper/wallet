<?php

namespace Wallet\ValueObjects;

class Transaction
{
    /**
     * @var int
     */
    protected $type;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var float
     */
    protected $amountInWalletCurrency;

    /**
     * @var int
     */
    protected $wallet_id;

    /**
     * @var int
     */
    protected $currency_id;

    /**
     * @var \DateTimeInterface
     */
    protected $transaction_date;

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Transaction
    {
        $this->type = $type;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): Transaction
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmountInWalletCurrency(): float
    {
        return $this->amountInWalletCurrency;
    }

    public function setAmountInWalletCurrency(float $amountInWalletCurrency): Transaction
    {
        $this->amountInWalletCurrency = $amountInWalletCurrency;
        return $this;
    }

    public function getWalletId(): int
    {
        return $this->wallet_id;
    }

    public function setWalletId(int $wallet_id): Transaction
    {
        $this->wallet_id = $wallet_id;
        return $this;
    }

    public function getCurrencyId(): int
    {
        return $this->currency_id;
    }

    public function setCurrencyId(int $currency_id): Transaction
    {
        $this->currency_id = $currency_id;
        return $this;
    }

    public function getTransactionDate(): \DateTimeInterface
    {
        return $this->transaction_date;
    }

    public function setTransactionDate(\DateTimeInterface $transaction_date): Transaction
    {
        $this->transaction_date = $transaction_date;
        return $this;
    }
}
