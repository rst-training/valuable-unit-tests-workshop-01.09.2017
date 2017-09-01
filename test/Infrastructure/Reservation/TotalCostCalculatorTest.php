<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\TotalCostCalculator;

class TotalCostCalculatorTest extends TestCase
{

    /**
     * @test
     */
    public function testCalculate_noSeatsNoDiscount_totalIsZero()
    {
        $seatsPrices[0][0] = 10;
        $seatsPrices[1][0] = 20;

        $reservationMock = $this->getMockBuilder(Reservation::class)->disableOriginalConstructor()->getMock();
        $discountServiceMock = $this->getMockBuilder(DiscountService::class)->disableOriginalConstructor()->getMock();
        $discountServiceMock->method('calculateForSeat')->willReturn(100000); #some high number
        $reservationMock->expects($this->once())->method('getSeats')->willReturn(new SeatsCollection());

        $calculator = new TotalCostCalculator($seatsPrices, $discountServiceMock);

        $this->assertEquals(0, $calculator->calculate($reservationMock));
    }

    /**
     * @test
     */
    public function testCalculate_noSeatsNoDiscount_total()
    {
        $seatsPrices[0][0] = 10;
        $seatsPrices[1][0] = 20;

        $seats = new SeatsCollection();
        $seats->add((new Seat(0, 1)));
        $seats->add((new Seat(1, 2)));

        $reservationMock = $this->getMockBuilder(Reservation::class)->disableOriginalConstructor()->getMock();
        $discountServiceMock = $this->getMockBuilder(DiscountService::class)->disableOriginalConstructor()->getMock();
        $discountServiceMock->method('calculateForSeat')->willReturn(100000); #some high number
        $reservationMock->expects($this->once())->method('getSeats')->willReturn($seats);

        $calculator = new TotalCostCalculator($seatsPrices, $discountServiceMock);

        $this->assertEquals(50, $calculator->calculate($reservationMock));
    }
}
