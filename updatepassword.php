<?php

function encryptIt($q)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return ($qEncoded);
}

function decryptIt($q)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return ($qDecoded);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $renewpass = $_POST['renewpass'];

    $user_id = $_POST['oauth_id'];

    // Check if all required fields are filled
    if (empty($oldpass)) {
        die('Please Enter Existing Password');
    } // Check if all required fields are filled
    if (empty($newpass)) {
        die('Please Enter New Password');
    } // Check if all required fields are filled
    if (empty($renewpass)) {
        die('Please Re-Enter New Password');
    }

    //check if existing pass matches
    // connnecting to the database
    $db = new mysqli('localhost', 'u151549897_research', 'Research@12', 'u151549897_research');

    if ($db->connect_errno) {
        die('Failed to connect to database');
    }

    // $sql = "SELECT * from users WHERE oauth_uid =".$user_id;
    $sql = "SELECT * FROM users WHERE oauth_uid = '{$user_id}'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        //$decrypted = decryptIt($row['password']);


        // Print the result depending if they match
        if ($oldpass != $row['password']) {
            die('Incorrect Existing Password!');
        }

    }


    //check if newpass follows the protocols
    // check if password is at least 8 characters long and contains at least one uppercase letter, one lowercase letter, one number, and one symbol
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])[a-zA-Z\d\W]{8,}$/", $newpass)) {
        die("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one symbol");
    }

    // check if new password matches 
    if ($renewpass != $newpass) {
        die("Passwords do not match!");
    }


    $sql = "UPDATE users SET password = '{$newpass}' WHERE oauth_uid = '{$user_id}'";

    if ($db->query($sql) === TRUE) {
        echo 'Password Updated Successfully!';
    } else {
        die('Failed to Update Password!');
    }


    exit;
}

die('Invalid request');
?>