<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

class SeatDiscountPoolStrategy
{
    private $pool;

    public function __construct(DiscountPoolInterface $pool)
    {
        $this->pool = $pool;
    }

    public function calculate(float $price, int $quantity)
    {
        $value = $price * $quantity;
        $usedAmount = min($this->pool->getCount(), $quantity);
        $value -= $usedAmount * $this->pool->getDiscountValue();

        return $value;
    }
}
