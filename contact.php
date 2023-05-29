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

//login using form
// When form submitted, check and create user session.
if (isset($_POST['email'])) {

    $email = stripslashes($_REQUEST['email']); // removes backslashes
    $email = mysqli_real_escape_string($conn, $email);

    $subject = stripslashes($_REQUEST['subject']);
    $subject = mysqli_real_escape_string($conn, $subject);
	
	$message = stripslashes($_REQUEST['message']);
    $message = mysqli_real_escape_string($conn, $message);


	$sql = "INSERT INTO admin_contact SET email = '".$email."' , subject = '".$oauth_uid."', message = '".$Fname."'";
	if ($conn->query($sql) === TRUE) {
		$sucess = "Message Sent Successfully";
	} else {
		$sucess = "Message Not Sent UnSuccessfully";
	}
	exit();
    
}

// Login using Form End

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Contact - ResearchRemix</title>
	<link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

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

		<!-- header	 -->

		<?php require('menu.php'); ?>

		<!-- header end -->

		<section>
			<div class="page-header">
				<div class="header-inner">
					<h2>Contact - ResearchRemix</h2>
					<p>
					Welcome to our contact page! If you have any questions, comments or inquiries, please don't hesitate 
					to get in touch with us. Our friendly and knowledgeable team is always ready to assist you and provide
					 any information you may need.
					</p>
				</div>
				<figure><img src="images/resources/baner-forum.png" alt=""></figure>
			</div>
		</section><!-- sub header -->

		<section>
			<div class="gap gray-bg">
				<div class="container">
					<div class="row merged20">
						<div class="col-lg-12">
							
							<div class="forum-form">
								<div class="central-meta">
									<form method="post" action="" class="c-form">
										<div>
											<label>E-mail</label>
											<input type="text" name="email" placeholder="Email" >
										</div>
										<div>
											<label>Subject</label>
											<input type="text" name="subject" placeholder="Subject" >
										</div>
										<div>
											<label>Message</label>
											<textarea rows="3" name="message" placeholder="Write Someting" ></textarea>
										</div>
										
										<div>
											<button class="main-btn" type="submit" >Submit</button>
										</div>
									</form>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="getquot-baner purple high-opacity">
				<div class="bg-image" style="background-image:url(images/resources/animated-bg2.png)"></div>
				<span>Want to watch New Latest Research Videos Start Now!</span>
				<a title="" href="register.php?id=<?=$id?>">Sign up</a>
			</div>
		</section>

		<div class="bottombar">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<span class="copyright">© ResearchRemix 2023. All rights reserved.</span>
					</div>
				</div>
			</div>
		</div><!-- bottom bar -->

	</div>


	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

</body>

</html>