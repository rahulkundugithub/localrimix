<?php
require_once 'config.php';
require_once 'User.class.php';
require_once('user_auth.php');

// Auth using Lnkedin Start

if ($_SESSION['form_status'] == "verified") {
	header('Location: ./research.php?id=f');
}

$authUrl = $output = '';
if (isset($_SESSION['oauth_status']) && $_SESSION['oauth_status'] == 'verified' && !empty($_SESSION['userData'])) {
	$userData = $_SESSION['userData'];
	if (!empty($userData)) {
		// $output  = '<h2>LinkedIn Profile Details</h2>';
		// $output .= '<div class="ac-data">';
		// $output .= '<img src="'.$userData['picture'].'"/>';
		// $output .= '<p><b>LinkedIn ID:</b> '.$userData['oauth_uid'].'</p>';
		// $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>';
		// $output .= '<p><b>Email:</b> '.$userData['email'].'</p>';
		// $output .= '<p><b>Logout from</b> <a href="logout.php">LinkedIn</a></p>';
		// $output .= '</div>';
		// $output .= '<p>You are already logged in.!</p>';

		header('Location: ./research.php');

	}
} elseif ((isset($_GET["oauth_init"]) && $_GET["oauth_init"] == 1) || (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) || (isset($_GET['code']) && isset($_GET['state']))) {
	$client = new oauth_client_class;

	$client->client_id = LIN_CLIENT_ID;
	$client->client_secret = LIN_CLIENT_SECRET;
	$client->redirect_uri = LIN_REDIRECT_URL;
	$client->scope = LIN_SCOPE;
	$client->debug = 1;
	$client->debug_http = 1;
	$application_line = __LINE__;

	if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0) {
		echo "Problem";
		die();
	}

	// If authentication returns success
	if ($success = $client->Initialize()) {
		if (($success = $client->Process())) {
			if (strlen($client->authorization_error)) {
				$client->error = $client->authorization_error;
				$success = false;
			} elseif (strlen($client->access_token)) {
				$success = $client->CallAPI(
					'https://api.linkedin.com/v2/me?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))',
					'GET',
					array(
						'format' => 'json'
					),
					array('FailOnAccessError' => true),
					$userInfo
				);
				$emailRes = $client->CallAPI(
					'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))',
					'GET',
					array(
						'format' => 'json'
					),
					array('FailOnAccessError' => true),
					$userEmail
				);
			}
		}
		$success = $client->Finalize($success);
	}

	if ($client->exit)
		exit;

	if (strlen($client->authorization_error)) {
		$client->error = $client->authorization_error;
		$success = false;
	}

	if ($success) {
		$user = new User();
		$inUserData = array();
		$inUserData['oauth_uid'] = !empty($userInfo->id) ? $userInfo->id : '';
		$inUserData['first_name'] = !empty($userInfo->firstName->localized->en_US) ? $userInfo->firstName->localized->en_US : '';
		$inUserData['last_name'] = !empty($userInfo->lastName->localized->en_US) ? $userInfo->lastName->localized->en_US : '';
		$inUserData['email'] = !empty($userEmail->elements[0]->{'handle~'}->emailAddress) ? $userEmail->elements[0]->{'handle~'}->emailAddress : '';
		$inUserData['picture'] = !empty($userInfo->profilePicture->{'displayImage~'}->elements[0]->identifiers[0]->identifier) ? $userInfo->profilePicture->{'displayImage~'}->elements[0]->identifiers[0]->identifier : '';
		$inUserData['link'] = 'https://www.linkedin.com/';

		$inUserData['oauth_provider'] = 'linkedin';
		$userData = $user->checkUser($inUserData);


		$_SESSION['userData'] = $userData;
		$_SESSION['oauth_status'] = 'verified';
		$_SESSION['form_status'] = "verified";

		if ($userData['password'] == "") {
			header('location: ./password.php?id=l');
		} else
			header('Location: ./research.php');
	} else {
		$output = 'error' . HtmlSpecialChars($client->error);
	}
} elseif (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
	$output = $_GET["oauth_problem"];
} else {
	$authUrl = '?oauth_init=1';

	$output = '<a href="?oauth_init=1"><img src="images/linkedin-sign-in-btn.png"></a>';
}


// for form input registartion

// initialize variables with empty values
$Fname = $Lname = $username = $email = $password = $repassword = "";
$FnameErr = $LnameErr = $usernameErr = $emailErr = $passwordErr = $repasswordErr = "";
$bio = $_POST["bio"];

