<?php

class Application extends Model {

    public static $table_name = 'applications';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'hotel_id',
        'group_id',
        'event_id',
        'user_id',
        'participants',
        'date_of_arrival',
        'date_of_departure',
        'needs_airport_pickup',
        'number_of_rooms',
        'room_1',
        'room_2',
        'room_3',
        'room_4',
        'room_5',
        'remarks',
        'application_is_sent',
        'application_has_answer',
        'invitation_is_sent',
        'invitation_price',
        'invoice_price',
        'invoice_is_paid',
        'group_manager'
    );
    
    public $id;
    public $hotel_id;
    public $group_id;
    public $event_id;
    public $user_id;
    public $participants;
    public $date_of_arrival;
    public $date_of_departure;
    public $needs_airport_pickup;
    public $number_of_rooms;
    public $room_1;
    public $room_2;
    public $room_3;
    public $room_4;
    public $room_5;
    public $remarks;
    public $application_is_sent;
    public $application_has_answer;
    public $invitation_is_sent;
    public $invitation_price;
    public $invoice_price;
    public $invoice_is_paid;
    public $group_manager;

}
