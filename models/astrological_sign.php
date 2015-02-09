<?php

class AstrologicalSign extends Model{
    
    public static $table_name = 'astrological_signs';
    public static $id_name    = 'id';
    public static $db_fields = array('id','title','image_url','slug','image_position','description');
    public $id;
    public $title;
    public $image_url;
    public $slug;
    public $image_position;
    public $description;
    
    private static $SIGNS = array();
    
    public static function load(){
        if(empty(self::$SIGNS)){
            $query = " SELECT * FROM ".self::$table_name." ";
            self::$SIGNS = self::find_by_sql($query);
        }
        return self::$SIGNS;
    }
    
    public static function find_by_slug($slug){
        
        self::load();
        foreach (self::$SIGNS as $key => $sign) {
            if($sign->slug==$slug){
                return $sign;
            }
        }
        
        return false;
    }
    
}
?>