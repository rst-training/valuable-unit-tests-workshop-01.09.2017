<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


class ReservationsCollection
{
    protected $reservations = [];

    public function add(Reservation $reservation)
    {
        $this->reservations[$reservation->getReservationId()->getHashKey()] = $reservation;
    }

    public function has(ReservationId $reservationId): bool
    {
        return array_key_exists($reservationId->getHashKey(), $this->reservations);
    }

    public function remove(ReservationId $reservationId)
    {
        unset($this->reservations[$reservationId->getHashKey()]);
    }

    /**
     * @return Reservation
     */
    public function get(ReservationId $reservationId): Reservation
    {
        return $this->reservations[$reservationId->getHashKey()];
    }


    /**
     * @return Reservation[]
     */
    public function getAll(): array
    {
        return $this->reservations;
    }

    public static function fromArray(array $reservations): ReservationsCollection
    {
        $reservationsCollection = new self();
        foreach ($reservations as $reservation) {
            $reservationsCollection->add($reservation);
        }

        return $reservationsCollection;
    }
}