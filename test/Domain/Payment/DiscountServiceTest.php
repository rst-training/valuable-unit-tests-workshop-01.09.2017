<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountPool;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountPoolStrategy;
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
    public function discountBy15PercentOn10EarlyBirdSeatsBought()
    {
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $configuration->method('isEnabledForSeat')->willReturn(true);
        $discount = new DiscountService($configuration);

        $discount->enableStrategy(AtLeastTenEarlyBirdSeatsDiscountStrategy::class);

        $seat = new Seat('early', 10);
        $this->assertEquals(59.5, $discount->calculateForSeat($seat, 7));
    }
    /**
     * @test
     */
    public function isDiscountPoolDecrementItself()
    {
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $configuration->method('isEnabledForSeat')->willReturn(true);
        $discount = new DiscountService($configuration);

        $pool = new DiscountPool(100);
        $discount->enableStrategy(DiscountPoolStrategy::class, $pool);

        $seat = new Seat('early', 10);
        $discount->calculateForSeat($seat, 7);
        $this->assertEquals(90, $pool->getLeftSeats());
    }
    /**
     * @test
     */
    public function discountPoolDecrementation() {
        $pool = new DiscountPool(100);
        $this->assertEquals(100, $pool->decrement(110));
        $this->assertEquals(0, $pool->getLeftSeats());
    }
}
