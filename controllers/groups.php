<?php

class GroupsController extends Controller {

    public function main() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'groups';
        $_active_page_submenu_ = 'list';
        $view = "list";
    }

    public function add() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'groups';
        $_active_page_submenu_ = 'add';
        $view = "add";
        
        Load::model('category');
        $categories = Category::find_all();
        Load::assign('categories', $categories);

        Load::model('country');
        $countries = Country::find_all();
        Load::assign('countries', $countries);
    }

}
