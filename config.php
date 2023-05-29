<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'u151549897_research');//dn name
define('DB_USER_TBL', 'users');

define('LIN_CLIENT_ID', '77d0ehhhbs2327');
define('LIN_CLIENT_SECRET', 'mqSwhDevzeQgt4CE');
define('LIN_REDIRECT_URL', 'https://researchrimix.com/login.php'); 
define('LIN_SCOPE', 'r_liteprofile r_emailaddress');

// create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(!session_id()){
    session_start();
}

require_once 'linkedin-oauth-client-php/http.php';
require_once 'linkedin-oauth-client-php/oauth_client.php';


//google auth
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('805347642558-vugk3af9665aaonsc3o1pvfnll1s7qsl.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://researchrimix.com/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
?>