<?php
/**
 * Created by PhpStorm.
 * User: MATI
 * Date: 2017-09-01
 * Time: 15:30
 */

namespace RstGroup\ConferenceSystem\Domain\Payment;


use RstGroup\ConferenceSystem\Domain\Reservation\Seat;

class SeatPoolStrategy{
    /**
     * @var integer
     */
    private $pool;
    /**
     * @var int
     */
    private $value;

    /**
     * SeatPoolStrategy constructor.
     * @param int $pool
     * @param int $value
     */
    public function __construct($pool, $value)
    {
        $this->pool = $pool;
        $this->value = $value;
    }


    /**
     * @return int
     */
    public function getPool(): int
    {
        return $this->pool;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }


    public function calculate(Seat $seat){
        return $seat->getCostPerSeat() - $this->getValue();
    }

}