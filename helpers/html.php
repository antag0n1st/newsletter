<?php

class HTML {
    public static function post_value($value){
        echo isset($_POST[$value]) ? 'value="'.$_POST[$value].'"' : "";
    }
}