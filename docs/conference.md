### Anulowanie rejestracji

* W trakcie anulowania rezerwacji musi odbyć się sprawdzenie czy rezerwacja istnieje `testReservationExistanceChecked`
* Po wykonaniu anulowania - ilość miejsc powinna zostać zwiększona `testSeatsQuantityIncremented`
* Anulowanie musi skutkować wyrzuceniem rezerwacji z bazy danych `testReservationRemoval`
* Anulowanie skutkuje wyrzuceniem pozycji z listy oczekujących `testWaitListItemMoved`
* Po anulowaniu wykonana jest metoda dodająca rezerwację z listy oczekujących `testWaitListReservationAdded`