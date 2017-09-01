<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ConfirmRegistrationTest extends TestCase
{
    public function check_calculated_total_cost_with_discount()
    {

        $orderId = new OrderId(1);
        $conferernceId = new ConferenceId(1);
        $totalCost = 0;
        //$seats = [new Seat['x', 2]];

        //pobranie miejsc
        $registrationMock = $this->getMockBuilder(RegistrationService::class)->getMethods(['calculate'])->getMock();

        $registrationMock->expects($this->once())
                ->method('calculate')
        ;


        $this->assertEquals(1000, $totalCost);

    }
}
?>