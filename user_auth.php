<?php
require_once 'config.php';
if(!isset($_SESSION)) 
{
session_start();
}


if (!empty($_SESSION)) {
    // Check whether user data already exists in database
    $query = "SELECT * FROM users WHERE oauth_provider = '" . $_SESSION['oauth_provider'] . "' AND oauth_uid = '" . $_SESSION['oauth_uid'] . "'";
    $result = mysqli_query($conn, $query);
    while ($row = $result->fetch_assoc()) {

        $userData['first_name'] = $row['first_name'];
        $userData['last_name'] = $row['last_name'];
        $userData['email'] = $row['email'];
        $userData['username'] = $row['username'];
        $userData['password'] = $row['password'];
        $userData['bio'] = $row['bio'];
        $userData['cover'] = $row['cover'];
        $userData['social_links'] = $row['social_links'];
        $userData['edu'] = $row['edu'];
        $userData['other_ints'] = $row['other_ints'];
        $userData['workexp'] = $row['workexp'];
        $userData['locale'] = $row['locale'];
        $userData['picture'] = $row['picture'];
        $userData['link'] = $row['link'];
        $userData['oauth_provider'] = $row['oauth_provider'];
        $userData['oauth_uid'] = $row['oauth_uid'];

        $_SESSION['form_status'] = "verified";

        // $_SESSION['oauth_uid'] = $row['oauth_uid'];

        // include('userdata_auth.php');
    }
}

?>
