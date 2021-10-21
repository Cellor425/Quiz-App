<?php

// References:
// https://www.w3schools.com/php/php_form_validation.asp
// https://www.w3schools.com/php/php_form_url_email.asp
//

require_once("Template.php");

$page = new Template("Form Confirmation");
//$page->addHeadElement("<script src='hello.js'></script>");
$page->addHeadElement("<link rel='stylesheet' href='primary.css'>");
$page->finalizeTopSection();

//Some libraries require things to be added before the closing body tag.
//Pretty much the same thing as addHeadElement
//Use addBottomElement() for that.  See the method in the Template class.

$page->finalizeBottomSection();

print $page->getTopSection();

if (!empty($_POST) || isset($_POST)) {
    print "<h1>Form submitted successfully</h1>\n";
} else {
    print "<h1>There was an error submitting the form</h1>\n";
}
// define variables and set to empty values
$nameErr = $emailErr = $passErr = "";

// Get the form input values
$name = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format.<br>";
}

// Validate username
$size = strlen(filter_var($name, FILTER_DEFAULT));
if ($size < 8 || $size > 20) {
    $nameErr = "Username must be between 8-20 characters long.<br>";
}

// Validate password
if (!passwordValidation($password)) {
    $passErr = "The password was not valid, see requiremments on the form<br>";
}
if (strlen($passErr) > 0 && strlen($nameErr) > 0 && strlen($emailErr) > 0) {
    print "<h3>There were some errors in creating the account</h3>";
    print "<p>$nameErr $passErr $emailErr</p>";
}

// Base functionality credited to: https://stackoverflow.com/a/17152963
function passwordValidation($password)
{
    $anUpperCase = "/[A-Z]/";
    $aLowerCase = "/[a-z]/";
    $aNumber = "/[0-9]/";
    $aSpecial = "/[!|@|#|$|%|^|&|*|(|)|-|_]/";

    $result = true;
    $size = strlen($password);

    if ($size < 8 || $size > 20) {
        $result = false;
    }

    $numUpper = 0;
    $numLower = 0;
    $numNums = 0;
    $numSpecials = 0;
    for ($i = 0; $i < $size; $i++) {
        if (preg_match($anUpperCase, $password[$i]) == 1)
            $numUpper++;
        else if (preg_match($aLowerCase, $password[$i]) == 1)
            $numLower++;
        else if (preg_match($aNumber, $password[$i]) == 1)
            $numNums++;
        else if (preg_match($aSpecial, $password[$i]) == 1)
            $numSpecials++;
    }

    if ($numUpper < 2 || $numLower < 2 || $numNums < 2 || $numSpecials < 2) {
        $result = false;
    }
    return $result;
}

print $page->getBottomSection();
