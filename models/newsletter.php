<?php

class Newsletter extends Model {

    public static $table_name = 'newsletter_templates';
    public static $id_name = 'id';
    public static $db_fields = array(
        'id',
        'title',
        'content',
        'created_at'
    );
    public $id;
    public $title;
    public $content;
    public $created_at;

}

?>
