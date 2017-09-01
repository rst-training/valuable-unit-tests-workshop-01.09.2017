<?php

namespace RstGroup\ConferenceSystem\Domain\Payment;

interface DiscountPoolInterface
{
    public function getCount(): int;
    public function getDiscountValue(): float;
}
