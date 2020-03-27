<?php

namespace Currency\Exchange;

class Rate
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var \DateTimeInterface
     */
    protected $date;

    public function setCode(string $code): Rate
    {
        $this->code = $code;
        return $this;
    }

    public function setRate(float $rate): Rate
    {
        $this->rate = $rate;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): Rate
    {
        $this->date = $date;
        return $this;
    }
}
