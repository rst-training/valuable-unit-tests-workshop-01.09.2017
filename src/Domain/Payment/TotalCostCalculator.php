<?php


namespace RstGroup\ConferenceSystem\Domain\Payment;


use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;

class TotalCostCalculator
{
    /**
     * @var DiscountService
     */
    private $discountService;

    /**
     * TotalCostCalculator constructor.
     * @param DiscountService $discountService
     */
    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * @param DiscountService $discountService
     */
    public function setDiscountService(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function calculate(SeatsCollection $seats, array $seatsPrices)
    {
        $totalCost = 0;
        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];
            $regularPrice = $priceForSeat * $seat->getQuantity();
            $dicountedPrice = $this->discountService->calculateForSeat($seat, $priceForSeat);
            $totalCost += min($dicountedPrice, $regularPrice);
        }

        return $totalCost;
    }
}