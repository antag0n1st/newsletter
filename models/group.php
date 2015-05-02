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
        'other_phone_numbers',
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
    public $other_phone_numbers;
    public $country_id;
    public $city;
    public $address;
    public $website;
    public $manager;
    public $comment;
    public $created_at;

    public static function get_all_groups($paginator = null) {
        $query = "SELECT * FROM " . Group::$table_name ;
        /* @var $paginator Paginator */
        if($paginator){
            Model::db()->query($query);
            $paginator->total = Model::db()->affected_rows_count();
        }
        
        $query .= " ORDER BY id DESC";
        
        $query = $paginator->prep_query($query);
        
        return Group::find_by_sql($query);
    }

    public static function get_by_field($field, $value) {

        if (!$value) {
            return [];
        }

        $query = " SELECT g.* , c.category_name , cc.country_name , ccc.country_name as country , ";
        $query .= " e.id as event_id , e.event_started_at , e.event_ended_at ,";
        $query .= " a.id as application_id ,a.participants ,";
        $query .= " f.festival_name , f.id as festival_id ,";
        $query .= " h.id as hotel_id , h.hotel_name  ";
        $query .= " FROM groups as g ";
        $query .= " JOIN categories as c ON g.category_id = c.id";
        $query .= " JOIN countries as cc ON g.country_id = cc.id";
        $query .= " LEFT JOIN applications as a ON g.id = a.group_id ";
        $query .= " LEFT JOIN events as e ON a.event_id = e.id ";
        $query .= " LEFT JOIN festivals as f ON e.festival_id = f.id ";
        $query .= " JOIN countries as ccc ON f.country_id = ccc.id";
        $query .= " LEFT JOIN hotels as h ON h.id = a.hotel_id  ";
        $query .= " WHERE LOWER(g." . $field . ") LIKE LOWER('%" . Model::db()->prep($value) . "%') ";
        $query .= " ORDER BY g.id DESC";

        $result = Model::db()->query($query);
        $groups = array();

        $group_id = -1;
        
        $limit = 20;
        $br = 0;

        while ($row = Model::db()->fetch_assoc($result)) {

            if ($group_id != $row['id']) {
                if($br++ >= $limit) {break;}
                $groups[$row['id']] = $row;
                $row['festivals'] = array();
                
            }
            if ($row['event_id']) {
                
                $group_id = $row['id'];

                $group = $groups[$group_id];
                $group['festivals'][] = [
                    'application_id' => $row['application_id'],
                    'event_id' => $row['event_id'],
                    'event_started_at' => TimeHelper::to_date($row['event_started_at'],'d M Y'),
                    'event_ended_at' => $row['event_ended_at'],
                    'festival_name' => $row['festival_name'],
                    'festival_id' => $row['festival_id'],
                    'hotel_id' => $row['hotel_id'],
                    'hotel_name' => $row['hotel_name'],
                    'participants' => $row['participants'],
                    'country' => $row['country']
                ];
                
                $groups[$group_id] = $group;
            }
        }
        
        return array_values($groups);
    }

    public static function find_groups($term) {

        $query = " SELECT g.* ,c.country_name FROM groups as g ";
        $query .= " JOIN countries as c ON g.country_id = c.id ";
        $query .= " WHERE LOWER(g.group_name) like LOWER('%" . Model::db()->prep($term) . "%') ";

        $result = Model::db()->query($query);

        $groups = array();

        while ($row = Model::db()->fetch_assoc($result)) {
            $groups[] = $row;
        }

        return $groups;
    }
    
    public static function find_groups_by_event($event_id) {

        $query = " SELECT g.* ,c.country_name ,";
        $query .= " a.id as application_id , a.participants , a.number_of_rooms , a.invitation_is_sent , a.invoice_paid_sum , ";
        $query .= " u.username ";
        $query .= " FROM groups as g ";
        $query .= " JOIN applications as a ON g.id = a.group_id ";
        $query .= " JOIN countries as c ON g.country_id = c.id ";
        $query .= " JOIN users as u ON u.user_id = a.user_id ";
        $query .= " WHERE a.event_id = '".Model::db()->prep($event_id)."' ";
        $query .= " AND a.is_canceled = 0 ";

        $result = Model::db()->query($query);

        $groups = array();

        while ($row = Model::db()->fetch_assoc($result)) {
            $groups[] = $row;
        }

        return $groups;
    }

}
