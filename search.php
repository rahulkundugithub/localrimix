<?php

require_once 'config.php';
$id = $_GET['id'];
// get search query from form input
$searchQuery = $_GET['qy'];

if ($id != "f") {
	require_once 'User.class.php';
}

if ($id == "f")
	require_once('user_auth.php');

if ($id != "f") {
	// session_start();
	$userData = $_SESSION['userData'];
}

include('time_ago.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Research Search Video - ResearchRemix</title>
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
			<div class="gap2 gray-bg">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="row merged20" id="page-contents">

								<?php

								// prepare MySQL query
								$sql = "SELECT * FROM videos WHERE 
								        title LIKE '%$searchQuery%' OR 
								        descrip LIKE '%$searchQuery%' OR  
								        username LIKE '%$searchQuery%' OR 
								        channel_name LIKE '%$searchQuery%' OR 
								        categories LIKE '%$searchQuery%'";

								//echo $sql;
								// execute query
								$result = mysqli_query($conn, $sql);


								$rowcount = mysqli_num_rows($result);
								?>

								<div class="col-lg-12">
									<div class="search-meta">
										<span>Your search result for "<i>
												<?=$searchQuery?>
											</i>" found
											<?= $rowcount ?>
										</span>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="central-meta">
										<div class="create-post">Best Matches for you</div>
										<?php

										// check if any rows were returned
										if (mysqli_num_rows($result) > 0) {
											// output data of each row
											while ($row = mysqli_fetch_assoc($result)) {
												?>
												<div class="rlted-video">
													<figure><img src="<?= $row['thumbnail_path'] ?>"
															style="object-fit:cover; height:90px; width: 130px;"
															alt="<?= $row['title'] ?>">
													</figure>
													<div class="tube-pst-meta">
														<h5 style="overflow: hidden;"><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>"
																title="<?= $row['title'] ?>">
																<?= $row['title'] ?>
															</a></h5>
														<span>
															<?php echo time_elapsed_string($row['date']); ?>
														</span>
														<div class="user-fig">
															<img src="<?= $row['channel_img'] ?>"
																style="object-fit:cover;"
																alt="<?= $row['channel_name'] ?>">
															<a href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"
																title="<?= $row['channel_name'] ?>"><?= $row['channel_name'] ?></a>
														</div>
													</div>
												</div>
											<?php }
										} else {
											echo "No results found.";
										} ?>



									</div>
								</div>
							</div>

							<div class="auto-load">
								<div class="wave">
									<a href="research.php?id=<?=$id?>" style="color: #fa6342;" title="Research Videos"
										class="showmore underline"><b><i class="ti-arrow-left"></i>&nbsp; Back To
											Home</b></a>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		</section>

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

	<div class="side-panel">
		<h4 class="panel-title">General Setting</h4>
		<form method="post">
			<div class="setting-row">
				<span>use night mode</span>
				<input type="checkbox" id="nightmode1" />
				<label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Notifications</span>
				<input type="checkbox" id="switch22" />
				<label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Notification sound</span>
				<input type="checkbox" id="switch33" />
				<label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>My profile</span>
				<input type="checkbox" id="switch44" />
				<label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Show profile</span>
				<input type="checkbox" id="switch55" />
				<label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
			</div>
		</form>
		<h4 class="panel-title">Account Setting</h4>
		<form method="post">
			<div class="setting-row">
				<span>Sub users</span>
				<input type="checkbox" id="switch66" />
				<label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>personal account</span>
				<input type="checkbox" id="switch77" />
				<label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Business account</span>
				<input type="checkbox" id="switch88" />
				<label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Show me online</span>
				<input type="checkbox" id="switch99" />
				<label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Delete history</span>
				<input type="checkbox" id="switch101" />
				<label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Expose author name</span>
				<input type="checkbox" id="switch111" />
				<label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
			</div>
		</form>
	</div><!-- side panel -->

	<div class="popup-wraper">
		<div class="popup direct-mesg">
			<span class="popup-closed"><i class="ti-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<h5>Send Message</h5>
				</div>
				<div class="send-message">
					<form method="post" class="c-form">
						<input type="text" placeholder="Sophia">
						<textarea placeholder="Write Message"></textarea>
						<button type="submit" class="main-btn">Send</button>
					</form>
					<div class="add-smiles">
						<div class="uploadimage">
							<i class="fa fa-image"></i>
							<label class="fileContainer">
								<input type="file">
							</label>
						</div>
						<span title="add icon" class="em em-expressionless"></span>
						<div class="smiles-bunch">
							<i class="em em---1"></i>
							<i class="em em-smiley"></i>
							<i class="em em-anguished"></i>
							<i class="em em-laughing"></i>
							<i class="em em-angry"></i>
							<i class="em em-astonished"></i>
							<i class="em em-blush"></i>
							<i class="em em-disappointed"></i>
							<i class="em em-worried"></i>
							<i class="em em-kissing_heart"></i>
							<i class="em em-rage"></i>
							<i class="em em-stuck_out_tongue"></i>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div><!-- send message popup -->

	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

</body>

</html>