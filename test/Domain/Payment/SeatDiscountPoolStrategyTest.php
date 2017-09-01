<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\SeatDiscountPoolStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountPoolInterface;

class SeatDiscountPoolStrategyTest extends TestCase
{
    /**
     * @test
     */
    public function returnsPriceMultiplicatedByQuantityIfNoDiscountAvailable()
    {
        $pool = \Mockery::mock(DiscountPoolInterface::class);
        $pool->shouldReceive('getCount')
            ->andReturn(0);
        $pool->shouldReceive('getDiscountValue')
            ->andReturn(0);

        $strategy = new SeatDiscountPoolStrategy($pool);

        $this->assertEquals(250, $strategy->calculate(50, 5));
    }

    /**
     * @test
     */
    public function returnsDiscountedPriceMultiplicatedByQuantityWhenRequestQuantityIsLowerThanAvailablePoolCount()
    {
        $pool = \Mockery::mock(DiscountPoolInterface::class);
        $pool->shouldReceive('getCount')
            ->andReturn(100);
        $pool->shouldReceive('getDiscountValue')
            ->andReturn(10);

        $strategy = new SeatDiscountPoolStrategy($pool);

        $this->assertEquals(400, $strategy->calculate(50, 10));
    }

    /**
     * @test
     */
    public function returnsDiscountedValueWhenRequestedQuantityIsHigherThanAvailablePoolCount()
    {
        $pool = \Mockery::mock(DiscountPoolInterface::class);
        $pool->shouldReceive('getCount')
            ->andReturn(10);
        $pool->shouldReceive('getDiscountValue')
            ->andReturn(10);

        $strategy = new SeatDiscountPoolStrategy($pool);

        $this->assertEquals(4900, $strategy->calculate(50, 100));
    }
}
