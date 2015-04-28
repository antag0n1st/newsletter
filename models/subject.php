<?php

class Subject extends Model {

    public static $table_name = 'subjects';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'hotel_id',
        'subject_name',
        'account',
        'bank_name',
        'country_id',
        'created_at'
    );
    
    public $id;
    public $hotel_id;
    public $subject_name;
    public $account;
    public $bank_name;
    public $country_id;
    public $created_at;
    
    ////////////////////
    
    public $hotel_name;
    public $country_name;
    
    public static function find_all_subjects(){
        
        $query = " SELECT s.* , ";
        $query .= " c.country_name , h.hotel_name ";
        $query .= "FROM subjects as s ";
        $query .= " JOIN countries as c ON s.country_id = c.id ";
        $query .= " LEFT JOIN hotels as h ON s.hotel_id = h.id ";
        
        return self::find_by_sql($query);
        
    }
    
    public static function find_subjects($term) {

        $query = " SELECT s.* FROM subjects as s ";
        $query .= " WHERE LOWER(s.subject_name) like LOWER('%" . Model::db()->prep($term) . "%') ";
        $query .= " LIMIT 10 ";

        $result = Model::db()->query($query);

        $subjects = array();

        while ($row = Model::db()->fetch_assoc($result)) {
            $subjects[] = $row;
        }

        return $subjects;
    }

}
