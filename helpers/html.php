<?php

class HTML {

    public static function post_value($value) {
        echo isset($_POST[$value]) ? 'value="' . $_POST[$value] . '"' : "";
    }

    public static function post_selected($i, $name, $value) {
        if (!isset($_POST[$name]) && $i == 0) {
            echo 'selected="selected" value="'.$value.'"';
        } else {
            echo (isset($_POST[$name]) && $_POST[$name] == $value) ? 'selected="selected" value="'.$value.'"' : 'value="'.$value.'"';
        }
    }

}
