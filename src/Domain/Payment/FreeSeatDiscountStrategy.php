<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class FreeSeatDiscountStrategy implements SeatDiscountStrategy
{
    public function calculate(Seat $seat, int $price, float $discountedPrice): float
    {
        if ($discountedPrice === null) {
            return 0;
        }

        return $discountedPrice;
    }
}
