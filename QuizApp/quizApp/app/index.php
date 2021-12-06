<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once("../../classes/shared/BootstrapTemplate/BootstrapTemplate.php");
$page = new BootstrapTemplate("Sign In");

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
if (isset($_SESSION['error'])) {
    print "<div class =\"errorMessage boldness\">" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
print "
<div class=\"container-sm form-container\">
    <form id=\"loginForm\" action=\"./account/authentication.php\" method=\"post\">
        <div class=\"mb-3\">
            <label for=\"username\" class=\"form-label boldness\">Username:</label><br>
            <input name=\"username\" type=\"text\" class=\"form-control\" id=\"username\" /><br>
        </div>
        <div class=\"mb-3\">
            <label for=\"password\" class=\"form-label boldness\">Password:</label><br>
            <input name=\"password\" type=\"text\" class=\"form-control\" id=\"password\" /><br>
        </div>
        <button id=\"register\" type=\"submit\" formmethod=\"post\" class=\"btn btn-success\">Submit</button>
    </form>
</div>
";

$page->finalizeBottomSection();
print $page->getBottomSection();
