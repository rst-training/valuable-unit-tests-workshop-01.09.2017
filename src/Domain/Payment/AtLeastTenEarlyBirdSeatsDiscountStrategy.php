<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class AtLeastTenEarlyBirdSeatsDiscountStrategy implements SeatDiscountStrategy
{

    public function calculate(Seat $seat, int $price): float
    {
        $discountedPrice = 0.0;
        if ($seat->getQuantity() >= 10) {
            return $price * $seat->getQuantity() * 0.85;
        }

        return $discountedPrice;
    }
}
