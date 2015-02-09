<?php

// http://www.uploadify.com/documentation/
class UploadifyController extends Controller {

    public function upload() {
        // http://www.uploadify.com/documentation/
        global $layout;
        $layout = false;

        Load::helper('image');
        

        if (!empty($_FILES)) {
                $tempFile = $_FILES['Filedata']['tmp_name'];
                // Validate the file type
                $fileTypes = array('jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'); // File extensions
                $fileParts = pathinfo($_FILES['Filedata']['name']);
                $_parts = explode('.', $_FILES['Filedata']['name']);
                $file_name = '';
                $hash =  md5(time());

                if (in_array($fileParts['extension'],$fileTypes)) {
                    
                    
                 
                    
                    foreach($_POST as $key => $value){
                      
                        if(is_numeric($key)){
                            
                            $image = new Image();
                            $image->load($tempFile);
                        
                            $posted_values = json_decode($value, TRUE);
                            $the_vals = array();
                            foreach($posted_values as $posted_key => &$posted_value){
                                $the_vals[str_replace(array('"','\''),'',$posted_key)] = str_replace(array('"','\''),'',$posted_value);
                            }
                            extract($the_vals);
                            
                            $aspekt_ratio = $width / $height;
                    
                            if($aspekt_ratio < $image->getWidth() / $image->getHeight() ){
                                $image->resizeToHeight($height);
                                $image->save(rtrim($path,'\\').'/'.$image_title.'-'.$hash.'.'.end($_parts));
                            }else{
                                $image->resizeToWidth($width);
                                $image->save(rtrim($path,'\\').'/'.$image_title.'-'.$hash.'.'.end($_parts));
                            }
                            
                        }
                    }
                    
                        echo $image_title.'-'.$hash.'.'.end($_parts);
                } else {
                        echo 'Invalid file type.';
                }
        }
    }

}

?>
