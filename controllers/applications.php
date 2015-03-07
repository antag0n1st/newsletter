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

            if (!$_POST['group_id']) {
                $_POST['error'] = "Must set valid group";
                return;
            }

            if (!$_POST['event_id']) {
                $_POST['error'] = "Must set valid event";
                return;
            }

            if (!$_POST['hotel_id']) {
                $_POST['error'] = "Must set valid hotel";
                return;
            }

            Load::model('application');

            $app = new Application();

            $app->group_id = $this->get_post('group_id');
            $app->event_id = $this->get_post('event_id');
            $app->hotel_id = $this->get_post('hotel_id');

            $app->participants = $this->get_post('participant');
            $app->date_of_arrival = TimeHelper::to_date($this->get_post('date_of_arrival'));
            $app->date_of_departure = TimeHelper::to_date($this->get_post('date_of_departure'));
            $app->needs_airport_pickup = $this->value_for_checkbox('needs_airport_pickup');

            $app->room_1 = $this->get_post('bed_1');
            $app->room_2 = $this->get_post('bed_2');
            $app->room_3 = $this->get_post('bed_3');
            $app->room_4 = $this->get_post('bed_4');
            $app->room_5 = $this->get_post('bed_5');

            $app->number_of_rooms = $this->get_post('number_of_rooms');
            $app->remarks = $this->get_post('remarks');
            $app->application_is_sent = $this->value_for_checkbox('application_is_sent');
            $app->application_has_answer = $this->value_for_checkbox('applications_has_answer');
            $app->invitation_is_sent = $this->value_for_checkbox('invitation_is_sent');
            $app->invitation_price = $this->get_post('invitation_price');
            $app->invoice_price = $this->get_post('invoice_price');
            $app->invoice_is_paid = $this->value_for_checkbox('invoice_is_paid');

            $app->group_manager = $this->get_post('group_manager');
            $app->user_id = Membership::instance()->user->id;
            $app->created_at = TimeHelper::DateTimeAdjusted();

            $app->save();

            URL::redirect('applications');
        }
    }

    private function value_for_checkbox($name) {
        return $this->get_post($name) == "yes" ? 1 : 0;
    }

}
