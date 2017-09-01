<?php

namespace RstGroup\ConferenceSystem\Application;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsAvailabilityCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

/**
 * @author Grzegorz Stawarczyk <grzegorz.stawarczyk@gmail.com>
 */
class RegistrationServiceTest extends TestCase
{
    public function verifies_total_cost_with_discount()
    {
        $this->markTestSkipped();
        //Given
        $registrationService = $this->getMockBuilder(RegistrationService::class)->setMethods([
            'getPaypalPayments',
            'getConferenceRepository'
        ])->getMock();

        $paypalPayment = $this->getMockBuilder(PaypalPayments::class)->setMethods([
            'getApprovalLink'
        ])->getMock();
        $seats = new SeatsAvailabilityCollection();
        $seats->set('foo', 2);
        $reservations = new ReservationsCollection();
        $reservations->add(new Reservation(new ReservationId(new ConferenceId(1)), new SeatsCollection()));
        $conference = new Conference(new ConferenceId(1), $seats, $reservations);

        $registrationService->method('getPaypalPayments')->willReturn($paypalPayment);
        $registrationService->method('getConferenceRepository')->willReturn($paypalPayment);
        //Expect
        $paypalPayment->expects($this->once())->method('getApprovalLink')->with();

        //When
        $registrationService->confirmOrder(1, 1);
    }
}
