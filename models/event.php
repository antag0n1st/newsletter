<?php

class Event extends Model {

    public static $table_name = 'events';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'event_started_at',
        'event_ended_at',
        'festival_id',
        'created_at'
    );
    public $id;
    public $event_name;
    public $event_started_at;
    public $event_ended_at;
    public $festival_id;
    public $created_at;

    public static function get_all_events() {
        
        $query = " SELECT e.* , f.festival_name ";
        $query .= " FROM " . Event::$table_name . " as e";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " ORDER BY id DESC";
       
        $result = Model::db()->query($query);
        
        $events = array();
        
        while ($row = Model::db()->fetch_assoc($result)){
            $e = Event::instantiate($row);
            $e->festival_name = $row['festival_name'];
            $events[] = $e;
        }
        
        return $events;
    }
    
    public static function find_events($term) {

        $query = " SELECT e.* ,c.country_name , f.festival_name ";
        $query .= " FROM events as e ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN countries as c ON f.country_id = c.id ";
        $query .= " WHERE LOWER(f.festival_name) like LOWER('%" . Model::db()->prep($term) . "%') ";
        $query .= " ORDER BY id DESC ";

        $result = Model::db()->query($query);

        $groups = array();

        while ($row = Model::db()->fetch_assoc($result)) {
           $row['event_started_at'] = date('d M Y', strtotime($row['event_started_at']));
           $row['event_ended_at'] = date('d M Y', strtotime($row['event_ended_at']));
            $groups[] = $row;
        }

        return $groups;
    }
    
    public static function find_all_active(){
        
        //        - name of the festival
//	- starting date
//	- ending date
//	- number of people coming to the festival
//	- number of groups coming to the festival
//	- sum of paid invoices
//	- total number of rooms
        
        $query = " SELECT f.festival_name ,  ";
        $query .= " e.id , e.event_started_at , e.event_ended_at , ";
        $query .= " SUM(a.participants) as participants , COUNT(a.id) as number_of_groups, ";
        $query .= " SUM(a.number_of_rooms) number_of_rooms ,";
        $query .= " SUM(a.invoice_paid_sum) as invoice_paid_sum ";
        $query .= " FROM events as e ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " LEFT JOIN applications as a ON e.id = a.event_id ";
        
        $query .= " WHERE e.event_started_at >= NOW() ";
        $query .= " AND IFNULL(a.is_canceled,0) = 0";
        $query .= " GROUP BY e.id ";

        $result = Model::db()->query($query);

        $groups = array();

        while ($row = Model::db()->fetch_assoc($result)) {
           //$row['event_started_at'] = date('d M Y', strtotime($row['event_started_at']));
            $groups[] = $row;
        }

        return $groups;        

    }

}
