<?php

class GalleryPhoto extends Model{
    
    public static $table_name = 'gallery_photos';
    public static $id_name    = 'id_gallery_photos';
    public static $db_fields = array('id_gallery_photos','galleries_id_gallery','image','photo_description','photo_date_created');
    
    public $id_gallery_photos;
    public $galleries_id_gallery;
    public $image;
    public $photo_description;
    public $photo_date_created;
    
    public static function get_by_gallery($id){
        
        $query  = " SELECT * FROM gallery_photos ";
        $query .= " WHERE galleries_id_gallery = '".Model::db()->prep($id)."' ";
        
        return self::find_by_sql($query);
        
    }
    
}
?>
