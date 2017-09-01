<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class FreeSeatDiscountStrategy implements SeatDiscountStrategy
{
    /**
     * @var SeatsStrategyConfiguration
     */
    private $configuration;

    public function __construct(SeatsStrategyConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function calculate(Seat $seat, int $price): float
    {
        $discountedPrice = null;
        if ($this->configuration->isEnabledForSeat(__CLASS__, $seat)) {
            return 0;
        }

        return $discountedPrice;
    }
}
