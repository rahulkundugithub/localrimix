<?php
if(!session_id()){
    session_start();
}

include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

unset($_SESSION['oauth_status']);
unset($_SESSION['userData']);
session_destroy();
header("Location:index.php");
exit;
?>