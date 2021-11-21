<?php

// Check that the input fields are set
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die(header("HTTP/1.1 404 Not Found"));
}

// Start session
session_start();
$_SESSION['isLoggedIn'] = false;

// Authentication varibles
$username = "mike";
$hpass = '$2y$10$eVVsSaKVkXQYuqzpL7EaGOealC0xHxH2wdJXc5NuDJ62YrnQEE4BG';

if($_POST['username'] != $username){
    // Run username verification
    $_SESSION['error'] = "Username authentication not good.";
    die(header("Location: index.php"));
} else if(!password_verify($_POST['password'], $hpass)){
    // Run password verification
    $_SESSION['error'] = "Password authentication not good.";
    die(header("Location: index.php"));
}

// Username and Password have passed verification
// Add them to the session
$_SESSION['username'] = $username;
$_SESSION['auth'] = date('Y-m-d');
$_SESSION['realname'] ="Mike";
$_SESSION['isLoggedIn'] = true;

die(header("Location: home.php"));
