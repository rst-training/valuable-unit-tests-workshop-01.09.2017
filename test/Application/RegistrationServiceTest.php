<?php

namespace RstGroup\ConferenceSystem\Application\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;

class RegistrationServiceTest extends TestCase
{
    public function testCalculationOfTotalCostWithDiscount()
    {
        // Given ?
        $paypalPayments = \Mockery::mock(PaypalPayments::class);
        $paypalPayments
            ->shouldReceive('getApprovalLink')
            ->with(\Mockery::on(function($conference, $totalCost) {
                var_dump($totalCost);
            }))
            ->andReturn('');

        $conferenceRepository = \Mockery::mock(ConferenceMemoryRepositroy::class)
            ->shouldReceive('get')
            ->andReturn(null);
        
        $service = \Mockery::mock(RegistrationService::class)->makePartial();
        $service->shouldAllowMockingProtectedMethods();
        $service
            ->shouldReceive('getPaypalPayments')
            ->andReturn($paypalPayments);

        $service->confirmOrder(1, 2);
    }
}
