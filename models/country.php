<?php

class Country extends Model{
    
    public static $table_name = 'countries';
    public static $id_name    = 'id';
    public static $db_fields = array(
        'id',
        'country_name'
        );
    
    public $id;
    public $country_name;
}
?>
