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
    <form id='loginForm' action='authentication.php' method='post'>
        <div class='mb-3'>
            <label for='username' class='form-label boldness'>Username:</label><br>
            <input name='username' type='text' class='form-control' id='username' /><br>
        </div>
        <div class='mb-3'>
            <label for='password' class='form-label boldness''>Password:</label><br>
            <input name='password' type='text' class='form-control' id='password' /><br>
        </div>
        <button id='register' type='submit' formmethod='post' class='btn btn-success'>Submit</button>
    </form>
</div>
";

$page->finalizeBottomSection();
print $page->getBottomSection();
