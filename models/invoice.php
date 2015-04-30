<?php

class Invoice extends Model {

    public static $table_name = 'invoices';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'application_id',
        'created_at',
        'price',
        'subject_id',
        'is_paid',
        'invoice_key',
        'paid_at'
    );
    public $id;
    public $application_id;
    public $created_at;
    public $price;
    public $subject_id;
    public $subject_name;
    public $is_paid;
    public $invoice_key;
    public $paid_at;

    public static function remove_by_application_id($application_id,$invoices=array()) {
        $query = " DELETE FROM invoices ";
        $query .= " WHERE application_id = '" . Model::db()->prep($application_id) . "' ";
        if(count($invoices)){
            $keys = array();
            foreach ($invoices as $key => $invoice) {
                $keys[] = $invoice->invoice_key;
            }
            $query .= " AND invoice_key NOT IN(\"".  implode('","', $keys )."\")";
        }
        return Model::db()->query($query);
    }

    public static function find_by_key_and_application($key, $application_id) {

        $query = " SELECT * ";
        $query .= " FROM invoices as i ";
        $query .= " WHERE application_id = '" . Model::db()->prep($application_id) . "' ";
        $query .= " AND invoice_key = '" . Model::db()->prep($key) . "' ";
        $query .= " LIMIT 1 ";

        $r =  self::find_by_sql($query);
        
        return count($r) ? $r[0] : null;
    }

    public static function find_by_application_id($application_id) {

        $query = " SELECT i.* , IFNULL(s.subject_name,'') as subject_name ";
        $query .= " FROM invoices as i ";
        $query .= " LEFT JOIN subjects as s ON i.subject_id = s.id ";
        $query .= " WHERE application_id = '" . Model::db()->prep($application_id) . "' ";

        // return self::find_by_sql($query);

        $result = Model::db()->query($query);
        $objects = array();
        while ($row = Model::db()->fetch_object($result)) {
            $objects[$row->invoice_key] = $row;
        }

        return $objects;
    }

}
