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

// session_start();
//$userData = $_SESSION['userData'];

if(!empty($userData['password'])){
	header("Location: research.php?id=$id");
}

// initialize variables with empty values
$username = $email = $password = $repassword = "";
$usernameErr = $emailErr = $passwordErr = $repasswordErr = "";
$bio = $_POST["bio"];

// check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// validate name
	// if (empty($_POST["name"])) {
	// 	$nameErr = "Name is required";
	// } else {
	// 	$name = test_input($_POST["name"]);
	// 	// check if name only contains letters and whitespace
	// 	if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
	// 		$nameErr = "Only letters and white space allowed";
	// 	}
	// }

	// validate name
	if (empty($_POST["username"])) {
		$usernameErr = "UserName is required";
	} else {
		$username = $_POST['username'];
	}

	// validate email
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if email address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}

	// validate password
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		$password = test_input($_POST["password"]);
		// check if password is at least 8 characters long and contains at least one uppercase letter, one lowercase letter, one number, and one symbol
		if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])[a-zA-Z\d\W]{8,}$/", $password)) {
			$passwordErr = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one symbol";

		}
	}

	// check if re-entered password matches password
	if (empty($_POST["repassword"])) {
		$repasswordErr = "Please re-enter password";
	} else {
		$repassword = test_input($_POST["repassword"]);
		if ($repassword != $password) {
			$repasswordErr = "Passwords do not match";
		}
	}

	// if all fields are valid, redirect to the next page
	if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($repasswordErr)) {
		//query to insert into columns of db user;
		//hash password
		// The plain text password to be hashed
		//$plaintext_password = $password;
  
		// The hash of the password that
		// can be stored in the database
		// $hash = password_hash($plaintext_password, 
		// 		PASSWORD_DEFAULT);


		// update user information
		$sql = "UPDATE users SET password='$password', bio='$bio', username='$username' WHERE email='$email'; ";

		if ($conn->query($sql) === TRUE) {
			$sucess = "Registration Successfully";
			header("Location: category.php?id=".$_GET['id']);
		} else {
			echo "Error updating record:  . $conn->error";
		}
		exit();
	}
}

// helper function to sanitize form data
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
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

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/weather-icon.css">
	<link rel="stylesheet" href="css/weather-icons.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

	<style>
		.error {
			color: red;
		}

		.sucess {
			color: green;
		}
	</style>

</head>

<body>

	<div class="theme-layout">

		<section>
			<div class="gap gray-bg" style="min-height: 91vh;">
				<div class="container-fluid">
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							<div class="row border-center">
								<div class="col-lg-6 col-md-6">
									<div class="already-log">
										<h4>My Profile</h4>
										<p>Here comes the ResearchRemix Profile Details that will be shown to other
											ResearchRemix Users.</p>
										<div class="log-user">
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-4">
													<div class="user-log">
														<a href="" title=""><img src="<?= $userData['picture'] ?>"
																alt="">
															<span>
																<?= $userData['first_name'] . ' ' . $userData['last_name'] ?>
															</span>
														</a>
													</div>
												</div>

												<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?=$id?>"
													method="post" class="again-login">

													<!-- <input type="text" name="name" placeholder="Name"
														value="<?= $userData['first_name'] . ' ' . $userData['last_name'] ?>">
													<span class="error">
														<?php echo $nameErr; ?>
													</span> -->
													<br>
													Username
													<input type="text" name="username" placeholder="User_Name"
														value="<?= $userData['first_name'] . '_' . $userData['last_name'] ?>">
													<span class="error">
														<?php echo $usernameErr; ?>
													</span>

													<br>
													E-mail
													<input type="email" name="email" placeholder="Email"
														value="<?= $userData['email'] ?>">
													<span class="error">
														<?php echo $emailErr; ?>
													</span>
													<br>
													Bio/Channel Description
													<input type="text" name="bio" placeholder="Bio."
														value="Hey I am using ResearchRemix for Research Purposes.">

													<!-- <button id="btn-submit" type="submit"></button> -->
													<!-- </form> -->

											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="logout-f">
										<h4><i class="fa fa-key"></i> Enter Password</h4>
										<p>Enter your Password here</p>
										<div class="logout-form again-login">
											<!-- <form action="research.php" id="form" method="post" class="again-login"> -->
											<input type="password" name="password" placeholder="Password">
											<span class="error">
												<?php echo $passwordErr; ?>
											</span>

											<input type="password" name="repassword" placeholder="Re-Enter Password">
											<span class="error">
												<?php echo $repasswordErr; ?>
											</span>
											<span class="success">
												<?php echo $sucess; ?>
											</span>

											<button
												style="background: #fa6342; border: medium none; border-radius: 30px; color: #fff; float: right;	font-size: 13px; font-weight: 500; padding: 10px 30px; transition: all 0.2s linear 0s;"
												type="submit">Next <i class="ti-arrow-right"></i></button>
											</form>
											<!-- <a href="#" title="">Create New Signup</a> -->
											<p>The Email/Username and Password will be used as Sign-in Token</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- chatgpt -->

		<!-- HTML form -->
		<!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label for="name">Name:</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
			<span class="error">
				<?php echo $nameErr; ?>
			</span>

			<label for="email">Email:</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
			<span class="error">
				<?php echo $emailErr; ?>
			</span>

			<label for="password">Password:</label>
			<input type="password" name="password" value="<?php echo $password; ?>">
			<span class="error">
				<?php echo $passwordErr; ?>
			</span>

			<label for="repassword">Re-enter Password:</label>
			<input type="password" name="repassword" value="<?php echo $repassword; ?>">
			<span class="error">
				<?php echo $repasswordErr; ?>
			</span>

			<input type="submit" name="submit" value="Submit">
		</form> -->

		<!-- chatgptend -->

		<div class="bottombar">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<span class="copyright">© ResearchRemix 2023. All rights reserved.</span>
						<i><img src="content/logo.png" alt="researchremix"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

</body>

</html>