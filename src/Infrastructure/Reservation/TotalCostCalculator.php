<?php

namespace RstGroup\ConferenceSystem\Infrastructure\Reservation;

use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;

class TotalCostCalculator
{
    /**
     * @var array
     */
    private $seatsPrices;

    /**
     * @var DiscountService
     */
    private $discountService;

    /**
     * TotalCostCalculator constructor.
     * @param array $seatsPrices
     * @param DiscountService $discountService
     */
    public function __construct(array $seatsPrices, DiscountService $discountService)
    {
        $this->seatsPrices = $seatsPrices;
        $this->discountService = $discountService;
    }

    /**
     * @param Reservation $reservation
     * @return int
     */
    public function calculate(Reservation $reservation)
    {
        $totalCost = 0;

        foreach ($reservation->getSeats()->getAll() as $seat) {
            $priceForSeat = $this->seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }
        return $totalCost;
    }
}