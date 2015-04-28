<?php

class CategoriesController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!Membership::instance()->user->user_level) {
            URL::redirect('');
        }
    }

    public function main() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'categories';
        $_active_page_submenu_ = 'list';
        $view = "list";
        Load::model('category');
        $categories = Category::find_all();

        Load::assign('categories', $categories);
    }

    public function add() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'categories';
        $_active_page_submenu_ = 'add';
        $view = "add";

        if (isset($_POST) and $_POST) {

            Load::model('category');

            $category = new Category();
            $category->category_name = isset($_POST['name']) ? $_POST['name'] : "unknown";
            $category->created_at = TimeHelper::DateTimeAdjusted();

            $category->save();

            URL::redirect('categories');
        }
    }

}
