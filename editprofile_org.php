<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   // $cover = $_FILES['cover'];

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

    $links = array($fb, $twitter, $linkedin, $insta);

    $social_links = implode(',', $links);


    //fetching userdata from db for oauth
    // connnecting to the database
    $db = new mysqli('sql301.epizy.com', 'epiz_33739580', '0LqZur6ZCozZ', 'epiz_33739580_research');
        
    if ($db->connect_errno) {
        die('Failed to connect to database');
    }

    // $sql = "SELECT * from users WHERE oauth_uid =".$user_id;
    $sql = "SELECT * FROM users WHERE oauth_uid = '{$uid}'";

    $result = $db->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (empty($_FILES['dp'])) {
                $dp = $row['picture'];
            } else {
                $dp = $_FILES['dp'];
            }
            
            if (empty($_FILES['cover'])) {
                $dp = $row['cover'];
            } else {
                $dp = $_FILES['cover'];
            }
        }


    //die($bio . " " . $social_links . " " . $uid . " " . $cover . " " . $dp . " " . $dp);

    // Check if all required fields are filled
    if (empty($name)) {
        die('name is required');
    } // Check if all required fields are filled
    if (empty($username)) {
        die('username field is required');
    } // Check if all required fields are filled
    if (empty($dp)) {
        die('DP field is required');
    }

    // Check if the video file is valid
    if (!is_uploaded_file($dp['tmp_name']) || $dp['error'] !== UPLOAD_ERR_OK) {
        die('Invalid dp file');
    }

    // Check if the thumbnail file is valid
    if (!is_uploaded_file($cover['tmp_name']) || $cover['error'] !== UPLOAD_ERR_OK) {
        die('Invalid cover file');
    }

    // Move the uploaded files to the desired location
    $videoPath = 'upload/' . uniqid('', true) . '_' . $dp['name'];
    $thumbnailPath = 'thumbnail/' . uniqid('', true) . '_' . $cover['name'];
    if (!move_uploaded_file($dp['tmp_name'], $videoPath)) {
        die('Unable to move dp file');
    }
    if (!move_uploaded_file($cover['tmp_name'], $thumbnailPath)) {
        die('Unable to move cover file');
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
                            social_links = '" . $social_links . "',
                            WHERE oauth_provider = '" . $userData['oauth_provider'] . "' AND oauth_uid = '" . $userData['oauth_uid'] . "'";

    //$update = $this->db->query($query);
    if ($db->query($sql) === TRUE) {
        echo 'success';
    } else {
        die('Failed to Update Profile Data');
    }


    exit;
}

die('Invalid request');
?>