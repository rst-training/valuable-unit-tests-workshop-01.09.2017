<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


class SeatsAvailabilityCollection
{
    protected $seats = [];

    public function set(string $type, int $quantity)
    {
        $this->seats[$type] = $quantity;
    }

    public function getQuantity($type): int
    {
        return $this->seats[$type];
    }

    public function decrementQuantity($type, $quantity)
    {
        $this->seats[$type] -= $quantity;
    }

    public function incrementQuantity($type, $quantity)
    {
        $this->seats[$type] += $quantity;
    }

    /**
     * @param Seat[] $seats
     */
    public static function fromArray(array $seats): SeatsCollection
    {
        $seatsCollection = new self();
        foreach ($seats as $seat) {
            $seatsCollection->set($seat->getType(), $seat->getQuantity());
        }

        return $seatsCollection;
    }
}