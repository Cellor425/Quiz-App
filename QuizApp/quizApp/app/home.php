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
require_once("../../classes/Template.php");
$page = new Template("Home");

// Internal stylesheets
$stylesheets = array();
$stylesheets[] = "../css/bootstrap.min.css";
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
<nav class=\"nav\">
    <a class=\"nav-link active\" aria-current=\"page\" href=\"./home.php\">Home</a>
    <a class=\"nav-link\" href=\"./quiz/form.php\">Quiz</a>
    <a class=\"nav-link\" href=\"./account/logout.php\">Log Out</a>
</nav>
<div class=\"container\">
    <h1>Welcome to QuizApp, " . $_SESSION['name'] . ".</h1>
</div>
";
if (isset($_SESSION['error'])) {
    print "<div class =\"errorMessage boldness\">" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}

$page->finalizeBottomSection();
print $page->getBottomSection();
