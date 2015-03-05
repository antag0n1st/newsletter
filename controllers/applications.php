<?php

class ApplicationsController extends Controller {

    public function main() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'list';
        $view = "list";
    }
    
    public function add(){
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'add';
        $view = "add";
    }

}
