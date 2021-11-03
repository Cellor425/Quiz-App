<?php

// References:
// https://www.w3schools.com/php/php_form_validation.asp
// https://www.w3schools.com/php/php_form_url_email.asp

$errors = array();

// Validate email
if (!isset($_POST['email']) || empty($_POST['email'])) {
    $errors[] = "Email is required";
} else {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = "Email address is invalid";
    }
}

// Validate username
if (!isset($_POST['username']) || empty($_POST['username'])){
    $errors[] = "Username is required";
} else {
    $size = strlen(filter_var($name, FILTER_DEFAULT));
    if ($size < 8 || $size > 20) {
        $nameErr = "Username must be between 8-20 characters long.";
    }
}

// Validate password
if (!isset($_POST['password']) || empty($_POST['password'])){
    $errors[] = "Password is required";
} else {
    if (!passwordValidation($password)) {
        $errors[] = "The password was not valid, see requiremments on the form";
    }
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
require_once("../classes/Template.php");

$page = new Template("User Registration");

// Bootstrap, external stylesheet
$page->addHeadElement("<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>");

// Internal stylesheets
$stylesheets = array();
$stylesheets[] = "css/site.css";

foreach ($stylesheets as $stylesheet) {
    $css = "<link rel=\"stylesheet\" href=\"" . $stylesheet . "\">\n";
    $page->addHeadElement($css);
}
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
print "<div class=\"container\">\n";

print "<h1>Registration Form Results</h1>\n";

// Suggestion for this assignment is to display errors on-page.
// Template must be used for all output, meaning that
// getTopSection() was called and HTML is valid for all cases.

if (count($errors) > 0) {
  print "<div class=\"error\">\n";
  print "Errors were found:\n";
  print "<ul>\n";
  foreach ($errors as $error) {
    print "\t<li>" . $error . "</li>\n";
  }
  print "</ul>\n";
  print "</div>\n";
} else {
  print "Thank you for submitting your registration.";
}

print "</div>\n";
print $page->getBottomSection();

