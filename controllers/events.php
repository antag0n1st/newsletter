<?php

class EventsController extends Controller {

    public function main() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'events';
        $_active_page_submenu_ = 'list';
        $view = "list";

        Load::model('event');

        $events = Event::get_all_events();

        Load::assign('events', $events);
    }

    public function add() {

        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'events';
        $_active_page_submenu_ = 'add';
        $view = "add";

        Head::instance()->load_css('jquery-ui');
        Head::instance()->load_js('jquery-ui.min');


        if (isset($_POST) and $_POST) {

            Load::model('event');

            if ($_POST['start_date'] > $_POST['end_date'] and $_POST['end_date'] != 0) {
                $_POST['error'] = "The starting time is grater then the ending";
            } else {
                $event = new Event();
                $event->event_name = isset($_POST['event_name']) ? $_POST['event_name'] : "unknown";
                $event->event_started_at = $this->convert_date($_POST['start_date']);
                $event->event_ended_at = $this->convert_date($_POST['end_date']);

                $event->created_at = TimeHelper::DateTimeAdjusted();

                $event->save();

                URL::redirect('events');
            }
        }
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
