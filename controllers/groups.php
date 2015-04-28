<?php

class GroupsController extends Controller {

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

        $_active_page_ = 'groups';
        $_active_page_submenu_ = 'cards';
        $view = "cards";
    }

    public function search() {

        global $layout;
        $layout = null;

        $key = $this->get_post('key');
        $value = $this->get_post('value');

        Load::model('group');

        if ($key == 'group_name') {
            $groups = Group::get_by_field('group_name', $value);
            echo json_encode($groups);
        } else if ($key == 'contact_name') {
            $groups = Group::get_by_field('contact_name', $value);
            echo json_encode($groups);
        } else {
            echo json_encode([]);
        }
    }

    public function lista() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'groups';
        $_active_page_submenu_ = 'list';
        $view = "list";

        Load::model('country');
        $countries = Country::find_all();

        $cs = [];
        foreach ($countries as $key => $country) {
            $cs[$country->id] = $country->country_name;
        }

        Load::assign('countries', $cs);

        Load::model('group');
        $groups = Group::find_all();
        Load::assign('groups', $groups);
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
        $c = array();
        foreach ($categories as $key => $category) { /* @var $category Category */
            $c[$category->id] = $category->category_name;
        }
        Load::assign('categories', $c);

        Load::model('country');
        $countries = Country::find_all();
        $co = array();
        foreach ($countries as $key => $country) { /* @var $country Country */
            $co[$country->id] = $country->country_name;
        }
        Load::assign('countries', $co);

        if (isset($_POST) and $_POST) {
            Load::model('group');

            $group = new Group();
            
            $this->update_group_with_post($group);

            $group->created_at = TimeHelper::DateTimeAdjusted();

            $group->save();

            URL::redirect('groups/lista');
        }
    }

    public function details($group_id = 0) {
                
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'groups';
        $_active_page_submenu_ = 'details';
        $view = "add";

        Load::model('category');
        $categories = Category::find_all();
        $c = array();
        foreach ($categories as $key => $category) { /* @var $category Category */
            $c[$category->id] = $category->category_name;
        }
        Load::assign('categories', $c);

        Load::model('country');
        $countries = Country::find_all();
        $co = array();
        foreach ($countries as $key => $country) { /* @var $country Country */
            $co[$country->id] = $country->country_name;
        }
        Load::assign('countries', $co);

        Load::model('group');
        $group = Group::find_by_id($group_id);
        Load::assign('group', $group);

        if (isset($_POST) and $_POST) {
            $this->set_confirmation('successfuly updated');
            /* @var $group Group */          
            $this->update_group_with_post($group);
            $group->save();
        }
    }
    
    private function update_group_with_post(&$group){
            $group->group_name = $this->get_post('group_name');
            $group->contact_name = $this->get_post('contact_name');
            $group->email = $this->get_post('email');
            $group->phone_number = $this->get_post('phone');
            $group->country_id = $this->get_post('country_id');
            $group->city = $this->get_post('city');
            $group->address = $this->get_post('address');
            $group->website = $this->get_post('website');
            $group->category_id = $this->get_post('category_id');
            $group->comment = $this->get_post('comment');
            $group->other_emails = $this->get_post('other_emails');
            $group->manager = $this->get_post('manager');
            return $group;
    }

    public function get_groups() {
        global $layout;
        $layout = null;
        if (isset($_GET['term']) and $_GET['term']) {
            Load::model('group');
            $groups = Group::find_groups($_GET['term']);
            echo json_encode($groups);
        } else {
            echo json_encode([]);
        }
    }

    public function at_event($event_id) {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'groups';
        $_active_page_submenu_ = 'at-event';
        $view = "at_event";

        Load::model('group');
        $groups = Group::find_groups_by_event($event_id);

        Load::assign('groups', $groups);
    }

}
