<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatPoolStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class DiscountServiceTest extends TestCase
{
    /**
     * @test
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $discountService = new DiscountService($configuration);
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();

        $configuration->expects($this->at(0))->method('isEnabledForSeat')->with(AtLeastTenEarlyBirdSeatsDiscountStrategy::class)->willReturn(true);
        $configuration->expects($this->at(1))->method('isEnabledForSeat')->with(FreeSeatDiscountStrategy::class)->willReturn(false);
        $seat->expects($this->exactly(2))->method('getQuantity')->willReturn(10);

        $this->assertEquals(59.5, $discountService->calculateForSeat($seat, 7), 0.01);
    }

    /**
     * @test
     */
    public function check_15_percent_discount_if_at_least_10_seats(){
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $configuration->method("isEnabledForSeat")->willReturn(true);

        $strategy = new AtLeastTenEarlyBirdSeatsDiscountStrategy($configuration);

        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();
        $seat->method("getQuantity")->willReturn(10);

        $returned = $strategy->calculate($seat, 10, null);

        self::assertEquals(85, $returned);
    }

    /**
     * @test
     */
    public function returns_number_of_discounts_for_50_PLN_when_for_each_seat(){
        $strategy = new SeatPoolStrategy(100, 50);
        $result = $strategy->calculate(new Seat("test", 1, 60));

        self::assertEquals(10, $result);
    }
}
