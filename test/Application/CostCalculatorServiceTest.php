<?php

namespace RstGroup\ConferenceSystem\Application\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\CostCalculatorService;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class CostCalculatorServiceTest extends TestCase
{
    public function testCalculateWithDiscount()
    {
        $discountService = \Mockery::mock(DiscountService::class)
            ->shouldReceive('calculateForSeat');
        $service = new CostCalculatorService($discountService);

        $seats = [
            new Seat('normal', 20),
            new Seat('early_bird', 11),
        ];
        $seatsPrices = [
            'normal' => [ 22 ],
            'early_bird' => [ 70 ],
        ];
        $expected = 0;

        $cost = $service->calculate($seats, $seatsPrices);

        $this->assertEquals($expected, $cost);
    }
}
