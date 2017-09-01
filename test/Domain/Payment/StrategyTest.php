<?php

namespace Test\Domain\Payment;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class StrategyTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought()
    {
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();
        $seat->method('getQuantity')->willReturn(10);
        $strategy = new AtLeastTenEarlyBirdSeatsDiscountStrategy();
        $this->assertEquals(59.5, $strategy->calculate($seat, 7, null));
    }

}