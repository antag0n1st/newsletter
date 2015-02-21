<?php

class Hotel extends Model{
    
    public static $table_name = 'hotels';
    public static $id_name    = 'id';
    public static $db_fields = array(
        'id',
        'hotel_name',
        'address',
        'website',
        'phone_number',
        'created_at',
        'country_id'
        );
    
    public $id;
    public $hotel_name;
    public $address;
    public $website;
    public $phone_number;
    public $created_at;
    public $country_id;
    
    public static function find_all_visible($paginator = false) {
        $query = "SELECT * FROM " . static::$table_name." WHERE deleted != 1";
        $query .= " ORDER BY created_at DESC ,id DESC ";
        if($paginator){
            /* @var $paginator Paginator */
            $query = $paginator->prep_query($query);
        }
        return static::find_by_sql($query);
    }
    
//    public static function get_slides_by_order($limit=0){
//        
//        $query = " SELECT * FROM slides ".
//                 " ORDER BY position ASC ".
//                 "  ";
//        $query .= $limit ? " LIMIT ".$limit : '';
//        
//        return static::find_by_sql($query);
//    }
//    
//    public static function update_positions($new_positions){
//        foreach($new_positions as $position =>$id){
//            $query = " UPDATE slides SET position = ".Model::db()->prep($position)." WHERE id=".Model::db()->prep($id)." ";
//            Model::db()->query($query);
//        }
//    }
}
?>
