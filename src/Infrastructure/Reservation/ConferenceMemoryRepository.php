<?php

namespace RstGroup\ConferenceSystem\Infrastructure\Reservation;

use RstGroup\ConferenceSystem\Domain\Reservation\Conference;
use RstGroup\ConferenceSystem\Domain\Reservation\ConferenceId;

class ConferenceMemoryRepository
{
    protected $conferences = [];

    public function add(Conference $conference)
    {
        $this->conferences[$conference->getId()->getId()] = $conference;
    }

    public function get(ConferenceId $id): Conference
    {
        return $this->conferences[$id->getId()];
    }
}