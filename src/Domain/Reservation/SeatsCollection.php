<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation;

class SeatsCollection
{
    protected $seats = [];

    public function add(Seat $seat)
    {
        $this->seats[] = $seat;
    }

    /**
     * @return Seat[]
     */
    public function getAll(): array
    {
        return $this->seats;
    }

    public static function fromArray(array $seats): SeatsCollection
    {
        $seatsCollection = new self();
        foreach ($seats as $seat) {
            $seatsCollection->add($seat);
        }

        return $seatsCollection;
    }
}