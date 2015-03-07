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

    public static function checkbox($name, $class = "", $value = "yes", $style = "", $attr = array(), $return = false) {

        $checkbox = "<input type=\"checkbox\" name=\"" . $name . "\" id=\"" . $name . "\" ";
        $checkbox .= " value=\"" . $value . "\" class=\"" . $class . "\" style=\"" . $style . "\" ";
        $checkbox .= (isset($_POST[$name]) and $_POST[$name] == $value) ? "checked=\"checked\"" : "";
        $checkbox .= " />";
        if ($return) {
            return $checkbox;
        } else {
            echo $checkbox;
        }
    }

    public static function textfield($name = "", $class = "", $style = "", $attr = array(), $return = false) {

        $textfield = "<input type=\"text\"";
        $textfield .= " name=\"" . $name . "\" id=\"" . $name . "\"";
        $textfield .= " class=\"" . $class . "\" style=\"" . $style . "\"";
        $textfield .= isset($_POST[$name]) ? " value=\"" . $_POST[$name] . "\"" : "";
        $textfield .= " />";

        if ($return) {
            return $textfield;
        } else {
            echo $textfield;
        }
    }
    
    public static function input_hidden($name = "", $attr = array(), $return = false) {

        $textfield = "<input type=\"hidden\"";
        $textfield .= " name=\"" . $name . "\" id=\"" . $name . "\"";
        $textfield .= isset($_POST[$name]) ? " value=\"" . $_POST[$name] . "\"" : "";
        $textfield .= " />";

        if ($return) {
            return $textfield;
        } else {
            echo $textfield;
        }
    }

    public static function textarea($name = "", $class = "", $style = "", $attr = array(), $return = false) {
        $textarea = "<textarea";
        $textarea .= " name=\"" . $name . "\" id=\"" . $name . "\"";
        $textarea .= " class=\"" . $class . "\" style=\"" . $style . "\"";
        $textarea .= " >";
        $textarea .= isset($_POST[$name]) ? $_POST[$name] : "";
        $textarea .= " </textarea>";

        if ($return) {
            return $textarea;
        } else {
            echo $textarea;
        }
    }

    public static function select() {
        
    }

}
