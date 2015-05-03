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
        'paid_at',
        'invoice_number'
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
    public $invoice_number;

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
    
    public static function find_by_upcoming_by_subject(){
        
        $query = " SELECT * , SUM(i.price) as sum_invoices , ";
        $query .= " SUM(CASE WHEN i.is_paid = 1 THEN i.price ELSE 0 END) AS sum_paid ";
        $query .= " FROM invoices as i ";
        $query .= " JOIN subjects as s ON i.subject_id = s.id ";
        $query .= " JOIN applications as a ON i.application_id = a.id";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " WHERE e.event_ended_at > NOW() ";
        $query .= " GROUP BY subject_id ";        
        
        $result = Model::db()->query($query);
        $objects = array();
        while ($row = Model::db()->fetch_object($result)) {
            $objects[] = $row;
        }

        return $objects;
        
    }
    
    public static function find_by_subject($subject_id = 0){
        
        $query = " SELECT i.* , ";
        $query .= " s.subject_name as subject_name , s.bank_name as bank_name  ,";
        $query .= " g.group_name , g.contact_name  ";
        $query .= " FROM invoices as i ";
        $query .= " JOIN subjects as s ON i.subject_id = s.id ";
        $query .= " JOIN applications as a ON i.application_id = a.id";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " WHERE i.subject_id = '".Model::db()->prep($subject_id)."' ";
        $query .= " AND e.event_ended_at > NOW() ";     
        
        $result = Model::db()->query($query);
        $objects = array();
        while ($row = Model::db()->fetch_object($result)) {
            $objects[] = $row;
        }

        return $objects;
        
    }
    
    public static function find_all_invoices($paginator = null){
        
        $query = " SELECT i.* , ";
        $query .= " s.subject_name as subject_name , s.bank_name as bank_name  ,";
        $query .= " g.group_name , g.contact_name  ";
        $query .= " FROM invoices as i ";
        $query .= " JOIN subjects as s ON i.subject_id = s.id ";
        $query .= " JOIN applications as a ON i.application_id = a.id";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
                
        if($paginator){
            /* @var $paginator Paginator */
            Model::db()->query($query);
            $paginator->total = Model::db()->affected_rows_count();            
        }
        
        $query .= " ORDER BY i.created_at DESC ";
        
        if($paginator){
            $query = $paginator->prep_query($query);
        }
        
        $result = Model::db()->query($query);
        $objects = array();
        while ($row = Model::db()->fetch_object($result)) {
            $objects[] = $row;
        }

        return $objects;
    }
    
    public static function find_invoice_by_id($id){
        
        $query = " SELECT i.* , ";
        $query .= " s.subject_name as subject_name , s.bank_name as bank_name  ,";
        $query .= " g.group_name , g.contact_name , g.address ,g.city , ";
        $query .= " c.country_name ";
        $query .= " FROM invoices as i ";
        $query .= " JOIN subjects as s ON i.subject_id = s.id ";
        $query .= " JOIN applications as a ON i.application_id = a.id";
        $query .= " JOIN groups as g ON a.group_id = g.id ";
        $query .= " JOIN events as e ON a.event_id = e.id ";
        $query .= " JOIN countries as c ON g.country_id = c.id ";
        $query .= " WHERE i.id = '".Model::db()->prep($id)."' ";
             
        $result = Model::db()->query($query);
        while ($row = Model::db()->fetch_object($result)) {
            return $row;
        }

        return null;
    }

}
