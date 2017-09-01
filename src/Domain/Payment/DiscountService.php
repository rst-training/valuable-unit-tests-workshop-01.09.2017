<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountService
{
    /**
     * @var SeatsStrategyConfiguration
     */
    private $configuration;
    protected $strategy = [];

    public function __construct(SeatsStrategyConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function calculateForSeat(Seat $seat, int $price): float
    {
        $discountedPrice = null;

        if (!count($this->strategy)) {
            $this->defaultStrategies();
        }
        foreach ($this->strategy as $strategy) {
            $discountedPrice = $strategy->calculate($seat, $price, $discountedPrice);
        }

        return $discountedPrice;
    }

    protected function defaultStrategies() {
        $this->strategy = [
            new AtLeastTenEarlyBirdSeatsDiscountStrategy($this->configuration),
            new FreeSeatDiscountStrategy($this->configuration),
        ];
    }

    public function enableStrategy(string $strategy)
    {
        $this->strategy[] = new $strategy($this->configuration);
    }
}
