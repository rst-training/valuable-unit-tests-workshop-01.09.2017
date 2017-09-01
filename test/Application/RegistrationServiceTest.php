<?php

namespace RstGroup\ConferenceSystem\Test\Application;

use RstGroup\ConferenceSystem\Application\RegistrationService;
use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class RegistrationServiceTest extends TestCase
{
    public function testGetTotalCostWithDiscountAfterConfirmation() {

        $seats = $this->createMock(ReservationsCollection::class);
        $seats->method('getAll')->willReturn([new Seat('disc', 5)]);
        $conferences = $this->createMock(ConferenceMemoryRepository::class);
        $conf = $this->createMock(Conference::class);
        $conf->method('getReservations')->withAnyParameters()->willReturn($seats);
        $conferences->method('get')->withAnyParameters()->willReturn($conf);

        $dao = $this->createMock(ConferenceSeatsDao::class);
        $dao->method('getSeatsPrices')->withAnyParameters()->willReturn([['disc'], 2]);

        $service = new RegistrationService($conferences, $dao, new DiscountService(new SeatsStrategyConfiguration()), new PaypalPayments());

        $this->assertEquals($service->confirmOrder(1,1), 0);
    }
}