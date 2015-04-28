<?php

class CountriesController extends Controller {

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

        $view = "list";
        $_active_page_ = "countries";
        $_active_page_submenu_ = "list";

        Load::model('country');

        $countries = Country::find_all();

        Load::assign('countries', $countries);
    }

    public function add() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $view = "add";
        $_active_page_ = "countries";
        $_active_page_submenu_ = "add";

        if (isset($_POST) and $_POST) {

            Load::model('country');

            $country = new Country();
            $country->country_name = isset($_POST['name']) ? $_POST['name'] : "unknown";

            $country->save();

            URL::redirect('countries');
        }
    }

    public function delete($id) {

        Load::model('country');

        $country = new Country();
        $country->id = $id;

        $country->delete();

        URL::redirect('countries');
    }

}
