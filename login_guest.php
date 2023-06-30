<?php
// use Google_Service_Oauth2;
require "dbconnect.php";
require 'vendor/autoload.php';
// init configuration
$clientID = '94968952752-4c6f1dvnh9nt6mkrcn2m2859ut7hg518.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Php_learning/profile.php';



// create Client Request to access Google API
$client = new Google_Client();
// $client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  // $googleService = new Google\Service\Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  // now you can use this profile info to create account in your website and make user logged in.
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?>