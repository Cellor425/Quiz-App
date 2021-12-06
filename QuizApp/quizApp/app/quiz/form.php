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

// Use WebService to retrieve a question if there is none
if (!isset($_SESSION['question']) || !isset($_SESSION['answer'])) {
    require_once("../../../classes/WebServiceClient.php");
    $client = new WebServiceClient("https://cnmt310.braingia.org/qws/q.php");
    $apiKey = "bcljigpion";
    $apiToken = "api35";
    $data = array(
        "apikey" => $apiKey,
        "apitoken" => $apiToken,
    );
    $client->setPostFields($data);
    $response = json_decode($client->send());

    // If the response was a success . . .
    // Assign the question and answer to the session variables
    // Else redirect to home with error
    if ($response->result == "Success") {
        $_SESSION['question'] = $response->question;
        $_SESSION['answer'] = $response->answer;
    } else {
        $_SESSION['error'] = "Failed to retrieve the question. " . $response->message . ".";
        die(header("Location: ../home.php"));
    }
}

// Use Template for page creation
require_once("../../../classes/shared/BootstrapTemplate/BootstrapTemplate.php");
$page = new BootstrapTemplate("Quiz Question", "../../css/shared/bstemplate", "../../js/shared/bstemplate");

// Internal stylesheets
$stylesheets = array();
$stylesheets[] = "../../css/site.css";
$stylesheets[] = "../../css/form.css";

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
        <li class=\"nav-item\"><a href=\"../home.php\" class=\"nav-link\">Home</a></li>
        <li class=\"nav-item\"><a href=\"./quiz/form.php\" class=\"nav-link\">Quiz</a></li>
        <li class=\"nav-item\"><a href=\"../account/logout.php\" class=\"nav-link\">Log Out</a></li>
      </ul>
    </header>
</div>
<div class=\"container-sm form-container\">
";

// Results
if (isset($_SESSION['result'])) {
    print "<div class =\"resultBlock boldness\">" . $_SESSION['result'] . "</div>";
    unset($_SESSION['result']);
}

print "
    <h2>" . $_SESSION['question'] . "</h2>
    <form id=\"quizForm\" action=\"./evaluate.php\" method=\"post\">
        <div class=\"mb-3\">
            <label for=\"answer\" class=\"form-label boldness\">Answer:</label><br>
            <input name=\"answer\" type=\"text\" class=\"form-control\" id=\"answer\" /><br>
        </div>
        <button id=\"register\" type=\"submit\" formmethod=\"post\" class=\"btn btn-success\">Submit</button>
    </form>
</div>
";

$page->finalizeBottomSection();
print $page->getBottomSection();
