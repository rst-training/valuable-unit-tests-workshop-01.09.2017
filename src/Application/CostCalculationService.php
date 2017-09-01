<?php

namespace RstGroup\ConferenceSystem\Application;

use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDaoInterface;

class CostCalculationService
{
    private $conferenceSeatsDao;
    private $discountService;
    public function __construct(ConferenceSeatsDaoInterface $conferenceSeatsDao, DiscountService $discountService)
    {
        $this->conferenceSeatsDao = $conferenceSeatsDao;
        $this->discountService = $discountService;
    }

    public function calculate(ConferenceId $conferenceId, Reservation $reservation)
    {
        $totalCost = 0;
        $seats = $reservation->getSeats();
        $seatsPrices = $this->conferenceSeatsDao->getSeatsPrices($conferenceId);

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }
        return $totalCost;
    }
}