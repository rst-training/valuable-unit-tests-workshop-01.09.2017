<?php

namespace Test\Domain\Payment;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Payment\TotalCostCalculator;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

class TotalCostCalculatorTest extends TestCase
{

    private $calculator;

    public function setUp()
    {
        parent::setUp();
    }

    public function testCalculatesTotalCostOfSingleSeatWithoutDiscount()
    {
        $discountServiceMock = $this->getMockBuilder(DiscountService::class)->disableOriginalConstructor()->setMethods(['calculateForSeat'])->getMock();
        $discountServiceMock->expects($this->any())->method('calculateForSeat')->willReturn(30.0);
        $this->calculator = new TotalCostCalculator($discountServiceMock);

        $seats = new SeatsCollection();
        $seats->add(new Seat('testSeat', 1));
        $this->assertEquals(10.0, $this->calculator->calculate($seats, ['testSeat' => [10.0]]));
    }

    public function testCalculatesTotalCostOfThreeSeatsQuantityWithoutDiscount()
    {
        $discountServiceMock = $this->getMockBuilder(DiscountService::class)->disableOriginalConstructor()->setMethods(['calculateForSeat'])->getMock();
        $discountServiceMock->expects($this->any())->method('calculateForSeat')->willReturn(30.0);
        $this->calculator = new TotalCostCalculator($discountServiceMock);

        $seats = new SeatsCollection();
        $seats->add(new Seat('testSeat', 3));
        $this->assertEquals(30.0, $this->calculator->calculate($seats, ['testSeat' => [10.0]]));
    }

    public function testCalculatesTotalCostOfThreeSeatsCollectionWithoutDiscount()
    {
        $discountServiceMock = $this->getMockBuilder(DiscountService::class)->disableOriginalConstructor()->setMethods(['calculateForSeat'])->getMock();
        $discountServiceMock->expects($this->any())->method('calculateForSeat')->willReturn(30.0);
        $this->calculator = new TotalCostCalculator($discountServiceMock);
        $seats = new SeatsCollection();
        $seats->add(new Seat('testSeat', 1));
        $seats->add(new Seat('testSeat', 1));
        $seats->add(new Seat('testSeat', 1));
        $this->assertEquals(30.0, $this->calculator->calculate($seats, ['testSeat' => [10.0]]));
    }


    public function testCalculatesTotalCostOfSingleSeatWithDiscount()
    {
        $discountServiceMock = $this->getMockBuilder(DiscountService::class)->disableOriginalConstructor()->setMethods(['calculateForSeat'])->getMock();
        $discountServiceMock->expects($this->any())->method('calculateForSeat')->willReturn(5.0);
        $this->calculator = new TotalCostCalculator($discountServiceMock);
        $seats = new SeatsCollection();
        $seats->add(new Seat('testSeat', 1));
        $this->assertEquals(5.0, $this->calculator->calculate($seats, ['testSeat' => [10.0]]));
    }

}