<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

interface SeatDiscountStrategy
{
    /**
     * @param $seat
     * @param $price
     * @return mixed discounted price
     */
    public function calculate(Seat $seat, int $price);
}
