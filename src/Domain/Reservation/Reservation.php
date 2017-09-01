<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;

class Reservation
{
    protected $reservationId;
    protected $seats;
    protected $seatPrices;
    protected $discountService;


    public function __construct(ReservationId $reservationId, SeatsCollection $seats, DiscountService $discountService, array $seatPrices)
    {
        $this->reservationId = $reservationId;
        $this->seats = $seats;
        $this->seatPrices = $seatPrices;
        $this->discountService = $discountService;
    }

    public function getReservationId(): ReservationId
    {
        return $this->reservationId;
    }

    public function getSeats(): SeatsCollection
    {
        return $this->seats;
    }

    /**
     * @return float|int
     */
    public function getTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->getSeats()->getAll() as $seat)
        {
            $totalPrice += $this->getSeatPrice($seat);
        }

        return $totalPrice;
    }

    /**
     * @param Seat $seat
     * @return float
     * @throws \Exception
     *
     * @FIXME: Extract to separate class (PricingService)
     */
    protected function getSeatPrice(Seat $seat) {
        if (! key_exists($seat->getType(), $this->seatPrices)) {
            throw new \Exception('No price for '.$seat->getType());
        }

        $basicPrice = $this->seatPrices[$seat->getType()][0];
        $discountPrice = $this->discountService->calculateForSeat($seat, $basicPrice);

        $bestPrice = min($basicPrice, $discountPrice);

        return $bestPrice * $seat->getQuantity();
    }
}