<?php

namespace RstGroup\ConferenceSystem\Infrastructure\Reservation;

class ConferenceSeatsDao implements ConferenceSeatsDaoInterface
{
    protected $connection;

    public function __construct(array $config)
    {
        $this->connection = new \PDO($config['dns'], $config['username'], $config['password'], $config['options']);
    }

    /**
     * @return SeatPrice[]
     */
    public function getSeatsPrices(int $conferenceId): array
    {
        $sth = $this->connection->prepare("SELECT seat_type, price FROM conference_seats WHERE conference_id = :conference_id");
        $sth->bindParam(':conference_id', $conferenceId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_COLUMN|\PDO::FETCH_GROUP);
    }
}