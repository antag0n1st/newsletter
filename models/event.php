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

}
