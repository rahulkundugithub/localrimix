<?php
require('config.php');

// get the page URL and comment ID from the GET parameters
$page_url = $_GET['rl'];
$comment_id = $_GET['comment_id'];
$vd_id = $_GET['vd'];

$url = $page_url."&vd=".$vd_id;
echo $url;

// remove the comment from the database table
//$conn = mysqli_connect("localhost", "username", "password", "database_name");
$query = "DELETE FROM comments WHERE id = '$comment_id'";
mysqli_query($conn, $query);

echo'delete done';

// redirect back to the page where the comment was posted
header("Location: $url");
exit;

?>
