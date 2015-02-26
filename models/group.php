<?php

class Group extends Model {

    public static $table_name = 'groups';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'category_id',
        'group_name',
        'contact_name',
        'email',
        'other_emails',
        'phone_number',
        'country_id',
        'city',
        'address',
        'website',
        'manager',
        'comment',
        'created_at'
    );
    
    public $id;
    public $category_id;
    public $group_name;
    public $contact_name;
    public $email;
    public $other_emails;
    public $phone_number;
    public $country_id;
    public $city;
    public $address;
    public $website;
    public $manager;
    public $comment;
    public $created_at;

    public static function get_all_groups() {
        $query = "SELECT * FROM " . Group::$table_name . " ORDER BY id DESC";
        return Group::find_by_sql($query);
    }

}
