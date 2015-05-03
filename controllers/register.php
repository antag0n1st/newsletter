<?php

class RegisterController extends Controller {

    public function main() {
        global $view;
        $view = "register";

        if (isset($_POST) and $_POST) {

            $user = new User();
            $user->username = $this->get_post('username');
   
            $pass = $this->get_post('pass');
            $rpass = $this->get_post('rpass');
            
            if (strlen($user->username) < 6) {
                $this->set_error('username must be at least 6 characters long');
                $this->clear_pass();
                return;
            }

            if ($pass != $rpass) {
                $this->set_error('passwords dont match');
                $this->clear_pass();
                return;
            }

            if (strlen($pass) < 6) {
                $this->set_error('password must be at least 6 characters long');
                $this->clear_pass();
                return;
            }
            if (strpos(strtolower($pass),  strtolower($this->get_post('username'))) !== false) {           
                $this->set_error('password must not contain the username');
                $this->clear_pass();
                return;
            }

            if (!preg_match('/[A-Z]/', $pass)) {
                $this->set_error('password must have at least one uppercase');
                $this->clear_pass();
                return;
            }

            if (!preg_match('/[^a-zA-Z\d]/', $pass)) {
                $this->set_error('password must have at least one special character');
                $this->clear_pass();
                return;
            }

            $user->password = md5($pass);
            $user->cookie = String::GUID();
            $user->date_created = TimeHelper::DateTimeAdjusted();
            $user->email = $this->get_post('email');
            $user->user_level = 0;
            $user->full_name = $this->get_post('full_name');
            $user->save();
            
            URL::redirect('');
        }
    }

    private function clear_pass() {
        $_POST['pass'] = '';
        $_POST['rpass'] = '';
    }

}
