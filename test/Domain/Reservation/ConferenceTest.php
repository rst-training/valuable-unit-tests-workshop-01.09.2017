<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;

use PHPUnit\Framework\TestCase;

class ConferenceTest extends TestCase
{
    /**
     * @todo: remove it
     */
    public function test_example_name()
    {
        $this->markTestSkipped();
    }

    public function test_it_throw_exception_when_reservation_does_not_have_order() {}

    public function test_it_increment_available_seats_quantity() {}

    public function test_it_remove_reservation() {}

    public function test_it_does_not_move_reservation_from_waitlist_when_seats_are_not_available() {}

    public function test_it_move_reservation_from_waitlist_when_seats_are_available() {}


}
