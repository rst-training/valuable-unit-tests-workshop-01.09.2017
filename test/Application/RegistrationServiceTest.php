<?php
namespace RstGroup\ConferenceSystem\Test\Application;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class RegistrationServiceTest extends TestCase
{
    public function test_calculate_total_cost_with_discount_when_confirming_order()
    {
        $orderId = 1;
        $conferenceId = 1;

        $seats = new SeatsCollection();
        $seats->add(new Seat('xyz', 50));

        $reservation = $this->createMock(ReservationsCollection::class);
        $reservation->method('get')->willReturn(new Reservation(new ReservationId(new ConferenceId($conferenceId), new OrderId($orderId)), $seats));

        $conference = $this->createMock(Conference::class);
        $conference->method('getReservations')->willReturn($reservation);

        $conferenceMemoryRepository = $this->createMock(ConferenceMemoryRepository::class);
        $conferenceMemoryRepository->method('get')->willReturn($conference);

        // TODO:
    }
}
