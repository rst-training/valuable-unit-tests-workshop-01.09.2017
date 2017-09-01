<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;

class TotalPriceService
{
    /**
     * @var DiscountService
     */
    private $discountService;
    /**
     * @var ConferenceSeatsDao
     */
    private $conferenceSeatsDao;

    /**
     * TotalPriceService constructor.
     * @param DiscountService $discountService
     * @param ConferenceSeatsDao $conferenceSeatsDao
     */
    public function __construct(DiscountService $discountService, ConferenceSeatsDao $conferenceSeatsDao)
    {

        $this->discountService = $discountService;
        $this->conferenceSeatsDao = $conferenceSeatsDao;
    }

    public function calculateTotalCost(Reservation $reservation, $conferenceId)
    {
        $seats = $reservation->getSeats();
        $seatsPrices = $this->conferenceSeatsDao->getSeatsPrices($conferenceId);

        $totalCost = 0;

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }

        return $totalCost;

    }
}
