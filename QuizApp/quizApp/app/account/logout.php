<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Clear session variables and close the session before redirecting to log in.
session_destroy();

die(header("Location: ../index.php"));
