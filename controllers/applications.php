<?php

class ApplicationsController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!Membership::instance()->user->user_level) {
            URL::redirect('');
        }
    }

    public function main($page_id = 1) {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'list';
        $view = "list";

        Load::model('application');
        
        $paginator = new Paginator(100, $page_id, 20, 'applications/main/');

        $applications = Application::list_of_applications('',$paginator);
        Load::assign('applications', $applications);
        
        Load::assign('paginator', $paginator);
    }

    public function active() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'active';
        $view = "active";

        Load::model('Event');

        $events = Event::find_all_active();
        Load::assign('events', $events);
    }

    public function by_festival($page_id = 1) {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'by-festival';
        $view = "active";

        Load::model('Event');

        $count = Event::count_all_grouped_by_festival_name();

        $paginator = new Paginator($count, $page_id, 20, 'applications/by-festival/');

        $events = Event::find_all_grouped_by_festival_name($paginator);

        Load::assign('paginator', $paginator);
        Load::assign('events', $events);
    }

    public function cancel($id) {

        Load::model('Application');

        $application = Application::find_by_id($id);
        /* @var $application Application */
        $application->is_canceled = 1;
        $application->save();

        URL::redirect_to_refferer();
    }

    public function details($id = 0) {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = 'details';
        $view = "add";

        Load::model('application');
        Load::model('invoice');
        
        Load::model('category');
        $categories = Category::find_all();
        $c = array();
        foreach ($categories as $key => $category) { /* @var $category Category */
            $c[$category->id] = $category->category_name;
        }
        Load::assign('categories', $c);

        $board_basis = Application::get_board_basis();

        Load::assign('board_basis', $board_basis);

        /* @var $application Application */

        if (isset($_POST) and $_POST) {

            $application = Application::find_by_id($id);

            $application->group_id = $this->get_post('group_id');
            $application->event_id = $this->get_post('event_id');
            $application->hotel_id = $this->get_post('hotel_id');
            $application->participants = $this->get_post('participants');

            $application->date_of_arrival = TimeHelper::reorder_date($this->get_post('date_of_arrival'));
            $application->date_of_departure = TimeHelper::reorder_date($this->get_post('date_of_departure'));
            $application->category_id = $this->get_post('category_id');
            $application->needs_airport_pickup = $this->value_for_checkbox('needs_airport_pickup');

            $application->remarks = $this->get_post('remarks');

            $application->room_1 = $this->get_post('bed_1');
            $application->room_2 = $this->get_post('bed_2');
            $application->room_3 = $this->get_post('bed_3');
            $application->room_4 = $this->get_post('bed_4');
            $application->room_5 = $this->get_post('bed_5');

            $application->number_of_rooms = $this->get_post('number_of_rooms');
            $application->board_basis_booked = $this->get_post('board_basis');

            if(!$application->application_is_sent and $this->value_for_checkbox('application_is_sent')){
                $application->application_date_sent = TimeHelper::DateTimeAdjusted();
            }
            
            $application->application_is_sent = $this->value_for_checkbox('application_is_sent');
            $application->application_has_answer = $this->value_for_checkbox('applications_has_answer');
            $application->invitation_is_sent = $this->value_for_checkbox('invitation_is_sent');
            $application->invitation_price = $this->get_post('invitation_price');
            $application->invoice_price = $this->get_post('invoice_price');



            $invoices = $this->get_post('invoices');
            $invoices = json_decode($invoices);

            Invoice::remove_by_application_id($id,$invoices);
            $application->invoice_paid_sum = 0;

            foreach ($invoices as $key => $invoice) {
                /* @var $invoice Invoice */
                /* @var $i Invoice */
              
                $i = Invoice::find_by_key_and_application($invoice->invoice_key, $id);
                
                if(!$i){
                    $i = new Invoice();
                    $i->created_at = TimeHelper::DateTimeAdjusted();
                    $i->application_id = $id;
                    $i->invoice_key = $invoice->invoice_key;
                }
              
                if(!$i->is_paid and $invoice->is_paid){
                    $i->paid_at = TimeHelper::DateTimeAdjusted();
                }
                
                $i->is_paid = $invoice->is_paid;
                $i->price = $invoice->price;
                $i->subject_id = $invoice->subject_id;
                $i->subject_name = $invoice->subject_name;
                $i->save();

                $application->invoice_paid_sum += $i->is_paid ? $i->price : 0;
            }

            $application->save();

            $this->set_confirmation('The Application was updated');
        }

        Head::instance()->load_css('jquery-ui');
        Head::instance()->load_js('jquery-ui.min');

        $application = Application::get_application_by_id($id);
        $inv = Invoice::find_by_application_id($id);
      
        if ($inv) {
            $application->invoices = count($inv) ? json_encode($inv) : '';
        } else {
            $application->invoices = "";
        }

        Load::assign('application', $application);

        Load::assign('id', $id);
    }

    public function list_by_filter($filter,$page_id = 1) {

        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'applications';
        $_active_page_submenu_ = $filter;
        $view = "list";

        Load::model('application');
        
        $paginator = new Paginator(100, $page_id, 20, 'applications/list-by-filter/'.$filter.'/');
        $applications = Application::list_of_applications($filter,$paginator);
        
        Load::assign('applications', $applications);
        Load::assign('paginator', $paginator);
        Load::assign('filter', str_replace("-", " ", $filter));
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

        Load::model('invoice');
        Load::model('application');
        
        Load::model('category');
        $categories = Category::find_all();
        $c = array();
        foreach ($categories as $key => $category) { /* @var $category Category */
            $c[$category->id] = $category->category_name;
        }
        Load::assign('categories', $c);

        $board_basis = Application::get_board_basis();

        Load::assign('board_basis', $board_basis);

        if (isset($_POST) and $_POST) {

            // error checkup
            // date_of_arrival date_of_departure

            $date_of_arrival = $this->get_post('date_of_arrival');
            $date_of_departure = $this->get_post('date_of_departure');

            $date_of_arrival = TimeHelper::reorder_date($date_of_arrival);
            $date_of_departure = TimeHelper::reorder_date($date_of_departure);

            if (!$_POST['group_id']) {
                $this->set_error('Must set valid group');
                return;
            }

            if (!$_POST['event_id']) {
                $this->set_error('Must set valid event');
                return;
            }



            $app = new Application();

            $app->group_id = $this->get_post('group_id');
            $app->event_id = $this->get_post('event_id');
            $app->hotel_id = $this->get_post('hotel_id');

            $app->participants = $this->get_post('participants');
            $app->date_of_arrival = TimeHelper::to_date($this->get_post('date_of_arrival'));
            $app->date_of_departure = TimeHelper::to_date($this->get_post('date_of_departure'));
            $app->needs_airport_pickup = $this->value_for_checkbox('needs_airport_pickup');
            $app->category_id = $this->get_post('category_id');

            $app->room_1 = $this->get_post('bed_1');
            $app->room_2 = $this->get_post('bed_2');
            $app->room_3 = $this->get_post('bed_3');
            $app->room_4 = $this->get_post('bed_4');
            $app->room_5 = $this->get_post('bed_5');

            $app->number_of_rooms = $this->get_post('number_of_rooms');
            $app->board_basis_booked = $this->get_post('board_basis');

            $app->remarks = $this->get_post('remarks');
            $app->application_is_sent = $this->value_for_checkbox('application_is_sent');
            
            if($app->application_is_sent){
                $app->application_date_sent = TimeHelper::DateTimeAdjusted();
            }
            
            $app->application_has_answer = $this->value_for_checkbox('applications_has_answer');
            $app->invitation_is_sent = $this->value_for_checkbox('invitation_is_sent');
            $app->invitation_price = $this->get_post('invitation_price');
            $app->invoice_price = $this->get_post('invoice_price');
            

            $app->group_manager = $this->get_post('group_manager');
            $app->user_id = Membership::instance()->user->user_id;
            $app->created_at = TimeHelper::DateTimeAdjusted();

            $invoices = $this->get_post('invoices');
            $invoices = json_decode($invoices);

            Invoice::remove_by_application_id($app->id);
            $app->invoice_paid_sum = 0;

            foreach ($invoices as $key => $invoice) {
                $i = new Invoice();
                $i->application_id = $app->id;
                $i->created_at = TimeHelper::DateTimeAdjusted();
                $i->is_paid = $invoice->is_paid ? 1 : 0;
                $i->subject_id = (int) $invoice->subject_id;
                $i->price = (int) $invoice->price;
                $i->save();
                $app->invoice_paid_sum += $i->is_paid ? $i->price : 0;
            }

            $app->save();

            URL::redirect('applications');
        }
    }

    private function value_for_checkbox($name) {
        return $this->get_post($name) == "yes" ? 1 : 0;
    }

}
