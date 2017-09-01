<?php

namespace RstGroup\ConferenceSystem\Domain\Reservation\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\ConferenceSystem\Domain\Reservation\OrderId;

class ConferenceTest extends TestCase
{

    public function makeReservationForOrder(){
        //czy ordernumber jest int,
        //dostępność miejsc
        //ilosć miejsc

        //sprawdź poprawność orderId
    }

    public function isOrderIdObjectOrderId(){
        //oczekujemy zwrócenia obiektu typu OrderId
    }

    public function isSeatsObjectSeatsCollection(){
        //oczekujemy zwrócenia obiektu typu seatsCollection
    }

    public function reservationDoesExist(){
        //przerwanie
        //taka rezerwacja już istnieje
    }

    public function isReservationCorrectlyInserted(){
        //sprawdzanie czy po zakończeniu rzeczywiście dodano rezerwację
    }

    public function tooLessSitsQuanity(){
        //oczekiwanie większej lub równej ilości miejsc
    }

    public function notAddedIntoWaitList(){
        //oczekiwanie znalezienie numeru rezerwacji w liście
    }

    public function isReturnNull(){
        //oczekiwanie zwrócenia nulla przy poprawnych danych wejściowych
    }
}
