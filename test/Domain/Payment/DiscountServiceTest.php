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
     * @dataProvider dataSeats
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought($numberOfSeats, $pricePerSeat, $expectedPrice)
    {
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();
        $seat->method('getQuantity')->willReturn($numberOfSeats);

        $discountService = new AtLeastTenEarlyBirdSeatsDiscountStrategy();

        $this->assertEquals($expectedPrice, $discountService->calculate($seat, $pricePerSeat));
    }

    public function dataSeats()
    {
        return [
            [11, 10, 93.5],
            [10, 10, 85],
            [9, 10, 90],
            [100, 0, 0],
            [1, 0, 0],
            [0, 0, 0],
            [1, 1, 1],
            [10, 1, 8.5]
        ];
    }
}
