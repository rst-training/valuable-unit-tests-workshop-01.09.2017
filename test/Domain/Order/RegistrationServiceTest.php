<?php

namespace RstGroup\ConferenceSystem\Domain;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class RegistrationServiceTest extends TestCase{

    /**
     * @test
     */
    public function conference_calculate_total_cost(){
        // 1
        $conference = new ConferenceId(1);
        $orderid = new OrderId(1);

        $seatArray = [new Seat("first", 2, 10.11)];
        $seatsCollection = SeatsCollection::fromArray($seatArray);

        $reservation = new Reservation(new ReservationId($conference, $orderid), $seatsCollection);

        //
        $returned = $reservation->calculate();
        //

        self::assertEquals(10.22, $returned, '', 0.01);
    }
}