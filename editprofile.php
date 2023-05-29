<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $workexp = $_POST['workexp'];
    $edu = $_POST['edu'];
    $other_ints = $_POST['other_ints'];
    $fb = $_POST['fb'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $insta = $_POST['insta'];
    $uid = $_POST['uid'];
    $social_links = implode(',', [$fb, $twitter, $linkedin, $insta]);

    $oauth_provider = "";


   // die($name." ".$username." ".$email." ".$bio." ".$workexp." ".$edu." ".$other_ints." ".$uid." ".$social_links);

    //fetching userdata from db for oauth
    // connecting to the database
    $db = new mysqli('localhost',  'u151549897_research', 'Research@12', 'u151549897_research');

    if ($db->connect_errno) {
        die('Failed to connect to database');
    }

    //to set default DP
    $sql = "SELECT * FROM users WHERE oauth_uid = '{$uid}'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

       // $dp = !empty($_FILES['dp']['tmp_name']) && $_FILES['dp']['error'] === UPLOAD_ERR_OK ? $_FILES['dp'] : $row['picture'];
      // $cover = !empty($_FILES['cover']['tmp_name']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK ? $_FILES['cover'] : $row['cover'];

      $oauth_provider = $row['oauth_provider'];

      $dp = "dp";
      $cover = "cover";
    }

    // Check if all required fields are filled
    if (empty($name)) {
        die('name is required');
    }
    if (empty($username)) {
        die('username field is required');
    }
    if (empty($dp)) {
        die('DP field is required');
    }

    // Check if the video file is valid
    if (!is_uploaded_file($dp['tmp_name']) || $dp['error'] !== UPLOAD_ERR_OK) {
        die('Invalid dp file');
    }

    // Move the uploaded files to the desired location
    $videoPath = 'upload/' . uniqid('', true) . '_' . $dp['name'];
    $thumbnailPath = 'thumbnail/' . uniqid('', true) . '_' . $cover['name'];
    if (!move_uploaded_file($dp['tmp_name'], $videoPath)) {
        die('Unable to move dp file');
    }
    if (!move_uploaded_file($cover['tmp_name'], $thumbnailPath)) {
        die('Unable to move cover file');
        $thumbnailPath = $row['cover'];
    }

    // Update information to into the database
    $sql = "UPDATE users SET first_name = '" . $name . "', 
                            last_name = ' ', 
                            email = '" . $email . "',
                            username = '" . $username . "', 
                            picture = '" . $videoPath . "',
                            cover = '" . $thumbnailPath . "',
                            bio = '" . $bio . "',
                            edu = '" . $edu . "',
                            workexp = '" . $workexp . "',
                            other_ints = '" . $other_ints . "',
                            social_links = '" . $social_links . "'
                            WHERE oauth_provider = '" . $oauth_provider . "' AND oauth_uid = '" . $uid . "'";

    if($db->query($sql) === TRUE) {
        echo 'success';
    } else {
        die('Failed to Update Profile Data');
    }


    exit;
}

die('Invalid request');
?>