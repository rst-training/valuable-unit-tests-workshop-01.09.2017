<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class AtLeastTenEarlyBirdSeatsDiscountStrategyTest extends TestCase
{
    /**
     * @test
     */
    public function return_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $configuration
            ->method('isEnabledForSeat')
            ->willReturn(true);

        $seat = new Seat('type', 10);

        $strategy = new AtLeastTenEarlyBirdSeatsDiscountStrategy($configuration);
        $this->assertEquals(59.5, $strategy->calculate($seat, 7, null));
    }
}
