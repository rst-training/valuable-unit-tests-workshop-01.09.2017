<?php

namespace RstGroup\ConferenceSystem\Domain\Payment\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Application\CostCalculationService;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDaoInterface;

class CostCalculationServiceTest extends TestCase
{
    /**
     * @test
     */
    public function returns_total_costs_of_order_if_discount_applied()
    {
        $this->markTestSkipped();
//        $conferenceId = new ConferenceId(10);
//        $orderId = new OrderId(11);
//        $seat1 = new Seat('test1', 1);
//        $seat2 = new Seat('test2', 2);
//        $seatsCollection = new SeatsCollection();
//        $seatsCollection->add($seat1);
//        $seatsCollection->add($seat2);
//        $reservationId = new ReservationId($conferenceId, $orderId);
//        $reservation = new Reservation($reservationId, $seatsCollection);
//
//        $conferenceSeatsDao = $this->getMockBuilder(ConferenceSeatsDaoInterface::class)->getMock();
//        $conferenceSeatsDao->method('getSeatsPrices')->willReturn([
//            'test1' => [13],
//            'test2' => [15]
//        ]);
//        $seatsStrategyConfig = new SeatsStrategyConfiguration();
//        $costCalculationService = new CostCalculationService($conferenceSeatsDao, new DiscountService($seatsStrategyConfig));
//        $cost = $costCalculationService->calculate($conferenceId, $reservation);
//        $this->assertEquals(13+2*15, $cost);
    }
}
