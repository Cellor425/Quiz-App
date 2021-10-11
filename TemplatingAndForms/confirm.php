<?php

require_once("Template.php");

$page = new Template("Form Confirmation");
//$page->addHeadElement("<script src='hello.js'></script>");
$page->finalizeTopSection();

//Some libraries require things to be added before the closing body tag.
//Pretty much the same thing as addHeadElement
//Use addBottomElement() for that.  See the method in the Template class.

$page->finalizeBottomSection();

print $page->getTopSection();

if (!empty($_POST)){
    print "<h1>Form submitted successfully</h1>\n";
} else {
    print "<h1>There was an error submitting the form</h1>\n";
}

print $page->getBottomSection();

?>