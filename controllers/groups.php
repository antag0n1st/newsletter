<?php

    class GroupsController extends Controller{
        
        public function main(){
            global $view;
            $view = "list";
        }
        
        public function details(){
            global $view;
            $view = "details";
            
        }
        
        
        
    }
    
    