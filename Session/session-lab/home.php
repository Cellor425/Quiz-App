<?php

// Start session
session_start();

// Check that the values are set
$usernameCheck = !isset($_SESSION['username']) || empty($_SESSION['username']);
$realnameCheck = !isset($_SESSION['realname']) || empty($_SESSION['realname']);
$authCheck = !isset($_SESSION['auth']) || empty($_SESSION['auth']);
if ($usernameCheck || $realnameCheck || $authCheck) {
    die(header("HTTP/1.1 404 Not Found"));
}

// Display a welcome message using the real name and the time of last auth
require_once("../classes/Template.php");

$page = new Template("User Registration");

// Bootstrap, external stylesheet
$page->addHeadElement("<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>");

// Internal stylesheets
$stylesheets = array();
$stylesheets[] = "css/site.css";
$stylesheets[] = "css/form.css";

foreach ($stylesheets as $stylesheet) {
    $css = "<link rel=\"stylesheet\" href=\"" . $stylesheet . "\">\n";
    $page->addHeadElement($css);
}
$page->finalizeTopSection();

// Some libraries require things to be added before the closing body tag.
// Pretty much the same thing as addHeadElement
// Use addBottomElement() for that.  See the method in the Template class.

print $page->getTopSection();

// Page Content here
print "<h1>Welcome, " . $_SESSION['realname'] . "</h1>\n";
print "<p>Last authenticated: " . $_SESSION['auth'] . "</p>\n";

$page->finalizeBottomSection();
print $page->getBottomSection();