<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ConfirmRegistrationTest extends TestCase
{
    public function check_calculated_total_cost_with_discount(){

        //zmokować paypalPayments

        $ppClass = $this->getMockBuilder(PaypalPayments::class);
        $seatClass = $this->getMockBuilder(Seat::class);
        $getConferenceDao = $this->getMockBuilder(ConferenceSeatsDao::class);
        $seatClass->expects($this->once())
            ->method('getSeats');

        //sprawdzamy RedirectResponse()
        $result = null;
        $this->assertEquals(RedirectResponse::class, $result );
    }
}
?>