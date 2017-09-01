<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountService
{
    /**
     * @var SeatsStrategyConfiguration
     */
    private $configuration;

    public function __construct(SeatsStrategyConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function calculateForSeat(Seat $seat, int $price): float
    {
        $discountedPrice = null;

        foreach ($this->seatDiscountStrategies() as $strategy) {
            if ($this->configuration->isEnabledForSeat(__CLASS__, $seat)) {
                $discountedPrice = $strategy->calculate($seat, $price);
            }
        }

        return $discountedPrice;
    }

    protected function seatDiscountStrategies(): array
    {
       return [
           new AtLeastTenEarlyBirdSeatsDiscountStrategy(),
           new FreeSeatDiscountStrategy($this->configuration),
       ];
    }
}
