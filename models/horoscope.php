<?php

class Horoscope extends Model{
    
    public static $table_name = 'horoscope';
    public static $id_name    = 'horoscope_id';
    public static $db_fields = array('horoscope_id','title','description','date_created','sign_id');
    
    public $horoscope_id;
    public $title;
    public $description;
    public $date_created;
    public $sign_id;
    
    public static function get_last($sign_id){
        
        $query  = " SELECT * FROM horoscope ";
        $query .= " WHERE sign_id = '".Model::db()->prep($sign_id)."' ";
        $query .= " ORDER BY date_created DESC ";
        $query .= " LIMIT 1 ";
        
        return self::find_by_sql($query);
    }
    
    public static function find_by_sign_id($sign_id,$paginator = false){
        
        /* @var $paginator Paginator */
        
        $query  = " SELECT * FROM horoscope ";
        $query .= " WHERE sign_id = '".Model::db()->prep($sign_id)."' ";
        $query .= " ORDER BY horoscope_id DESC ";
        
        if($paginator){
            $query = $paginator->prep_query($query);
        }
        
        return self::find_by_sql($query);
    }
    
    public static function count_by_sign_id($sign_id){
        $query  = " SELECT COUNT(*) as count FROM horoscope ";
        $query .= " WHERE sign_id = '".Model::db()->prep($sign_id)."' ";
        
        $result = Model::db()->query($query);
        $row = Model::db()->fetch_assoc($result);
        return $row['count'];
    }
    
}
?>