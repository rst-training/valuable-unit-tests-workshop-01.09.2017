<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountServiceTest extends TestCase
{
    /**
     * @test
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        /** @var SeatsStrategyConfiguration|\PHPUnit_Framework_MockObject_MockObject $configuration */
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $configuration->method('isEnabledForSeat')->willReturn(true);
        $discountStrategy = new AtLeastTenEarlyBirdSeatsDiscountStrategy($configuration);


        $seat = new Seat('Early bird',10);
        $this->assertEquals(850, $discountStrategy->calculate($seat, 100, null));
    }
}
