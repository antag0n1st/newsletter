<?php

class Event extends Model {

    public static $table_name = 'events';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'event_name',
        'event_started_at',
        'event_ended_at',
        'created_at'
    );
    public $id;
    public $event_name;
    public $event_started_at;
    public $event_ended_at;
    public $created_at;

    public static function get_all_events() {
        $query = "SELECT * FROM " . Event::$table_name . " ORDER BY id DESC";
        return Event::find_by_sql($query);
    }

}
