<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class AtLeastTenEarlyBirdSeatsDiscountStrategy implements SeatDiscountStrategy
{
    public function calculate(Seat $seat, int $price, ?float $discountedPrice): float
    {
        if ($seat->getQuantity() >= 10 && $discountedPrice === null) {
            return $price * $seat->getQuantity() * 0.85;
        }

        return $discountedPrice;
    }
}
