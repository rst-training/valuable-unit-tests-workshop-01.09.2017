<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;

class RegistrationServiceTest extends TestCase
{
    /**
     * @test
     */
    public function returns_total_costs_of_order_if_discount_applied()
    {
        $this->markTestSkipped();

//        $conferenceId = $this->getMockBuilder(ConferenceId::class)->getMock();
//        $conferenceRepository = $this->getMockBuilder(ConferenceMemoryRepository::class)->getMock();
//        $conference = $this->getMockBuilder(Conference::class)->getMock();
////        $conference->method('getReservations')->
//        $conferenceRepository->method('get')->with($conferenceId)->willReturn($conference);
//        $registrationService = $this->getMockBuilder(RegistrationService::class)->getMock();
//        $registrationService->method('getConferenceRepository')->with($conference)->willReturn($conferenceRepository);
    }
}
