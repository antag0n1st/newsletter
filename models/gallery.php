<?php
    class Gallery extends Model{
    
        public static $table_name = 'galleries';
        public static $id_name    = 'id_gallery';
        public static $db_fields = array('id_gallery','title','description','date_created');
        
        public $id_gallery;
        public $title;
        public $description;
        public $date_created;
        
        public static function get_all($paginator){
            /* @var $paginator Paginator */
            $query = " SELECT * FROM galleries ";
            $query = $paginator->prep_query($query);
         
            return self::find_by_sql($query);
            
        }
        
        
        
        public static function find_latest($paginator){
            /* @var $paginator Paginator */
            
           $query  = " SELECT * FROM galleries ";
           $query .= " ORDER by galleries.id_gallery DESC ";
           $query = $paginator->prep_query($query);
       
           $query  = " SELECT * FROM (".$query.") as galleries ";
           $query .= " JOIN gallery_photos ON galleries.id_gallery = gallery_photos.galleries_id_gallery ";
           $query .= " ORDER by galleries.id_gallery DESC ";
           
           
           
           
           return $galleries = Gallery::join('GalleryPhoto',$query);
            
        }

        
    }
?>
