<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategyInterface;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategyInterface;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountServiceTest extends TestCase
{
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $discountService = new DiscountService($configuration);
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();

        $configuration->expects($this->at(0))->method('isEnabledForSeat')->with(AtLeastTenEarlyBirdSeatsDiscountStrategyInterface::class)->willReturn(true);
        $configuration->expects($this->at(1))->method('isEnabledForSeat')->with(FreeSeatDiscountStrategyInterface::class)->willReturn(false);
        $seat->expects($this->exactly(2))->method('getQuantity')->willReturn(10);

        $this->assertEquals(59.5, $discountService->calculateForSeat($seat, 7), 0.01);
    }

    /**
     * @test
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought_new_version()
    {
        $this->assertEquals(59.5, (new AtLeastTenEarlyBirdSeatsDiscountStrategyInterface())->calculate(new Seat('xyz', 10), 7, null));
    }
}
