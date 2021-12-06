<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Debugging only
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

// Check that that the user is logged in before doing anything
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    $_SESSION['error'] = "You are required to log in to access the site.";
    die(header("Location: index.php"));
}

// Use Template for page creation
require_once("../../classes/shared/BootstrapTemplate/BootstrapTemplate.php");
$page = new BootstrapTemplate("Home");

// Internal stylesheets
$stylesheets = array();
$stylesheets[] = "../css/site.css";
$stylesheets[] = "../css/form.css";

foreach ($stylesheets as $stylesheet) {
    $css = "<link rel=\"stylesheet\" href=\"" . $stylesheet . "\">";
    $page->addHeadElement($css);
}

$page->finalizeTopSection();
print $page->getTopSection();

// Page Content here
print "
<div class=\"container\">
    <header class=\"d-flex justify-content-center py-3\">
      <ul class=\"nav nav-pills\">
        <li class=\"nav-item\"><a href=\"./home.php\" class=\"nav-link\">Home</a></li>
        <li class=\"nav-item\"><a href=\"./quiz/form.php\" class=\"nav-link\">Quiz</a></li>
        <li class=\"nav-item\"><a href=\"./account/logout.php\" class=\"nav-link\">Log Out</a></li>
      </ul>
    </header>
</div>
<div class=\"container\">
    <h1 class=\"display-1\">Welcome to QuizApp, " . $_SESSION['name'] . ".</h1>
</div>
";
if (isset($_SESSION['error'])) {
    print "<div class =\"errorMessage boldness\">" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}

$page->finalizeBottomSection();
print $page->getBottomSection();
