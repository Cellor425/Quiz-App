<?php
require_once("Template.php");

class Form extends Template
{
    public function authForm($action){
        $r = "";
        $r .= "<form method=\"post\" action=\"" . $action . "\">\n";
        $r .= "<input type=\"text\" name=\"username\" />\n";
        $r .= "<input type=\"text\" name=\"password\" />\n";
        $r .= "<input type=\"submit\" />\n";
        $r .= "</form>";

        return $r;
    }
}
