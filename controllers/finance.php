<?php

class FinanceController extends Controller {

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

        $_active_page_ = 'finance';
        $_active_page_submenu_ = 'subjects';
        $view = "subjects";
        
        Load::model('subject');
        
        $subjects = Subject::find_all_subjects();
        Load::assign('subjects', $subjects);
    }

    public function add_subject() {

        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'finance';
        $_active_page_submenu_ = 'subjects';
        $view = "add_subject";

        Head::instance()->load_css('jquery-ui');
        Head::instance()->load_js('jquery-ui.min');

        Load::model('country');
        $country_records = Country::find_all();
        $countries = array();
        foreach ($country_records as $key => $country) { /* @var $country Country */
            $countries[$country->id] = $country->country_name;
        }
        Load::assign('countries', $countries);


        if (isset($_POST) and $_POST) {
            
            Load::model('subject');
            
            $subject = new Subject();
            $subject->account = $this->get_post('account');
            $subject->bank_name = $this->get_post('bank_name');
            $subject->subject_name = $this->get_post('subject_name');
            $subject->hotel_id = $this->get_post('hotel_id');
            $subject->country_id = $this->get_post('country_id');
            $subject->created_at = TimeHelper::DateTimeAdjusted();
            
            $subject->save();
            
            URL::redirect('finance');
        }
    }
    
    public function get_subjects() {
        global $layout;
        $layout = null;
        if (isset($_GET['term']) and $_GET['term']) {
            Load::model('subject');
            $subjects = Subject::find_subjects($_GET['term']);
            echo json_encode($subjects);
        } else {
            echo json_encode([]);
        }
    }

}
