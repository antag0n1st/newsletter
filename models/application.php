<?php

class Application extends Model {
    
    public static $BOOKING_RO = 'ro';
    public static $BOOKING_BB = 'bb';
    public static $BOOKING_HB = 'hb';
    public static $BOOKING_FB = 'fb';
    public static $BOOKING_AI = 'ai';

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
        'invoice_paid_sum',
        'group_manager',
        'created_at',
        'is_canceled',
        'board_basis_booked',
        'category_id',
        'application_date_sent'
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
    public $is_canceled;
    public $invoice_paid_sum;
    public $category_id;
    public $application_date_sent;
    
    public $group_name;
    public $festival_name;
    public $hotel_name;
    public $invoices;
    public $board_basis_booked;
    public $contact_name;
    public $country_name;
    
    
    public static function get_application_by_id($id){
        
        $query = " SELECT a.id as application_id , a.* , c.*,cg.*,h.*,e.*,f.*,u.*, ";
        $query .= " g.group_name , g.contact_name ";
        $query .= " FROM applications as a ";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " LEFT JOIN countries as c ON g.country_id = c.id ";
        $query .= " LEFT JOIN categories as cg ON g.category_id = cg.id ";
        $query .= " LEFT JOIN hotels as h ON a.hotel_id = h.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN users as u ON a.user_id = u.user_id ";
        
        $query .= " WHERE a.id = '".Model::db()->prep($id)."'  AND is_canceled = 0 ";
        $query .= " LIMIT 1 ";
        
        $result = Model::db()->query($query);

        while ($row = Model::db()->fetch_object($result)) {     
           $row->event_started_at = date('d M Y', strtotime($row->event_started_at));
           $row->invoices = '';
           return $row;
        }
        
        return array();
    }
    
    public static $APP_NOT_SENT = 'application-is-not-sent';
    public static $APP_SENT = 'application-is-sent';
    public static $APP_ANSWERED = 'application-is-answered';
    public static $INVITATION_IS_SENT = 'invitation-is-sent';
    public static $INVOICE_IS_PAID = 'invoice-is-paid';
    public static $ACTIVE = 'active';

    public static function list_of_applications($filter = '',$paginator = null){
         /* @var $paginator Paginator */
        
        $query = " SELECT a.* , g.group_name , f.festival_name , e.event_started_at , u.username ";
        $query .= " FROM applications as a ";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN users as u ON a.user_id = u.user_id ";
        
        if($filter == Application::$APP_NOT_SENT) {
            $query .= " WHERE application_is_sent = 0 AND is_canceled = 0";
        } else if($filter == Application::$APP_SENT) {
            $query .= " WHERE application_is_sent = 1 AND application_has_answer = 0  AND is_canceled = 0";
        } else if($filter == Application::$APP_ANSWERED) {
            $query .= " WHERE application_has_answer = 1 AND invitation_is_sent = 0  AND is_canceled = 0";
        } else if($filter == Application::$ACTIVE) {
            $query .= " WHERE event_started_at >= NOW()  AND is_canceled = 0";
        } else {
            $query .= " WHERE is_canceled = 0";
        }
        
        if($paginator){
            Model::db()->query($query);
            $paginator->total = Model::db()->affected_rows_count();
        }
        
        $query .= " ORDER BY a.id DESC ";
        
        
        if($paginator){           
            $query = $paginator->prep_query($query);
        }

        $result = Model::db()->query($query);

        $applications = array();

        while ($row = Model::db()->fetch_assoc($result)) {     
           $row['event_started_at'] = date('d M Y', strtotime($row['event_started_at']));
           $applications[] = $row;
        }

        return $applications;
        
    }
    
    public static function get_board_basis(){
        return array(
            'nn'=>'none',
            'ro'=>'Room only',
            'bb'=>'Bed & Breakfast',
            'hb'=>'Half Board',
            'fb'=>'Full Board',
            'ai'=>'All Inclusive');
    }
}
