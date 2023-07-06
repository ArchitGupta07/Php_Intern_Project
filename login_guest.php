<?php
// use Google_Service_Oauth2;
// require "dbconnect.php";
require 'vendor/autoload.php';
require_once 'config.php';
// init configuration



echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";

?>