<?php

class HotelsController extends Controller {

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

        $_active_page_ = 'hotels';
        $_active_page_submenu_ = 'list';
        $view = "list";

        Load::model('hotel');

        $hotels = Hotel::find_all_visible();
        $countries = Country::find_all();
        /* @var $hotel Hotel */
        /* @var $country Country */

        $cs = [];
        foreach ($countries as $key => $country) {
            $cs[$country->id] = $country->country_name;
        }

        foreach ($hotels as $key => $hotel) {
            $hotel->country = $cs[$hotel->country_id];
        }

        Load::assign('hotels', $hotels);
    }
    
    public function hotel($id = 0){
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'hotels';
        $_active_page_submenu_ = 'hotel';
        $view = "hotel";
        
        Load::model('hotel');
        $hotel = Hotel::find_by_id($id);
        Load::assign('hotel', $hotel);
    }

    public function add() {

        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'hotels';
        $_active_page_submenu_ = 'add';
        $view = "add";

        Load::model('country');

        $countries = Country::find_all();
        Load::assign('countries', $countries);



        if (isset($_POST) and $_POST) {

            Load::model('hotel');

            $hotel = new Hotel();
            $hotel->hotel_name = isset($_POST['name']) ? $_POST['name'] : "unknown";
            $hotel->address = isset($_POST['address']) ? $_POST['address'] : "";
            $hotel->phone_number = isset($_POST['phone']) ? $_POST['phone'] : "";
            $hotel->website = isset($_POST['website']) ? $_POST['website'] : "";
            $hotel->country_id = isset($_POST['country_id']) ? $_POST['country_id'] : "";

            $hotel->created_at = TimeHelper::DateTimeAdjusted();

            $hotel->save();

            URL::redirect('hotels');
        }
    }

    public function get_hotels() {
        global $layout;
        $layout = null;
        if (isset($_GET['term']) and $_GET['term']) {
            Load::model('hotel');
            $hotels = Hotel::find_hotels($_GET['term']);
            echo json_encode($hotels);
        } else {
            echo json_encode([]);
        }
    }

}
