<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


class Reservation
{
    protected $reservationId;
    protected $seats;

    public function __construct(ReservationId $reservationId, SeatsCollection $seats)
    {
        $this->reservationId = $reservationId;
        $this->seats = $seats;
    }

    public function getReservationId(): ReservationId
    {
        return $this->reservationId;
    }

    public function getSeats(): SeatsCollection
    {
        return $this->seats;
    }
}