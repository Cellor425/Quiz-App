<?php

// Check that the input fields are set
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die(header("HTTP/1.1 404 Not Found"));
}

// Start session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION['isLoggedIn'] = false;

// Use the WebService class to verify the users credentials
// WebService variables
require_once("../../../classes/WebServiceClient.php");
$client = new WebServiceClient("https://cnmt310.braingia.org/authws/auth.php");
$username = $_POST['username'];
$password = $_POST['password'];
$apiKey = "bcljigpion";
$apiToken = "api35";

// Create the data array to send to the WebService
$data = array(
    "apikey" => $apiKey,
    "apitoken" => $apiToken,
    "username" => $username,
    "password" => $password
);

// Set the data as the post fields in the service
$client->setPostFields($data);

// POST to the WebService and decode the response to a json object
$response = json_decode($client->send());

// If the verification was a success . . .
// Assign the returned information to the session variables and redirect to home
// Else, redirect back to the login form with session variables for the error
if ($response->result == "Success") {
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['name'] = $response->name;
    $_SESSION['email'] = $response->email;
    $_SESSION['role'] = $response->role;
    $_SESSION['username'] = $response->username;

    die(header("Location: ../home.php"));
} else {
    $_SESSION['error'] = "Error Code: " . $response->code . " " . $response->message;
    die(header("Location: ../index.php"));
}
