<?php


namespace RstGroup\ConferenceSystem\Infrastructure\Reservation;


interface ConferenceSeatsDaoInterface
{
    public function getSeatsPrices(int $conferenceId): array;
}