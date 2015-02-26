<?php

class GroupsController extends Controller {

    public function main() {
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
        Load::assign('categories', $categories);

        Load::model('country');
        $countries = Country::find_all();
        Load::assign('countries', $countries);

        if (isset($_POST) and $_POST) {
            Load::model('group');

            $group = new Group();
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

            $group->created_at = TimeHelper::DateTimeAdjusted();

            $group->save();

            URL::redirect('groups');
        }
    }

}