<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use RstGroup\ConferenceSystem\Application\RegistrationService;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\TotalPriceService;
use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class ConferenceTest extends TestCase
{
    public function test_it_throw_exception_when_reservation_does_not_have_order() {}

    public function test_it_increment_available_seats_quantity() {}

    public function test_it_remove_reservation() {}

    public function test_it_does_not_move_reservation_from_waitlist_when_seats_are_not_available() {}

    public function test_it_move_reservation_from_waitlist_when_seats_are_available() {}

    /**
     * @group invalid
     */
    public function test_confirm_order_close_reservation()
    {
        $registrationService = $this->prophesize(RegistrationService::class);
        $conference = $this->prophesize(Conference::class);
        $reservation = $this->prophesize(Reservation::class);
        $conferenceMemoryRepository = $this->prophesize(ConferenceMemoryRepository::class);
        $reservationsCollection = $this->prophesize(ReservationsCollection::class);

        $registrationService->getConferenceRepository()->willReturn($conferenceMemoryRepository);
        $conference->getReservations()->willReturn($reservationsCollection);
        $reservationsCollection->get()->willReturn($reservation);

//        $conference->reveal();
        $conference->closeReservationForOrder()->shouldBeCalled();

//        $registrationService->reveal();

        $this->assertTrue(true);
    }

    /**
     * @group wip
     */
    public function test_total_price_service_calculate_total_price_with_discounts()
    {
        $seats = new SeatsCollection();
        $seats->add(new Seat('workshop', 10));

        $reservation = $this->prophesize(Reservation::class);
        $reservation->getSeats()->willReturn($seats);

        $conferenceSeatsDao = $this->prophesize(ConferenceSeatsDao::class);
        $conferenceSeatsDao->getSeatsPrices(0)->willReturn(['workshop' => 1.0]);

        $discountService = $this->prophesize(DiscountService::class);
        $discountService->calculateForSeat()->willReturn(0);

        $totalPriceService = new TotalPriceService($discountService->reveal(), $conferenceSeatsDao->reveal());

        $this->assertEquals(199, $totalPriceService->calculateTotalCost($reservation->reveal(), 0));
    }
}
