<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $user_id = $_POST['user_id'];

    $categories = $_POST['categories'];

    // Check if all required fields are filled
    if (empty($categories)) {
        die('Please Select any Category');
    }

    //die($categories[0]." ".$categories[1]." ".$categories[2]." ".$categories[3]);

	// check if the category is minum 4
	if (count($categories) < 4) {
		die("Please select atleast 4 Categories.");
	}else
        $categories = implode(',', $categories);

    

    // Insert the video information into the database
     $db = new mysqli('localhost', 'phpmyadmin', 'nfe@16', 'research');
    // $db = new mysqli('localhost', 'phpmyadmin', 'nfe', 'research');
    if ($db->connect_errno) {
        die('Failed to connect to database');
    }

    $sql = "UPDATE user_category SET category_list = '$categories' WHERE user_id = '$user_id'";

    if ($db->query($sql) === TRUE) {
        echo 'Category Updated Successfully';
    } else {
        die('Failed to Update Category');
    }
    

    exit;
}

die('Invalid request');
?>