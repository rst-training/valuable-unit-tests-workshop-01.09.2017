<?php

namespace RstGroup\ConferenceSystem\Application\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;

class RegistrationServiceTest extends TestCase
{
    /**
     * @test
     */
    public function test_calculation_of_discounted_totalcost()
    {        
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $discountService = new DiscountService($configuration);
        $seat = $this->getMockBuilder(Seat::class)->disableOriginalConstructor()->getMock();

        $payPalPayments = $this->getMockBuilder(PaypalPayments::class)->getMock();
        
    }
}
