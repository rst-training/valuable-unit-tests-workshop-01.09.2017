<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation;

class Seat
{
    private $type;
    private $quantity;
    private $pricePerSeat;

    public function __construct(string $type, int $quantity, float $pricePerSeat)
    {
        $this->type = $type;

        if (!is_int($quantity) || $quantity < 0) {
            throw new \InvalidArgumentException('Quantity should not be negative');
        }

        $this->quantity = $quantity;
        $this->pricePerSeat = $pricePerSeat;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPricePerSeat(): float
    {
        return $this->pricePerSeat;
    }
}