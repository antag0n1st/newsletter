<?php

class HTML {

    public static function post_value($value) {
        echo isset($_POST[$value]) ? 'value="' . $_POST[$value] . '"' : "";
    }

    public static function post_selected($i, $name, $value) {
        if (!isset($_POST[$name]) && $i == 0) {
            echo 'selected="selected" value="' . $value . '"';
        } else {
            echo (isset($_POST[$name]) && $_POST[$name] == $value) ? 'selected="selected" value="' . $value . '"' : 'value="' . $value . '"';
        }
    }

    public static function checkbox($name, $class = "",$value = "yes", $style = "", $attr = array()) {
        $checkbox = "<input type=\"checkbox\" name=\"" . $name . "\" id=\"" . $name . "\" ";
        $checkbox .= " value=\"" . $value . "\" class=\"" . $class . "\" style=\"" . $style . "\" ";
        $checkbox .= (isset($_POST[$name]) and $_POST[$name] == $value) ? "checked=\"checked\"" : "";
        $checkbox .= " />";
        echo $checkbox;
    }

    public static function textfield() {
        
    }

    public static function textarea() {
        
    }

    public static function select() {
        
    }

}
