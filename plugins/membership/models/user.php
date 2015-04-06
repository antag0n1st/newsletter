<?php

class User extends Model {

    public static $table_name = 'users';
    public static $id_name = 'user_id';
    public static $db_fields = array('user_id', 'username', 'password', 'email', 'date_created', 'last_login_date', 'login_count', 'image_url', 'user_level', 'full_name', 'bio', 'cookie');
    public static $FACEBOOK = 'facebook';
    public static $ANONYMOUS = 'anonymous';
    public static $STANDARD = 'standard';
    public $user_id;
    public $username;
    public $password;
    public $email;
    public $date_created;
    public $last_login_date;
    public $login_count;
    public $image_url;
    public $user_level;
    public $full_name;
    public $bio;
    public $cookie;
    public $login_type;

    public static function find_user($username = null, $password = null, $cookie = null) {

        $query = " SELECT * from users ";

        $where = array();
        if ($username) {
            $where[] = " username = '" . Model::db()->prep($username) . "' ";
        }

        if ($password) {
            $where[] = " password = '" . md5(Model::db()->prep($password)) . "' ";
        }

        if (!$username && !$password) {
            $where[] = " cookie = '" . Model::db()->prep($cookie) . "' ";
        }        

        $query .= ' WHERE ' . implode('AND', $where);
        $query .= " LIMIT 1";

        $users = static::find_by_sql($query);
       
        return count($users) ? $users[0] : null;
    }

    public function is_username_cyrilic() {
        return (strtolower($this->username) != mb_strtolower($this->username, 'UTF-8'));
    }

}
