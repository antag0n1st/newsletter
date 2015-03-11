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
        'group_manager',
        'created_at'
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
    public $created_at;
    
    public static function get_application_by_id($id){
        
        $query = " SELECT a.id as application_id , a.* , g.* , c.*,cg.*,h.*,e.*,f.*,u.* ";
        $query .= " FROM applications as a ";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " JOIN countries as c ON g.country_id = c.id ";
        $query .= " JOIN categories as cg ON g.category_id = cg.id ";
        $query .= " JOIN hotels as h ON a.hotel_id = h.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN users as u ON a.user_id = u.user_id ";
        
        $query .= " WHERE a.id = '".Model::db()->prep($id)."' ";
        
        
        $result = Model::db()->query($query);

        while ($row = Model::db()->fetch_assoc($result)) {     
           $row['event_started_at'] = date('d M Y', strtotime($row['event_started_at']));
           return $row;
        }
        
        return array();
    }

    public static function list_of_applications($filter = ''){
        
        $query = " SELECT a.* , g.group_name , f.festival_name , e.event_started_at , u.username ";
        $query .= " FROM applications as a ";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN users as u ON a.user_id = u.user_id ";
        
        if($filter == "application-is-not-sent") {
            $query .= " WHERE application_is_sent = 0";
        } else if($filter == "application-is-sent") {
            $query .= " WHERE application_is_sent = 1 AND application_has_answer = 0";
        } else if($filter == "application-is-answered") {
            $query .= " WHERE application_has_answer = 1 AND invitation_is_sent = 0";
        } else if($filter == "invitation-is-sent") {
            $query .= " WHERE invitation_is_sent = 1 AND invoice_is_paid = 0";
        } else if($filter == "invoice-is-paid") {
            $query .= " WHERE invoice_is_paid = 1";
        }

        $result = Model::db()->query($query);

        $applications = array();

        while ($row = Model::db()->fetch_assoc($result)) {     
           $row['event_started_at'] = date('d M Y', strtotime($row['event_started_at']));
           $applications[] = $row;
        }

        return $applications;
        
    }
}
