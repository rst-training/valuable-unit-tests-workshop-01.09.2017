<?php


namespace RstGroup\ConferenceSystem\Domain\Reservation;


class OrderId
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

    public function getDiscountPriceFor(string $type){
        if($type == "first"){
            return 10;
        }else{
            return 0;
        }
    }
}