<?php

// Insert user data

// Set the length of the random word
$length = 9;

// Set the pool of characters to choose from
$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

// Initialize the random word variable
$random_word = '';

// Generate the random word
for ($i = 0; $i < $length; $i++) {
    $random_word .= $chars[mt_rand(0, strlen($chars) - 1)];
}
$oauth_uid = $random_word;
$oauth_provider = "researchremix";

// Output the random word
// echo $random_word;

//query to insert into columns of db user;
// update user information
// $sql = "UPDATE users SET password='$password', bio='$bio', username='$username' WHERE email='$email'; ";
$sql = "INSERT INTO users 
                    SET oauth_provider = 'google' ,
                         oauth_uid = '" . $oauth_uid . "',
                         first_name = '" . $first_name . "', 
                         last_name = '" . $last_name . "', 
                         username = '" . $username . "', 
                         email = '" . $email . "', 
                         gender = '" . $gender . "',
                         password='' , 
                         locale = '', 
                         picture = '" . $picture . "', 
                         link = 'google.com', 
                         created = NOW(), 
                         modified = NOW()";

if ($conn->query($sql) === TRUE) {
    debug_to_console("Registration Successfully");
}


?>