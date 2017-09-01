<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\TotalPriceService;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class TotalPriceServiceTest extends TestCase
{
    /**
     * @group invalid
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
