<?php

    class Uploadify{
        /**
         * 'width:100,height:50,path:public/images/upload'
         * @var type 
         */
        public static $WIDTH = 100;
        public static $HEIGHT = 100;
        public static $PATH = 'public\uploads';
        public static $IMAGE_TITLE = 'image';
        public static $FIELD_NAME = 'image_name';
        public static $DEFAULT_IMAGE = 'default-thumbnail.jpg';
        public static $SEPARATE_IMAGE_CONTAINER_ID = false;
        
        private static $conf = array();
                
        public static function display(){
            if(empty(self::$conf)){
                self::push_values();
            }
            $uploadify_data = self::get_values();
            Load::assign('uploadify_data', $uploadify_data );
            Load::assign('field_name', self::$FIELD_NAME);
            Load::assign('preview_path', self::$PATH);
            Load::assign('default_image', self::$DEFAULT_IMAGE);
            Load::assign('image_container', self::$SEPARATE_IMAGE_CONTAINER_ID);
            
            Load::plugin_view('uploadify', 'uploadify');
        }
        
        public static function push_values(){
            
            self::$conf[] = json_encode(array(
                'height'      => self::$HEIGHT , 
                'width'       => self::$WIDTH , 
                'path'        => self::$PATH , 
                'image_title' => self::$IMAGE_TITLE 
            ));
            
            
        }
        
        public static function clear_values(){
            self::$conf = array();
        }
        
        private static function get_values(){
            return json_encode(self::$conf);
        }
    }
?>
