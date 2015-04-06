<?php

class MembershipController extends Controller {

    function __construct() {
        global $view;
        $view = null;
    }

    public function logout() {

        Membership::instance()->clear_user_data();

        if (isset($this->user)) {
            if ($this->user->login_type == User::$FACEBOOK) {
                if (!$this->facebook) {
                    $this->initFacebook();
                }
            }
        } else {
            header('Location:  ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function login($lt = 'facebook') {

        //TODO check for the login type
        if ($lt == 'facebook') {

            Load::plugin_model('membership', 'facebook/base_facebook');
            Load::plugin_model('membership', 'facebook/facebook');


            $membership = new Membership();
            $membership->redirect_url = $_GET['redirect_url'] . '?login=facebook';
            $membership->initFacebook();
            $membership->facebookLoginCheck();

            header("Location: " . $membership->loginUrl);
            exit;
        } else if ($lt == 'standard') {

            if (isset($_POST) and $_POST) {
               /* @var $user User */
                $user = User::find_user($this->get_post('username'), $this->get_post('password'));
                
                if($user){
                    $user->login_type = User::$STANDARD;
                    $user->cookie = String::GUID();
                    $user->save();
                    
                     Membership::instance()->storeUserToSession($user);                     
                     Membership::instance()->store_user_to_cookie($user);  
                }                        
                
                if (isset($_SESSION['previous_page'])) {
                    header("Location: " . $_SESSION['previous_page']);
                    exit;
                }
            }
            header('Location:  ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function login_anonymous() {
        if (isset($_POST) and $_POST) {

            $user = new User();
            $user->user_id = -1;
            $user->login_type = User::$ANONYMOUS;
            $user->user_level = 1;
            $user->email = $_POST['email'];
            $user->username = $_POST['user-name'];
            $user->image_url = URL::abs('plugins/membership/images/' . $_POST['select-image'] . '.jpg');
            Membership::instance()->storeUserToSession($user);
            // current_page
            if (isset($_SESSION['previous_page'])) {
                header("Location: " . $_SESSION['previous_page']);
                exit;
            }
        }
        header('Location:  ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

}

?>
