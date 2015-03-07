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
        
        $query = " SELECT e.* , f.festival_name FROM " . Event::$table_name . " as e";
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

        $query = " SELECT e.* ,c.country_name , f.festival_name FROM events as e ";
        $query .= " JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN countries as c ON f.country_id = c.id ";
        $query .= " WHERE f.festival_name like '%" . Model::db()->prep($term) . "%' ";

        $result = Model::db()->query($query);

        $groups = array();

        while ($row = Model::db()->fetch_assoc($result)) {
           $row['event_started_at'] = date('d M Y', strtotime($row['event_started_at']));
            $groups[] = $row;
        }

        return $groups;
    }

}
