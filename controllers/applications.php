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

    public function add() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'add';
        $view = "add";

        Head::instance()->load_css('jquery-ui');
        Head::instance()->load_js('jquery-ui.min');

        if (isset($_POST) and $_POST) {


            // error checkup
            // date_of_arrival date_of_departure

            $date_of_arrival = $this->get_post('date_of_arrival');
            $date_of_departure = $this->get_post('date_of_departure');

            $date_of_arrival = TimeHelper::reorder_date($date_of_arrival);
            $date_of_departure = TimeHelper::reorder_date($date_of_departure);

            if (!$date_of_arrival or ! $date_of_departure) {
                $_POST['error'] = "You must set arrival and departure date";
                return;
            }

            if ($date_of_arrival > $date_of_departure and $date_of_departure) {
                $_POST['error'] = "Can't departure before arrival";
                return;
            }
           
            Load::model('application');
            
            $app = new Application();
            
            $app->participants = $this->get_post('participant');
            $app->date_of_arrival = $this->get_post('date_of_arrival');
            $app->date_of_departure = $this->get_post('date_of_departure');
            $app->needs_airport_pickup = $this->get_post('needs_airport_pickup');
            
        }
    }

}
