<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

class ReservationTest extends TestCase
{
    /**
     * @var Reservation
     */
    protected $reservation;

    protected $seats;

    public function SetUp()
    {
        $this->seats = $this->getMockBuilder(SeatsCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $reservationIdMock = $this->getMockBuilder(ReservationId::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seatsCollectionMock = $this->getMockBuilder(SeatsCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seatsCollectionMock->method('getAll')
            ->willReturn($this->seats);

        $discountServiceMock = $this->getMockBuilder(DiscountService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reservation = $this->getMockBuilder(Reservation::class)
            ->setConstructorArgs([
                $reservationIdMock,
                $seatsCollectionMock,
                $discountServiceMock,
                [
                    'first' => 0.5,
                    'second' => 50,
                    'third' => 666
                ]
            ]);
    }

//    public function test_calculate_price_returns_zero_when_no_seats()
//    {
//        $this->seats = [];
//        $this->assertEquals(0, $this->reservation->getTotalPrice());
//    }
}