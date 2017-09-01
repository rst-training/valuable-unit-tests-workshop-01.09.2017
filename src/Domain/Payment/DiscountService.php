<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountService
{
    /**
     * @var array
     */
    private $discountStrategies;

    public function __construct(array $discountStrategies)
    {
        $this->discountStrategies = $discountStrategies;
    }

    public function calculateForSeat(Seat $seat, int $price): float
    {
        $discountedPrice = null;

        foreach ($this->discountStrategies as $strategy) {
            $discountedPrice = $strategy->calculate($seat, $price, $discountedPrice);
        }

        return $discountedPrice;
    }
}
