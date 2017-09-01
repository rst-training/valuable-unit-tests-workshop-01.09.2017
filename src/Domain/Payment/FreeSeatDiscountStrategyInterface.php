<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class FreeSeatDiscountStrategyInterface implements SeatDiscountStrategyInterface
{
    public function calculate(Seat $seat, int $price, float $discountedPrice): float
    {
        if ($discountedPrice === null) {
            return 0;
        }

        return $discountedPrice;
    }
}
