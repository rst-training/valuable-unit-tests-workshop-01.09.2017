<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


class ReservationId
{
    protected $orderId;
    protected $conferenceId;

    public function __construct(ConferenceId $conferenceId, OrderId $orderId)
    {
        $this->orderId = $orderId;
        $this->conferenceId = $conferenceId;
    }

    /**
     * @return OrderId
     */
    public function getOrderId(): OrderId
    {
        return $this->orderId;
    }

    public function getHashKey(): string
    {
        return "{$this->conferenceId->getId()}-{$this->orderId->getId()}";
    }
}