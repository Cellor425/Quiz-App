<?php

require_once("Template.php");

$page = new Template("Template Form");
$page->addHeadElement("<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>");
$page->addHeadElement("<link rel='stylesheet' href='primary.css'>");
$page->addHeadElement("<script src='form-validation.js'></script>");
$page->finalizeTopSection();

// Some libraries require things to be added before the closing body tag.
// Pretty much the same thing as addHeadElement
// Use addBottomElement() for that.  See the method in the Template class.

$page->finalizeBottomSection();

print $page->getTopSection();

// Page Content here
print "
<div class='container-sm'>
    <form id='loginForm' class='needs-validation' action='confirm.php' method='post'>
        <div class='mb-3'>
            <label for='username' class='form-label boldness'>Username:</label><br>
            <input type='text' class='form-control' id='username' onchange='validate()' /><br>
        </div>
        <div class='mb-3'>
            <label for='password' class='form-label boldness''>Password:</label><br>
            <input type='text' class='form-control' id='password' onchange='validate()' /><br>
            <div id='helpBlock' class='form-text'>
            <p>Password must contain:<br> 
                2 Uppercase Letters (A-Z)<br>
                2 Lowercase Letters (a-z)<br>
                2 Numbers (0-9)<br>
                2 Special Characters (!, @, #, $, %, ^, &, *, (, ), -, _)<br></p>
            </div>
        </div>
        <div class='mb-3'>
        <label for='email' class='form-label boldness'>Email Address:</label><br>
        <input type='text' class='form-control' id='email' onchange='validate()' /><br><br>
        </div>
        <div class='mb-3'>
            <p id='errors'></p>
        </div>
        <button id='register' type='submit' formmethod='post' class='btn btn-primary' disabled='true'>Submit</button>
    </form>
</div>
";

print $page->getBottomSection();
