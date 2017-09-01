<?php


namespace RstGroup\ConferenceSystem\Domain\Payment;


use RstGroup\ConferenceSystem\Domain\Reservation\Conference;

class PaypalPayments
{

    public function getApprovalLink(Conference $conference, float $totalCost): string
    {
        return '127.0.0.1';
    }
}