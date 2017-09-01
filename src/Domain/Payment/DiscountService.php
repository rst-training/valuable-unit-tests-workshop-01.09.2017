<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountService
{
    protected $discountStrategies = [];

    public function calculateForSeat(Seat $seat, int $price): float
    {
        $discountedPrice = null;

        foreach ($this->discountStrategies as $strategy) {
            $discountedPrice = $strategy->calculate($seat, $price, $discountedPrice);
        }

        return $discountedPrice;
    }

    public function addDiscountStrategy(SeatDiscountStrategyInterface $strategy): void
    {
        $this->discountStrategies[] = $strategy;
    }
}
