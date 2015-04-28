<?php
    class IndexController extends Controller {
        public function main(){    
                      
            if(Membership::instance()->user->user_level){
                URL::redirect('applications/active');
            } else {
                global $view;
                $view = null;
            }
            
        }
       
    }
?>