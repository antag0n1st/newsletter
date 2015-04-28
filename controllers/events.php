<?php

class EventsController extends Controller {

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

        $_active_page_ = 'events';
        $_active_page_submenu_ = 'list_events';
        $view = "list_events";

        Load::model('event');

        $events = Event::get_all_events();

        Load::assign('events', $events);
    }

    public function add_event() {

        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'events';
        $_active_page_submenu_ = 'add_event';
        $view = "add_event";

        Head::instance()->load_css('jquery-ui');
        Head::instance()->load_js('jquery-ui.min');


        if (isset($_POST) and $_POST) {

            Load::model('event');

            if ($_POST['start_date'] > $_POST['end_date'] and $_POST['end_date'] != 0) {
                $this->set_error('The starting time is grater then the ending');
            } else {
                $event = new Event();
                $event->festival_id = $this->get_post('festival_id');
                $event->event_started_at = $this->convert_date($_POST['start_date']);
                $event->event_ended_at = $this->convert_date($_POST['end_date']);
                $event->created_at = TimeHelper::DateTimeAdjusted();

                $event->save();

                URL::redirect('events');
            }
        }
    }

    public function add_festival() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'events';
        $_active_page_submenu_ = 'add_festival';
        $view = "add_festival";

        Head::instance()->load_css('jquery-ui');
        Head::instance()->load_js('jquery-ui.min');

        Load::model('country');
        $countries = Country::find_all();
        Load::assign('countries', $countries);

        Load::model('festival');

        if (isset($_POST) and $_POST) {
            $festival = new Festival();
            $festival->festival_name = $this->get_post('festival_name');
            $festival->country_id = $this->get_post('country_id');
            $festival->created_at = TimeHelper::DateTimeAdjusted();
            $festival->save();

            URL::redirect('events/list-festivals');
        }
    }

    public function get_festivals() {
        global $layout;
        $layout = null;
        if (isset($_GET['term']) and $_GET['term']) {
            Load::model('festival');
            $festivals = Festival::find_festivals($_GET['term']);
            echo json_encode($festivals);
        } else {
            echo json_encode([]);
        }
    }

    public function get_events() {
        global $layout;
        $layout = null;
        if (isset($_GET['term']) and $_GET['term']) {
            Load::model('event');
            $events = Event::find_events($_GET['term']);
            echo json_encode($events);
        } else {
            echo json_encode([]);
        }
    }

    public function list_festivals() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'events';
        $_active_page_submenu_ = 'list_festivals';
        $view = "list_festivals";

        Load::model('festival');

        Load::model('country');
        $country_records = Country::find_all();
        $countries = array();
        foreach ($country_records as $key => $country) { /* @var $country Country */
            $countries[$country->id] = $country->country_name;
        }
        Load::assign('countries', $countries);

        $festivals = Festival::get_all_festivals();
        Load::assign('festivals', $festivals);
    }
    
    private function convert_date($input_date) {

        if (isset($input_date) and $input_date) {
            $parts = explode('-', $input_date);
            if (count($parts) == 3) {
                return $parts[2] . '/' . $parts[1] . '/' . $parts[0];
            }
        }

        return null;
    }

}
