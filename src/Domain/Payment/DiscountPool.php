<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountPool
{
    private $seats = 0;

    public function __construct(int $number)
    {
        $this->seats = $number;
    }

    public function decrement($number): int
    {
        $before = $this->seats;
        $result = $this->seats - $number;
        if( $result < 0)
        {
            $this->seats = 0;
            return $before;
        }
        $this->seats = $result;
        return $number;
    }

    public function getLeftSeats()
    {
        return $this->seats;
    }
}
