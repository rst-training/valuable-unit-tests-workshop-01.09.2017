<?php
namespace RstGroup\ConferenceSystem\Application;

use RstGroup\ConferenceSystem\Domain\Payment\PaypalPayments;
use RstGroup\ConferenceSystem\Domain\Payment\SeatsStrategyConfiguration;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;
use RstGroup\ConferenceSystem\Domain\Payment\DiscountService;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;
use RstGroup\ConferenceSystem\Domain\Reservation\Reservation;
use RstGroup\ConferenceSystem\Domain\Reservation\ReservationId;
use RstGroup\ConferenceSystem\Domain\Reservation\Seat;
use RstGroup\ConferenceSystem\Domain\Reservation\SeatsCollection;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceSeatsDao;
use RstGroup\ConferenceSystem\Infrastructure\Reservation\ConferenceMemoryRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationService
{
private $conferenceMemoryRepository;
private $conferenceSeatsDao;
private $discountService;
private $paypalPayments;

    public function reserveSeats(int $orderId, int $conferenceId, array $seats)
    {
        $conference = $this->getConferenceRepository()->get(new ConferenceId($conferenceId));

        $seatsCollection = $this->fromArray($seats);

        $conference->makeReservationForOrder(new OrderId($orderId), $seatsCollection);
    }

    public function cancelReservation(int $orderId, int $conferenceId)
    {
        $conference = $this->getConferenceRepository()->get(new ConferenceId($conferenceId));

        $conference->cancelReservationForOrder(new OrderId($orderId));
    }

    public function confirmOrder(int $orderId, int $conferenceId)
    {
        $conference = $this->getConferenceRepository()->get(new ConferenceId($conferenceId));
        $reservation = $conference->getReservations()->get(new ReservationId(new ConferenceId($conferenceId), new OrderId($orderId)));

        $totalCost = $this->calculateTotalCost($conferenceId, $reservation);

        $conference->closeReservationForOrder(new OrderId($orderId));

        $approvalLink = $this->getPaypalPayments()->getApprovalLink($conference, $totalCost);

        $response = new RedirectResponse($approvalLink);
        $response->send();
    }

    protected function fromArray(array $seats): SeatsCollection
    {
        $seatsCollection = new SeatsCollection();

        foreach ($seats as $seat) {
            $seatsCollection->add(new Seat($seat['type'], $seat['quantity']));
        }

        return $seatsCollection;
    }

    protected function getConferenceRepository(): ConferenceMemoryRepository
    {
        return new ConferenceMemoryRepository();
    }

    protected function getConferenceDao(): ConferenceSeatsDao
    {
        return new ConferenceSeatsDao(['dns' => 'mysql:host=localhost;dbname=test', 'username' => 'admin', 'password' => 'test', 'options' => []]);
    }

    protected function getDiscountService(): DiscountService
    {
        return new DiscountService(new SeatsStrategyConfiguration());
    }

    protected function getPaypalPayments(): PaypalPayments
    {
        return new PaypalPayments();
    }

    /**
     * @param int $conferenceId
     * @param     $reservation
     *
     * @return int|mixed
     */
    private function calculateTotalCost(int $conferenceId, Reservation $reservation)
    {
        $totalCost = 0;
        $seats = $reservation->getSeats();
        $seatsPrices = $this->getConferenceDao()->getSeatsPrices($conferenceId);

        foreach ($seats->getAll() as $seat) {
            $priceForSeat = $seatsPrices[$seat->getType()][0];

            $dicountedPrice = $this->getDiscountService()->calculateForSeat($seat, $priceForSeat);
            $regularPrice = $priceForSeat * $seat->getQuantity();

            $totalCost += min($dicountedPrice, $regularPrice);
        }
        return $totalCost;
    }
}