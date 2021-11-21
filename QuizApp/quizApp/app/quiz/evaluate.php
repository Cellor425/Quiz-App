<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Debugging only
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
echo '<pre>' . print_r($_POST, TRUE) . '</pre>';

// Check that that the user is logged in before doing anything
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    $_SESSION['error'] = "You are required to log in to access the site.";
    die(header("Location: ../index.php"));
}

// Check that the session variables are set
if (!isset($_SESSION['answer']) || !isset($_POST['answer'])) {
    $_SESSION['error'] = "There was an error retrieving the answer from session.";
    die(header("Location: ../home.php"));
}

// Check if the answer that was posted is the same as the session answer
if (strtolower($_POST['answer']) == strtolower($_SESSION['answer'])) {
    $_SESSION['result'] = "Correct! The answer was " . $_SESSION['answer'];
} else {
    $_SESSION['result'] = "Incorrect answer.";
}

// Redirect back to quiz form
die(header("Location: form.php"));
