<?php

class Slide extends Model{
    
    public static $table_name = 'slides';
    public static $id_name    = 'id';
    public static $db_fields = array(
        'id',
        'title',
        'description',
        'image_url',
        'link',
        'position' , 
        'target'
        );
    
    public $id;
    public $title;
    public $description;
    public $image_url;
    public $link;
    public $position;
    public $target;
    
    public static function get_slides_by_order($limit=0){
        
        $query = " SELECT * FROM slides ".
                 " ORDER BY position ASC ".
                 "  ";
        $query .= $limit ? " LIMIT ".$limit : '';
        
        return static::find_by_sql($query);
    }
    
    public static function update_positions($new_positions){
        foreach($new_positions as $position =>$id){
            $query = " UPDATE slides SET position = ".Model::db()->prep($position)." WHERE id=".Model::db()->prep($id)." ";
            Model::db()->query($query);
        }
    }
}
?>
