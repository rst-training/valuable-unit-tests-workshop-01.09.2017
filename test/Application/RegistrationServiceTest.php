<?php
namespace RstGroup\ConferenceSystem\Test\Application;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
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
    /**
     * @deprecated
     */
    public function calculate_total_cost_with_discount_when_confirming_order()
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

    public function test_calculate_total_cost_without_discount()
    {
        $discount = $this->createMock(DiscountService::class);
        $discount->method('calculateForSeat')->willReturn(null);

        $seats = new SeatsCollection();
        $seats->add(new Seat('xyz', 10, 49.90));

        $registrationService = new RegistrationService();
        $totalCost = $registrationService->calculateTotalCost($seats);

        $this->assertEquals(499, $totalCost);
        $this->assertInternalType('float', $totalCost);
    }

    public function test_calculate_total_cost_with_discount()
    {
        $discount = $this->createMock(DiscountService::class);
        $discount->method('calculateForSeat')->willReturn(499.00);

        $seats = new SeatsCollection();
        $seats->add(new Seat('xyz', 10, 49.90));

        $registrationService = new RegistrationService();
        $totalCost = $registrationService->calculateTotalCost($seats);

        $this->assertEquals(449.10, $totalCost);
        $this->assertInternalType('float', $totalCost);
    }
}
