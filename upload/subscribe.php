<?php

//user auth AND login

require_once 'config.php';
$id = $_GET['id'];

if ($id != "f") {
	require_once 'User.class.php';
}

if ($id == "f")
	require_once('user_auth.php');

if ($id != "f") {
	// session_start();
	$userData = $_SESSION['userData'];
}

// retrieve the channel_username 
$channel_username = $_GET['channel_username'];
// get the url and user_id
$url = $_GET['link']."&vd=".$_GET['vd'];
$user_id = $userData['username'];


// check if the user has already subscribed to the channel
$sql = "SELECT * FROM subscribe WHERE user_id = '$user_id' AND channel_username = '$channel_username'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
  // user has already subscribed, so unsubscribe them
  $sql = "DELETE FROM subscribe WHERE user_id = '$user_id' AND channel_username = '$channel_username'";
  mysqli_query($conn, $sql);

  // set the HTML button text to 'Subscribe'
  echo "Subscribe(removed form db)";
} else {
  // user has not subscribed yet, so subscribe them
  $sql = "INSERT INTO subscribe (user_id, channel_username) VALUES ('$user_id', '$channel_username')";
  mysqli_query($conn, $sql);

  // set the HTML button text to 'Unsubscribe'
  echo "Unsubscribe(inserted into db)";
}

mysqli_close($conn);

?>