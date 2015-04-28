<?php

class NewsletterController extends Controller {

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

        $_active_page_ = 'newsletter';
        $_active_page_submenu_ = 'overview';
        $view = "overview";
    }

    public function templates() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'newsletter';
        $_active_page_submenu_ = 'templates';
        $view = "templates";

        Load::model('newsletter');

        $newsletters = Newsletter::find_all();
        Load::assign('newsletters', $newsletters);
    }

    public function template_details($id) {
        global $layout;
        $layout = null;

        Load::model('newsletter');

        $newsletter = Newsletter::find_by_id($id);

        if ($newsletter) {
            echo $newsletter->content;
        }
    }

    public function add_template() {
        global $view;
        global $_active_page_;
        global $_active_page_submenu_;

        $_active_page_ = 'newsletter';
        $_active_page_submenu_ = 'add_template';
        $view = "add_template";

        Head::instance()->load_js('../../plugins/ckeditor/ckeditor');

        if (isset($_POST) and $_POST) {

            Load::model('newsletter');

            $newsletter = new Newsletter();
            $newsletter->title = $this->get_post('title');
            $newsletter->content = $this->get_post('template');
            $newsletter->created_at = TimeHelper::DateTimeAdjusted();
            $newsletter->save();

            URL::redirect('newsletter/templates');
        }
    }

}
