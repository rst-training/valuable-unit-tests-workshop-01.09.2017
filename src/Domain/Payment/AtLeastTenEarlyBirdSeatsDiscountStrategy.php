<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class AtLeastTenEarlyBirdSeatsDiscountStrategy
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
        if ($seat->getQuantity() >= 10 && $this->configuration->isEnabledForSeat(__CLASS__, $seat)) {
            return $price * $seat->getQuantity() * 0.85;
        }

        return $price;
    }
}
