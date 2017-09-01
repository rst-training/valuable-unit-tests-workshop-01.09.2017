<?php
/**
 * Created by PhpStorm.
 * User: grzegorz
 * Date: 01.09.17
 * Time: 12:38
 */

namespace RstGroup\ConferenceSystem\Domain\Calculator;


use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsWithPriceCollection;

class TotalCostCalculator
{
    /**
     * @var DiscountService
     */
    private $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function calculate(SeatsCollection $seats, array $seatsPrices): int
    {
        $totalCost = 0;

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()];

            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }

        return $totalCost;
    }
}