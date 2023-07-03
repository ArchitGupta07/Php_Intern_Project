<?php


require 'vendor/autoload.php';


$clientID = '91227980488-uiturn7i31iptc2tjfqrc6gj2nj0uai0.apps.googleusercontent.com';
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



?>