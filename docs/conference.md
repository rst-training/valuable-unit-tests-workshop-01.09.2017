test_make_reservation_reservation_exists()
Konferencja sprawdza czy rezerwacja dla tego zamówienia istnieje przy probie dodania
test_make_reservation_reservation_waitlist()
Konferencja dodaje zamówienie do listy oczekujących
    test_make_reservation_reservation_completed()
Konferencja sprawdza czy rezerwacja została dodana poprawnie
    test_make_reservation_invalid_order_id()
Konferencja sprawdza czy identyfikator zamówienia jest poprawny przed dodaniem rezerwacji
    test_make_reservation_empty_seat_collection()
Konferencja nie dodaje rezerwacji jeśli nie ma miejsc
    test_make_reservation_multiple_seat_types_with_one_seat_type_exceeded_exceeded_first()
Konferencja sprawdza czy pierwszy typ miejsc z zamówienia jest wolny
    test_make_reservation_multiple_seat_types_with_one_seat_type_exceeded_exceeded_last()
Konferencja sprawdza czy ostatni typ miejsc z zamówienia jest wolny
    test_make_reservation_multiple_seat_types_with_one_seat_type_exceeded_exceeded_middle()
Konferencja sprawdza czy środkowy typ miejsc z zamówienia jest wolny
    test_make_reservation_multiple_seat_types_with_all_seat_types_exceeded()
Konferencja nie dodaje rezerwacji jeśli nie ma wolnych typów miejsc
    test_make_reservation_multiple_seat_types_with_all_seat_types_quantity_valid()
Konferencja sprawdza poprawność ilości wolnych miejsc
