<?php
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

// check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$category_check = $_POST['main_category'];
	// check if the category is minum 4
	if (count($category_check) < 4) {
		$error = "Please select at least 4 options.";
	} else {
		// Process the form data here
		$category = implode(',', $_POST['main_category']);
		$user_id = $userData['oauth_uid'];
		/////////////////////

		$category_list = $category;

		// Check if the user ID already exists in the category table
		$sql = "SELECT * FROM user_category WHERE user_id = '$user_id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// If the user ID exists, update the category list for that user ID
			$sql = "UPDATE user_category SET category_list = '$category_list' WHERE user_id = '$user_id'";
			if ($conn->query($sql) === TRUE) {
				echo "Category list updated successfully";
				// header("Location: ./research.php?id=$id");
                echo "<script>window.location.href='research.php?id=".$id."';</script>";
                exit;

			} else {
				echo "Error updating category list: " . $conn->error;
			}
		} else {
			// If the user ID does not exist, insert a new record with the user ID and category list
			$sql = "INSERT INTO user_category (user_id, category_list) VALUES ('$user_id', '$category_list')";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				// header("Location: ./research.php?id=$id");
                echo "<script>window.location.href='research.php?id=".$id."';</script>";
                exit;
			} else {
				echo "Error creating new record: " . $conn->error;
			}
		}
		///////////////

		//$sql = "INSERT INTO user_category SET user_id='$user_id', category_list='$category'; ";

		// if ($conn->query($sql) === TRUE) {
		// 	$error = "Registration Successfully";
		// 	header("Location: research.php?id=$id");
		// } else {
		// 	echo "Error updating record:  . $conn->error";
		// }

		exit();

	}


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>ResearchRemix</title>
    <link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/weather-icon.css">
    <link rel="stylesheet" href="css/weather-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
    input::-webkit-input-placeholder {
        color: red;
        opacity: 1;
    }

    input:-moz-placeholder {
        color: red;
    }

    input::-moz-placeholder {
        color: red;
    }

    input:-ms-input-placeholder {
        color: red;
    }

    .search::placeholder {
        color: red;
        opacity: 1;
        /* Firefox */
    }

    .category-tile {
        padding: 50px 0 50px 0;
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 20px;
    }

    .tile {
        height: 200px;
        width: 170px;
        position: relative;

    }

    input[type="checkbox"] {
        -webkit-appearance: none;
        position: relative;
        height: 100%;
        width: 100%;
        background-color: #ffffff;
        border-radius: 10px;
        cursor: pointer;
        border: 3px solid transparent;
        outline: none;
        box-shadow: 15px 15px 25px rgba(2, 28, 53, 0.05);
    }

    input[type="checkbox"]:after {
        position: absolute;
        font-family: "Font Awesome 5 Free";
        font-weight: 400;
        content: "\f111";
        font-size: 22px;
        top: 10px;
        left: 10px;
        color: #e2e6f3;
    }

    input[type="checkbox"]:hover {
        transform: scale(1.08);
    }

    input[type="checkbox"]:checked {
        border: 3px solid #478bfb;
    }

    input[type="checkbox"]:checked:after {
        font-weight: 900;
        content: "\f058";
        color: #478bfb;
    }

    label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
        height: 80%;
        width: 100%;
        position: absolute;
        bottom: 0;
        cursor: pointer;
    }

    label .fas {
        font-size: 60px;
        color: #2c2c51;
    }

    input[type="checkbox"]:checked+label .fas {
        animation: grow 0.5s;
    }

    @keyframes grow {
        50% {
            font-size: 80px;
        }
    }

    label h6 {
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight: 400;
        color: #7b7b93;
    }

    .topar {
        border-radius: 12px;
    }

    .sidebar {
        display: inline-flex;
        color: white;
        justify-items: stretch;
        align-items: stretch;
        width: 80%;
        align-content: space-around;
        justify-content: space-around;
        padding-top: 10px;

    }

    @media screen and (max-width: 480px) {
        .topbar {
            display: block;
            width: 100vw;
            margin-left: -15px;
            border-radius: 0px;
            height: 82px;
        }

        .sidebar {
            width: 100%;
            padding: 0;
        }
    }
    </style>


</head>

