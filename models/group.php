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

    public static function get_by_field($field, $value) {

        if (!$value) {
            return [];
        }

        $query = " SELECT g.* , c.category_name , cc.country_name FROM groups as g ";
        $query .= " JOIN categories as c ON g.category_id = c.id";
        $query .= " JOIN countries as cc ON g.country_id = cc.id";
        $query .= " WHERE g." . $field . " LIKE '%" . Model::db()->prep($value) . "%' ";
        $query .= " ORDER BY g.id DESC";

        //return [$query];

        $result = Model::db()->query($query);
        $groups = array();
        while ($row = Model::db()->fetch_assoc($result)) {
            $groups[] = $row;
        }

        return $groups;
    }

    public static function find_groups($term) {

        $query = " SELECT g.* ,c.country_name FROM groups as g ";
        $query .= " JOIN countries as c ON g.country_id = c.id ";
        $query .= " WHERE g.group_name like '%" . Model::db()->prep($term) . "%' ";

        $result = Model::db()->query($query);

        $groups = array();

        while ($row = Model::db()->fetch_assoc($result)) {
            $groups[] = $row;
        }

        return $groups;
    }

}
