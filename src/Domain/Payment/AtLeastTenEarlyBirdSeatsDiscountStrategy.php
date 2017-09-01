<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class AtLeastTenEarlyBirdSeatsDiscountStrategy implements SeatDiscountStrategy
{
    public function calculate(Seat $seat, int $price): float
    {
        $discount = 1;
        if ($seat->getQuantity() >= 10) {
            $discount = 0.85;
        }
        return $price * $seat->getQuantity() * $discount;
    }
}
