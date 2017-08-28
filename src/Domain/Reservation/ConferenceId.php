<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


class ConferenceId
{
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}