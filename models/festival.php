<?php

class Festival extends Model {

    public static $table_name = 'festivals';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'festival_name',
        'country_id',
        'created_at'
    );
    public $id;
    public $festival_name;
    public $country_id;
    public $created_at;

    public static function get_all_festivals() {
        $query = "SELECT * FROM " . Festival::$table_name . " ORDER BY id DESC";
        return Festival::find_by_sql($query);
    }
    
    public static function find_festivals($term){
        
        $query = " SELECT f.* ,c.country_name FROM festivals as f ";
        $query .= " JOIN countries as c ON f.country_id = c.id ";
        $query .= " WHERE f.festival_name like '%".Model::db()->prep($term)."%' ";
        
        $result = Model::db()->query($query);
        
        $festivals = array();
        
        while ($row = Model::db()->fetch_assoc($result)){            
            $festivals[] = $row;
        }
        
        return $festivals;
    }

}
