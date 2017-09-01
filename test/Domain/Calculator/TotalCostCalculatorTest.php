<?php

namespace RstGroup\ConferenceSystem\Domain\Calculator;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

class TotalCostCalculatorTest extends TestCase
{
    public function test_verifies_total_cost_with_discount_new()
    {
        //Given
        $discountService = $this->getMockBuilder(DiscountService::class)->setMethods([
            'calculateForSeat'
        ])->getMock();
        $discountService->method('calculateForSeat')->willReturn(100);
        $calculator = new TotalCostCalculator($discountService);
        $seats = new SeatsCollection();
        $seats->add(new Seat('foo', 2));
        $seats->add(new Seat('bar', 1));

        $seatsTypePrices = [
            'foo' => 1000,
            'bar' => 2345
        ];

        //Then
        $this->assertEquals(4345, $calculator->calculate($seats, $seatsTypePrices));
    }
}
