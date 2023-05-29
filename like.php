<?php
require('config.php');

// Get the video ID from the URL parameter
    $videoId = $_GET['id'];
// $videoId = $_GET['id'];

// Handle the like request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {

  // Get the type of action from the request body
  $type = $_GET['type'];

  if ($type == "like") {
    // Insert a new like record in the database
    $result = $conn->query("INSERT INTO likes (video_id) VALUES ('$videoId')");
    if ($result) {
      // Return a success response
    //   echo "succeess";
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'success'));
      exit;
    } else {
      // Return an error response
    //   echo"error";
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'error', 'message' => 'Failed to insert like record.'));
      exit;
    }
  } else {
    // Return an error response for unsupported action types
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Unsupported action type.'));
    exit;
  }
}
?>
