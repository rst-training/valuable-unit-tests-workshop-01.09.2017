<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation;

class Seat
{
    private $type;
    private $quantity;
    private $costPerSeat;

    public function __construct(string $type, int $quantity, float $costPer)
    {
        $this->type = $type;

        if (!is_int($quantity) || $quantity < 0) {
            throw new \InvalidArgumentException('Quantity should not be negative');
        }

        $this->quantity = $quantity;
        $this->costPerSeat = $costPer;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getCostPerSeat(): float
    {
        return $this->costPerSeat;
    }
}