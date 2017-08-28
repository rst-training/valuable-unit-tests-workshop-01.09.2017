<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;


use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class SeatsStrategyConfiguration
{
    public function isEnabledForSeat(string $strategy, Seat $seat): bool
    {
        return false;
    }
}