<body>
    <div class="wavy-wraper">
        <div class="wavy">
            <span style="--i:1;">R</span>
            <span style="--i:2;">e</span>
            <span style="--i:3;">s</span>
            <span style="--i:4;">e</span>
            <span style="--i:5;">a</span>
            <span style="--i:6;">r</span>
            <span style="--i:7;">c</span>
            <span style="--i:8;">h</span>
            <span style="--i:9;">r</span>
            <span style="--i:10;">e</span>
            <span style="--i:11;">m</span>
            <span style="--i:12;">i</span>
            <span style="--i:13;">x</span>
            <span style="--i:14;">.</span>
            <span style="--i:15;">.</span>
            <span style="--i:16;">.</span>
        </div>
    </div>
    <div class="theme-layout">


        <section>
            <div class="gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="welcome-area">
                            <a class="with-smedia google" href="index.php" title="ResearchRemix"
                                    style=" position:fixed ; top: 0; right:0; margin:20px 20px 0px 0px; font-size: 14px;"><i
                                        style="font-size: 20px; padding-left: 10px;" class="fa fa-home"></i></a>

                                <h2>Choose Your Intrest Category</h2>

                                <h4>
                                    <?= $error ?>
                                </h4>

                                <div class="topbar stick">
                                    <div class="top-search" style="width:100%;">

                                        <div class="sidebar">
                                            <?php for ($i = ord('A'); $i <= ord('Z'); $i++): ?>
                                            <a href="#<?= chr($i) ?>"><?= chr($i) ?></a>
                                            <?php endfor; ?>
                                        </div>




                                        <a onclick="submitForm()" id="save-btn"
                                            style="float: right; padding: 12px 25px;" class="main-btn" title="">Next <i
                                                class="ti-arrow-right"></i></a>
                                    </div>
                                </div>



                                <form id="category-form" action="" method="post">
                                    <section class="category-tile">

                                        <?php
										$query = "SELECT * FROM category;";
										$query_run = mysqli_query($conn, $query);
										if ($query_run->num_rows > 0) {

											// Set an array to keep track of which letters have been found
											$found_letters = array_fill_keys(range('A', 'Z'), false);
											
											// OUTPUT DATA OF EACH ROW
											while ($row = $query_run->fetch_assoc()) {



												// Get the data from the 'my_column' column
												$data = $row['category'];

												// Loop through the letters from 'a' to 'z'
												foreach (range('A', 'Z') as $letter) {
													// Find the position of the letter in the data
													$pos = strpos($data, $letter);

													// If the letter has not been found yet and it is found in the data, set the ID to the letter
													if (!$found_letters[$letter] && $pos !== false) {
														//this code will be printed if the a is found secanrio
														echo '<div class="tile" id="' . $letter . '">';
														$found_letters[$letter] = true;
														$id_word = $row['category'];

														?>

                                        <input type="checkbox" name="main_category[]" value="<?= $row['category'] ?>"
                                            id="sport<?= $row['id'] ?>">
                                        <label for="sport<?= $row['id'] ?>">
                                            <i class="fas fa">
                                                <?php echo substr($row["category"], 0, 1) ?>
                                            </i>
                                            <h6>
                                                <?= $row['category'] ?>
                                            </h6>
                                        </label>
                            </div>
                            <?php
							}
												}

												//if 1st a is already found then this code will be printed
												// Output the data
												// echo $data;

												if($found_letters[$letter] = true && $row['category'] == $id_word ){
													continue;
													}else{
							?>
                            <div class="tile">

                                <input type="checkbox" name="main_category[]" value="<?= $row['category'] ?>"
                                    id="sport<?= $row['id'] ?>">
                                <label for="sport<?= $row['id'] ?>">
                                    <i class="fas fa">
                                        <?php echo substr($row["category"], 0, 1) ?>
                                    </i>
                                    <h6>
                                        <?= $row['category'] ?>
                                    </h6>
                                </label>
                            </div>

                            <?php } }
										}
										?>

        </section>
        </form>


    </div>
    </div>
    </div>
    </div>
    </div>
    </section><!-- welcome section -->


    <div class="copyright-content gap2 no-top"
        style="color: #0a0a0a; text-align: center; justify-content: center; align-item:center;">
        <span class="" style="color: #0a0a0a;">Copyright © 2023 ResearchRemix. All Rights Reserved.</span>
        <sub style="color: #0a0a0a;">Designed by <a href="index.php" style="color: #0a0a0a;"
                title="ResearchRemix">ResearchRemix</a></sub>
    </div>

    </div>

    <script>
    function submitForm() {
        document.getElementById("category-form").submit();
    }
    </script>
    <script src="js/main.min.js"></script>
    <script src="js/jquery.funfact.min.js"></script>
    <script src="js/counterup-t-waypoint.js"></script>
    <script src="js/script.js"></script>

</body>

</html>