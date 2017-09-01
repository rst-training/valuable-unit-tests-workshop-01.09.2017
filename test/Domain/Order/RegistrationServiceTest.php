<?php

namespace RstGroup\ConferenceSystem\Domain;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class RegistrationServiceTest extends TestCase{

    /**
     * @test
     */
    public function verifies(){
        $registrationService = $this->getMockBuilder(RegistrationService::class)->getMock();
        $configuration = $this->getMockBuilder(SeatsStrategyConfiguration::class)->getMock();
        $discountService = $this->getMockBuilder(DiscountService::class)->setConstructorArgs([$configuration])->getMock();

        //$discountService->method();
        $registrationService->method("getDiscountService")->willReturn($discountService);

        $conferenceSeatsDao = $this->getMockBuilder(ConferenceSeatsDao::class)->disableOriginalConstructor()->getMock();
        $array1 = [];
        $conferenceSeatsDao->method("getSeatsPrices")->willReturn($array1);
        $registrationService->method("getConferenceDao")->willReturn($conferenceSeatsDao);


    }
}