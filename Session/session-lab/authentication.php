<?php

// Check that the input fields are set
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die(header("HTTP/1.1 404 Not Found"));
}

// Start session
session_start();

// Authentication varibles
$username = "mike";
$hpass = '$2y$10$eVVsSaKVkXQYuqzpL7EaGOealC0xHxH2wdJXc5NuDJ62YrnQEE4BG';
$errors = false;

// Run username verification
if($_POST['username'] != $username){
    $_SESSION['error'] = "Username authentication not good.";
    die(header("Location: index.php"));
}

// Run password verification
if(!password_verify($_POST['password'], $hpass)){
    $_SESSION['error'] = "Password authentication not good.";
    die(header("Location: index.php"));
}

// Username and Password have passed verification
// Add them to the session
$_SESSION['username'] = $username;
$_SESSION['auth'] = time();
$_SESSION['realname'] ="Mike";

die(header("Location: home.php"));
