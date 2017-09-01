<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\AtLeastTenEarlyBirdSeatsDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\FreeSeatDiscountStrategy;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class RegistrationServiceTest extends TestCase
{
    /**
     * @test
     */
    public function testConfirmOrder_calculateTotalCostWithDiscount()
    {
        $total = 10;

        $conference = $this->getMockBuilder(Conference::class)->getMock();
        $payments = $this->getMockBuilder(PaypalPayments::class)->getMock();
        $payments->expects($this->once())->method('getApprovalLink')->with($conference, $total)->willReturn('');

    }
}
