<?php

class Hotel extends Model {

    public static $table_name = 'hotels';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'hotel_name',
        'address',
        'website',
        'phone_number',
        'created_at',
        'country_id'
    );
    public $id;
    public $hotel_name;
    public $address;
    public $website;
    public $phone_number;
    public $created_at;
    public $country_id;

    public static function find_all_visible($paginator = false) {
        $query = "SELECT * FROM " . static::$table_name . " WHERE deleted != 1";
        $query .= " ORDER BY created_at DESC ,id DESC ";
        if ($paginator) {
            /* @var $paginator Paginator */
            $query = $paginator->prep_query($query);
        }
        return static::find_by_sql($query);
    }

    public static function find_hotels($term) {

        $query = " SELECT h.* ,c.country_name FROM hotels as h ";
        $query .= " JOIN countries as c ON h.country_id = c.id ";
        $query .= " WHERE h.hotel_name like '%" . Model::db()->prep($term) . "%' ";

        $result = Model::db()->query($query);

        $hotels = array();

        while ($row = Model::db()->fetch_assoc($result)) {
            $hotels[] = $row;
        }

        return $hotels;
    }

}

?>
