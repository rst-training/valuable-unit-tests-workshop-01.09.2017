<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;


use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

/**
 * @author Grzegorz Stawarczyk <grzegorz.stawarczyk@gmail.com>
 */
class AtLeastTenEarlyBirdSeatsDiscountStrategyTest extends TestCase
{
    /**
     * @test
     */
    public function returns_price_discounted_by_15_percent_if_at_least_10_early_bird_seats_are_bought_refactored()
    {
        $strategy = new AtLeastTenEarlyBirdSeatsDiscountStrategy();
        $seat = new Seat('foo', 10);

        $this->assertEquals(59.5, $strategy->calculate($seat, 7, null), 0.01);
    }
}
