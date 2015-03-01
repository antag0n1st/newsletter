<?php

    class NewsletterController extends Controller{
        
        public function main(){
            
            global $view;
            global $_active_page_;
            global $_active_page_submenu_;
            
            $_active_page_ = 'newsletter';
            $_active_page_submenu_ = 'overview';
            $view = "overview";
            
        }
        
        public function templates(){
            global $view;
            global $_active_page_;
            global $_active_page_submenu_;
            
            $_active_page_ = 'newsletter';
            $_active_page_submenu_ = 'templates';
            $view = "templates";
        }
        
        public function template_details(){
            global $view;
            global $_active_page_;
            global $_active_page_submenu_;
            
            $_active_page_ = 'newsletter';
            $_active_page_submenu_ = 'template_details';
            $view = "template_details";
        }
        
        public function add_template(){
            global $view;
            global $_active_page_;
            global $_active_page_submenu_;
            
            $_active_page_ = 'newsletter';
            $_active_page_submenu_ = 'add_template';
            $view = "add_template";
        }        
        
    }
    
    