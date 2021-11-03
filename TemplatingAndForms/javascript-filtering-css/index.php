<?php

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
print "
<div class='container-sm form-container'>
    <form id='loginForm' class='needs-validation' action='confirm.php' method='post'>
        <div class='mb-3'>
            <label for='username' class='form-label boldness'>Username:</label><br>
            <input name='username' type='text' class='form-control' id='username' onchange='validate()' /><br>
        </div>
        <div class='mb-3'>
            <label for='password' class='form-label boldness''>Password:</label><br>
            <input name='password' type='text' class='form-control' id='password' onchange='validate()' /><br>
            <div id='helpBlock' class='form-text'>
            <p>Password must contain:<br> 
                2 Uppercase Letters (A-Z)<br>
                2 Lowercase Letters (a-z)<br>
                2 Numbers (0-9)<br>
                2 Special Characters (!, @, #, $, %, ^, &, *, (, ), -, _)<br></p>
            </div>
        </div>
        <div class='mb-3'>
        <label for='email' class='form-label boldness' >Email Address:</label><br>
        <input name='email' type='text' class='form-control' id='email' onchange='validate()' /><br><br>
        </div>
        <div class='mb-3'>
            <p id='errors' class='boldness'></p>
        </div>
        <button id='register' type='submit' formmethod='post' class='btn btn-success'>Submit</button>
    </form>
</div>
";
$page->addHeadElement("<script src='js/form-validation.js'></script>");
$page->finalizeBottomSection();
print $page->getBottomSection();
