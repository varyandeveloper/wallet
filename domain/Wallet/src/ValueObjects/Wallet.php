<?php

namespace Wallet\ValueObjects;

class Wallet
{
    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var int
     */
    protected $currency_id;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $balance;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return Wallet
     */
    public function setUserId(int $user_id): Wallet
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getCurrencyId(): int
    {
        return $this->currency_id;
    }

    public function setCurrencyId(int $currency_id): Wallet
    {
        $this->currency_id = $currency_id;
        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Wallet
    {
        $this->type = $type;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Wallet
    {
        $this->name = $name;
        return $this;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): Wallet
    {
        $this->balance = $balance;
        return $this;
    }
}
