<?php


namespace RstGroup\ConferenceSystem\Domain\Payment;


class PaypalPayments
{

    public function getApprovalLink(Conference $conference, float $totalCost): string
    {
        return '';
    }
}