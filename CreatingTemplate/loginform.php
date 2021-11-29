<?php
session_start();
require_once("Form.php");

$form = new Form("Login");

$form->finalizeTopSection();
print $form->getTopSection();

print $form->authForm("login.php");

$form->finalizeBottomSection();
print $form->getBottomSection();
