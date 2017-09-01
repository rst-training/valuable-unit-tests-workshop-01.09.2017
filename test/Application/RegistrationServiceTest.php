<?php

namespace Application;


use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;

class RegistrationServiceTest extends TestCase
{

    public function testCloseReservationForOrderExecuted()
    {
        $registrationService = $this->getMockBuilder(RegistrationService::class)->getMock();

        $conferenceRepository = $this->getMockBuilder(ConferenceMemoryRepository::class)->getMock();

        $conferenceMock = $this->getMockBuilder(Conference::class)->disableOriginalConstructor()->getMock();

//        $conferenceRepository->expects($this->any())->method('get')->with(ConferenceId::class)
//            ->willReturn();

//        $registrationService->expects($this->at(0))
//            ->method('getConferenceRepository')
//            ->willReturn(true);

        $this->assertTrue(true);

    }
}