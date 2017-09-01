<?php

namespace RstGroup\ConferenceSystem\Application\RegistrationService\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;

class RegistrationServiceTest extends TestCase
{
    /**
     * @var PaypalPayments
     */
    protected $paypalPaymentsMock;

    public function SetUp()
    {
        $reservationMock = $this->getMockBuilder(Reservation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $reservationRepositoryMock = $this->getMockBuilder(ReservationsCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $reservationRepositoryMock->method('get')
            ->willReturn($reservationMock);

        $conferenceMock = $this->getMockBuilder(Conference::class)
            ->disableOriginalConstructor()
            ->getMock();

        $conferenceRepositoryMock = $this->getMockBuilder(ConferenceMemoryRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $conferenceRepositoryMock->method('get')
            ->willReturn($conferenceMock);

        $conferenceMock->method('getReservations')
            ->willReturn($reservationRepositoryMock);

        $seatsMock = $this->getMockBuilder(SeatsCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seatsArray = [];

        $seatsMock->method('getAll')->willReturn($seatsArray);

        $this->paypalPaymentsMock = $this->getMockBuilder(PaypalPayments::class)
            ->disableOriginalConstructor()
            ->getMock();


    }
}