// check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// validate name
	if (empty($_POST["first_name"])) {
		$FnameErr = "First Name is required<br>";
	} else {
		$Fname = test_input($_POST["first_name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/", $Fname)) {
			$FnameErr = "Only letters and white space allowed";
		}
	}

	// validate name
	if (empty($_POST["last_name"])) {
		$LnameErr = "Last Name is required<br>";
	} else {
		$Lname = test_input($_POST["last_name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/", $Lname)) {
			$LnameErr = "Only letters and white space allowed<br>";
		}
	}

	// validate name
	if (empty($_POST["username"])) {
		$usernameErr = "UserName is required<br>";
	} else {
		$username = $_POST['username'];
	}

	// validate email
	if (empty($_POST["email"])) {
		$emailErr = "Email is required<br>";
	} else {
		$email = test_input($_POST["email"]);
		// check if email address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email Lastformat<br>";
		}
	}

	// validate password
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required<br>";
	} else {
		$password = test_input($_POST["password"]);
		// check if password is at least 8 characters long and contains at least one uppercase letter, one lowercase letter, one number, and one symbol
		if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])[a-zA-Z\d\W]{8,}$/", $password)) {
			$passwordErr = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one symbol";

		}
	}

	// check if re-entered password matches password
	if (empty($_POST["repassword"])) {
		$repasswordErr = "Please re-enter password<br>";
	} else {
		$repassword = test_input($_POST["repassword"]);
		if ($repassword != $password) {
			$repasswordErr = "Passwords do not match<br>";
		}
	}

	// if all fields are valid, redirect to the next page
	if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($repasswordErr)) {
		//generating oauth_uid

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
		$sql = "INSERT INTO users SET oauth_provider = 'researchremix' , oauth_uid = '" . $oauth_uid . "', first_name = '" . $Fname . "', last_name = '" . $Lname . "', username = '" . $username . "', email = '" . $email . "', password='$password' , locale = '', picture = 'https://cdn-icons-png.flaticon.com/512/3177/3177440.png', link = 'researchremix.com', created = NOW(), modified = NOW()";

		if ($conn->query($sql) === TRUE) {
			$sucess = "Registration Successfully";

			session_start();

			$_SESSION['oauth_uid'] = $oauth_uid;
			$_SESSION['oauth_provider'] = $oauth_provider;

			// echo $_SESSION['oauth_uid']." ".$_SESSION['oauth_provider'];
			?>

			<?php include 'user_auth.php'; ?>

			<?php
			// echo $userData['first_name']." 
			//user_auth 

			header("Location: category.php?id=f");
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
	<title>Register - ResearchRemix</title>
	<link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/weather-icon.css">
	<link rel="stylesheet" href="css/weather-icons.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

	<style>
		.error {
			color: white;
			font-size: 12px;
		}

		.sucess {
			color: green;
		}
	</style>

</head>

<body>
	<div class="www-layout">
		<section>
			<div class="gap no-gap signin whitish medium-opacity register">
				<div class="bg-image" style="background-image:url(content/theme-bg.jpg)"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="big-ad">
								<figure><a href="index.php"><img src="content/logo-org.png" alt="researchremix"
											style="height:100px;"></a></figure>
								<h1>Welcome to the ResearchRemix</h1>
								<p>
									<b>ResearchRemix</b> is a free to use service and can be a great space for research
									enthusiast to discover and learn things as they like. For many young people,
									<b>ResearchRemix</b> is used to watch <span class="text-danger">Science Videos,
										Research Reviews, Technology Advancements, Experimental Tutorials, Laboratory
										Working</span> and more. Teens also use the video-sharing service to follow
									their favouriteResearch field, subscribe to other Researchers and Professors they
									are interested in.
								</p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="we-login-register">
								<div class="form-title">
									<i class="fa fa-key"></i>Sign Up
									<span>Sign Up now and meet the awesome friends around the world.</span>
								</div>
								<form class="we-form" method="post">

									<span class="error">
										<?php echo $FnameErr; ?>
									</span>
									<input type="text" name="first_name" placeholder="First Name">

									<span class="error">
										<?php echo $LnameErr; ?>
									</span>
									<input type="text" name="last_name" placeholder="Last Name">

									<span class="error">
										<?php echo $emailErr; ?>
									</span>
									<input type="email" name="email" placeholder="email">

									<span class="error">
										<?php echo $usernameErr; ?>
									</span>
									<input type="text" name="username" id="username" placeholder="Username">

									<span class="error">
										<?php echo $passwordErr; ?>
									</span>
									<input type="password" name="password" placeholder="Password">

									<span class="error">
										<?php echo $repasswordErr; ?>
									</span>
									<input type="password" name="repassword" placeholder="Re-Enter Password">
									<span class="success">
										<?php echo $sucess; ?>
									</span>

									<!-- <input type="checkbox"><label>Send code to Mobile</label> -->
									<button type="submit" data-ripple="">Register</button>
									<a class="forgot underline" href="login.php" title="">Sign-in</a>
								</form>
								OR
								<hr>
								<?= $output; ?>
								<!-- <a class="with-smedia twitter" href="#" title="" style="width:100%; font-size: 14px;">Continue with LinkedIn <i style="font-size: 20px;" class="fa fa-linkedin"></i></a> -->
								<a class="with-smedia google" href="index.php" title="ResearchRemix"
									style=" position:fixed ; top: 0; left:0; margin:20px 0px 0px 20px; font-size: 14px;"><i
										style="font-size: 20px;" class="fa fa-home"></i></a>

								<span>already have an account? <a class="we-account underline" href="login.php"
										title="">Sign in</a></span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>

	</div>

	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>
</body>

</html>