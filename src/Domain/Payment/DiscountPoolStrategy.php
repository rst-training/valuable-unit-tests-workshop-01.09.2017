<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountPoolStrategy implements SeatDiscountStrategy
{
    /**
     * @var SeatsStrategyConfiguration
     */
    private $configuration;
    private $pool;

    public function __construct(SeatsStrategyConfiguration $configuration, DiscountPool $pool)
    {
        $this->configuration = $configuration;
        $this->pool = $pool;
    }

    public function calculate(Seat $seat, int $price, ?float $discountedPrice): float
    {
        $this->pool->decrement($seat->getQuantity());
        $discountedPrice = $price;
        return $discountedPrice;
    }
}
