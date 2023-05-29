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

include('time_ago.php');

$page = $_GET['page'];

if ($page == "research") {
	$page = "Research Videos";
} else if ($page == "newest") {
	$page = "Newest Uploaded";
} else
	$page = "Random Videos";

$user_id = $userData['oauth_uid'];

//fetch user category from db 
$query = "SELECT * FROM user_category WHERE user_id='$user_id' ;";
$query_run = mysqli_query($conn, $query);
if ($query_run->num_rows > 0) {
	while ($row = $query_run->fetch_assoc()) {

		//exploding user category
		$categories = explode(',', $row['category_list']);

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
	<title>Research Videos - ResearchRemix </title>
	<link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <style>
    .accordion {
        background: #e4e4e4;
        color: #535165;
        cursor: pointer;
        border: none;
        border-radius: 50px;
        text-align: left;
        outline: none;
        font-size: 11px;
        padding: 10px;
        transition: all 0.2s linear 0s;
    }

    .active-accordion,
    .accordion:hover {
        background-color: #fa6342;
        color: white;
        border-radius: 4px;
    }

    .panel {
        margin-top: 4px;
        padding: 10px 18px;
        display: none;
        background: #fff none repeat scroll 0 0;
        border: 1px solid #ede9e9;
        border-radius: 5px;
        overflow: hidden;
        transition: all 0.2s linear 0s;

    }


    .filter-item {
        display: flex;
        align-items: center;
        justify-content: center;
        /* max-width: 640px; */
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        font-size: 13px;
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    ul.ks-cboxtags {
        list-style: none;
        padding: 20px;
    }

    ul.ks-cboxtags li {
        display: inline;
    }

    ul.ks-cboxtags li label {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(139, 139, 139, 0.3);
        color: #adadad;
        font-size: 11px;
        border-radius: 25px;
        white-space: nowrap;
        margin: 3px 0px;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
        transition: all 0.2s;
    }

    ul.ks-cboxtags li label {
        padding: 6px 11px;
        cursor: pointer;
    }

    ul.ks-cboxtags li label::before {
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 12px;
        padding: 2px 6px 2px 2px;
        content: "\f067";
        transition: transform 0.3s ease-in-out;
    }

    ul.ks-cboxtags li input[type="checkbox"]:checked+label::before {
        content: "\f00c";
        transform: rotate(-360deg);
        transition: transform 0.3s ease-in-out;
    }

    ul.ks-cboxtags li input[type="checkbox"]:checked+label {
        border: 2px solid #1bdbf8;
        background-color: #12bbd4;
        color: #fff;
        transition: all 0.2s;
    }

    ul.ks-cboxtags li input[type="checkbox"] {
        display: absolute;
    }

    ul.ks-cboxtags li input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }

    ul.ks-cboxtags li input[type="checkbox"]:focus+label {
        border: 2px solid #e9a1ff;
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
	<div class="theme-layout gray-bg">

		<!-- mobile header -->

		<!-- header	 -->

		<?php require('menu.php'); ?>

		<!-- header end -->

		<!-- mobile header end -->

		<?php if ($page == "Random Videos") { ?>

			<section>
				<div class=" no-bottom">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="row merged20" id="page-contents">
									<!-- page-content id used for static widget parent -->
									<div class="col-lg-12">
										<div class="gap2">
											<div class="central-meta no-margin">
											<ul class="nave-area" style="margin: 0px;">
                                                <li>Filter Research Videos</li>
                                                <!-- <li><a href="#" title=""><i class="fa fa-home"></i> Home</a></li> -->


                                                <li><button href="#random" class="accordion"><i class="fa fa-clone"></i> Filter
                                                        Category</button>
                                                    <div class="panel">
                                                        <form method="post" action="">
                                                            <?php for ($i = ord('A'); $i <= ord('Z'); $i++): ?>
                                                            <a href="#<?= chr($i) ?>"><?= chr($i) ?></a>
                                                            <?php endfor; ?>

                                                            <button title="Filter based on selected categories"
                                                                style="float: right;" name="filter"
                                                                class="main-btn">Filter</button>

                                                            <div class="filter-item">
                                                                <ul class="ks-cboxtags">
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
																					echo '<li id="' . $letter . '">';
																					$found_letters[$letter] = true;
																					$id_word = $row['category'];

																					?>
                                                                    <input type="checkbox"
                                                                        id="filter-category<?= $row['id'] ?>"
                                                                        name="filter-category[]"
                                                                        value="<?= $row['category'] ?>"><label
                                                                        for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
                                                </li>

                                                <?php }
																			}

																			//if 1st a is already found then this code will be printed
																			// Output the data
																			// echo $data;
																	
																			if ($found_letters[$letter] = true && $row['category'] == $id_word) {
																				continue;
																			} else {
																				?><li><input type="checkbox" id="filter-category<?= $row['id'] ?>" name="filter-category[]"
                                                        value="<?= $row['category'] ?>"><label
                                                        for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
                                                </li>


                                                <?php }
																		}
																	}
																	?>
                                            </ul>
                                            </form>
                                        </div>



                                    </div>

                                    </li>
                                    </ul>
                                    <ul class="align-right user-ben">


                                        <li><a title="" class=" send-mesg main-btn" data-ripple="">Upload
                                                Video</a></li>
                                    </ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section><!-- feature content and nav -->

		<?php } ?>

		<section>
			<div class="gap2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="central-meta">
								<span class="create-post">
									<?= $page ?>
								</span>
								<div class="row merged20 remove-ext">
									<?php

									// if the page is Rsearch Videos
									if ($page == "Research Videos") {
										// fetching research videos on the user category
										$sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[0]%' OR categories LIKE '%$categories[1]%' OR categories LIKE '%$categories[2]%' OR categories LIKE '%$categories[3]%' ORDER BY date DESC";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												?>
												<div class="col-lg-3 col-md-6 col-sm-6">
													<div class="tube-post">
													<a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title=""><figure>
															<img src="<?= $row['thumbnail_path'] ?>"
																style=" object-fit: cover; width:252px; height:154px; "
																alt="<?= $row['title'] ?>">
															<!-- <div class="save-post" title="Watch Later"><i class="fa fa-clock-o"></i> -->


															
														</figure>
														<div class="tube-title">
															<h6>
																	<?= $row['title'] ?>
																</a></h6>
															<div class="user-fig">
																<img alt="<?= $row['channel_name'] ?>"
																	src="<?= $row['channel_img'] ?>">
																<a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['username'] ?>"><?= $row['channel_name'] ?></a>
															</div>
															<span class="upload-time">
																<?php echo time_elapsed_string($row['date']); ?>
															</span>
														</div>
													</div>
												</div>

												<?php


											}

										}

									}

									// if the page is Newest Uploaded
									if ($page == "Newest Uploaded") {

										// fetching Lates uploades videos
										$sql = "SELECT * FROM videos ORDER BY date DESC";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {

												?>
												<div class="col-lg-3 col-md-6 col-sm-6">
													<div class="tube-post">
													<a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title=""><figure>
															<img src="<?= $row['thumbnail_path'] ?>"
																style=" object-fit: cover; width:252px; height:154px; "
																alt="<?= $row['title'] ?>">											
														</figure>
														<div class="tube-title">
															<h6>
																	<?= $row['title'] ?>
																</a></h6>
															<div class="user-fig">
																<img alt="<?= $row['channel_name'] ?>"
																	src="<?= $row['channel_img'] ?>">
																<a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['username'] ?>"><?= $row['channel_name'] ?></a>
															</div>
															<span class="upload-time">
																<?php echo time_elapsed_string($row['date']); ?>
															</span>
														</div>
													</div>
												</div>
												<?php
											}
										}
									}

									if($page == "Random Videos"){
										if (isset($_POST['filter'])) {
											$categories = $_POST['filter-category'];
											foreach ($categories as $category) {
												$where .= " OR categories LIKE '%$category%'";
											}
											$where = "WHERE " . substr($where, 4);
		
											// echo "SELECT * FROM videos ".$where;
										
											$isFiltered = true;
		
											// Build the SQL query
											$sql = "SELECT * FROM videos $where";
		
											// Execute the query and get the results
											$result = mysqli_query($conn, $sql);
		
											// Display the results
											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
													?>
										<div class="col-lg-3 col-md-6 col-sm-6">
											<div class="tube-post">
												<figure>
													<img src="<?= $row['thumbnail_path'] ?>"
														style=" object-fit: cover; height:154px; " alt="<?= $row['title'] ?>">
													
													
												</figure>
												<div class="tube-title">
													<h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>"
															title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
													<div class="user-fig">
														<img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
														<a title="<?= $row['channel_name'] ?>"
															href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['username'] ?>"><?= $row['channel_name'] ?></a>
													</div>
													<span class="upload-time">
														<?php echo time_elapsed_string($row['date']); ?>
													</span>
												</div>
											</div>
										</div>
										<?php }
											} else { ?>
		
										<div class="col-lg-3 col-md-6 col-sm-6">
											<div class="tube-post">
												<figure>
													<img src="<?= $row['thumbnail_path'] ?>"
														style=" object-fit: cover; height:154px; " alt="<?= $row['title'] ?>">
													
	
												</figure>
												<div class="tube-title">
													<h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>"
															title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
													<div class="user-fig">
														<img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
														<a title="<?= $row['channel_name'] ?>"
															href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['username'] ?>"><?= $row['channel_name'] ?></a>
													</div>
													<span class="upload-time">
														<?php echo time_elapsed_string($row['date']); ?>
													</span>
												</div>
											</div>
										</div>
		
										<?php }
										}
		
		
										if ($isFiltered == false) {
											// fetching Lates uploades videos
											$sql = "SELECT * FROM videos ORDER BY date DESC";
											$result = $conn->query($sql);
		
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													?>
		
										<div class="col-lg-3 col-md-6 col-sm-6">
											<div class="tube-post">
												<figure>
													<img src="<?= $row['thumbnail_path'] ?>"
														style=" object-fit: cover; height:154px; " alt="<?= $row['title'] ?>">
												
												</figure>
												<div class="tube-title">
													<h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>"
															title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
													<div class="user-fig">
														<img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
														<a title="<?= $row['channel_name'] ?>"
															href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['username'] ?>"><?= $row['channel_name'] ?></a>
													</div>
													<span class="upload-time">
														<?php echo time_elapsed_string($row['date']); ?>
													</span>
												</div>
											</div>
										</div>
		
										<?php
												}
											}
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="auto-load">
					<div class="wave">
						<a href="research.php?id=<?= $id ?>" style="color: #fa6342;" title="Research Videos"
							class="showmore underline"><b><i class="ti-arrow-left"></i>&nbsp; Back To
								Home</b></a>
					</div>
				</div>

			</div>
		</section>




		<div class="bottombar">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<span class="copyright">© ResearchRemix 2023. All rights reserved.</span>
						<i><img style="height:20px;" src="content/logo.png" alt="researchremix"></i>
					</div>
				</div>
			</div>
		</div><!-- bottom bar -->
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
		<div class="popup events">
			<span class="popup-closed"><i class="ti-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<h5></h5>
				</div>
				<div class="event-detail">
					<figure><img src="images/resources/event-detail1.jpg" alt=""></figure>
					<div class="event-detailmeta">
						<h4>Ocean Motel good night event in columbia for the youngests only.</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
							laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
							voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
							cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
						<div class="location-map">
							<span>Venu Location</span>
							<p>Confrence Hall street 34 lasal Ontario, Canada.</p>
							<div id="map-canvas"></div>
						</div>
						<a href="#" class="main-btn event" title="">Add Calendar</a>
						<a href="#" class="main-btn event" title="">Invite Friends</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="popup-wraper2">
		<div class="popup post-sharing">
			<span class="popup-closed"><i class="ti-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<select data-placeholder="Share to friends..." multiple class="chosen-select multi">
						<option>Share in your feed</option>
						<option>Share in friend feed</option>
						<option>Share in a page</option>
						<option>Share in a group</option>
						<option>Share in message</option>
					</select>
					<div class="post-status">
						<span><i class="fa fa-globe"></i></span>
						<ul>
							<li><a href="#" title=""><i class="fa fa-globe"></i> Post Globaly</a></li>
							<li><a href="#" title=""><i class="fa fa-user"></i> Post Private</a></li>
							<li><a href="#" title=""><i class="fa fa-user-plus"></i> Post Friends</a></li>
						</ul>
					</div>
				</div>
				<div class="postbox">
					<div class="post-comt-box">
						<form method="post">
							<input type="text" placeholder="Search Friends, Pages, Groups, etc....">
							<textarea placeholder="Say something about this..."></textarea>
							<div class="add-smiles">
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

							<button type="submit"></button>
						</form>
					</div>
					<figure><img src="images/resources/share-post.jpg" alt=""></figure>
					<div class="friend-info">
						<figure>
							<img alt="" src="images/resources/admin.jpg">
						</figure>
						<div class="friend-name">
							<ins><a title="" href="time-line.html">Jack Carter</a> share <a title=""
									href="#">link</a></ins>
							<span>Yesterday with @Jack Piller and @Emily Stone at the concert of # Rock'n'Rolla in
								Ontario.</span>
						</div>
					</div>
					<div class="share-to-other">
						<span>Share to other socials</span>
						<ul>
							<li><a class="facebook-color" href="#" title=""><i class="fa fa-facebook-square"></i></a>
							</li>
							<li><a class="twitter-color" href="#" title=""><i class="fa fa-twitter-square"></i></a></li>
							<li><a class="dribble-color" href="#" title=""><i class="fa fa-dribbble"></i></a></li>
							<li><a class="instagram-color" href="#" title=""><i class="fa fa-instagram"></i></a></li>
							<li><a class="pinterest-color" href="#" title=""><i class="fa fa-pinterest-square"></i></a>
							</li>
						</ul>
					</div>
					<div class="copy-email">
						<span>Copy & Email</span>
						<ul>
							<li><a href="#" title="Copy Post Link"><i class="fa fa-link"></i></a></li>
							<li><a href="#" title="Email this Post"><i class="fa fa-envelope"></i></a></li>
						</ul>
					</div>
					<div class="we-video-info">
						<ul>
							<li>
								<span title="" data-toggle="tooltip" class="views" data-original-title="views">
									<i class="fa fa-eye"></i>
									<ins>1.2k</ins>
								</span>
							</li>
							<li>
								<span title="" data-toggle="tooltip" class="views" data-original-title="shares">
									<i class="fa fa-share-alt"></i>
									<ins>20k</ins>
								</span>
							</li>
						</ul>
						<button class="main-btn color" data-ripple="">Submit</button>
						<button class="main-btn cancel" data-ripple="">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div><!-- share popup -->

	<div class="popup-wraper3">
		<div class="popup">
			<span class="popup-closed"><i class="ti-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<h5>Report Post</h5>

				</div>
				<div class="Rpt-meta">
					<span>We're sorry something's wrong. How can we help?</span>
					<form method="post" class="c-form">
						<div class="form-radio">
							<div class="radio">
								<label>
									<input type="radio" name="radio" checked="checked"><i class="check-box"></i>It's
									spam or abuse
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio"><i class="check-box"></i>It breaks r/technology's
									rules
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio"><i class="check-box"></i>Not Related
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio"><i class="check-box"></i>Other issues
								</label>
							</div>
						</div>
						<div>
							<label>Write about Report</label>
							<textarea placeholder="write someting about Post" rows="2"></textarea>
						</div>
						<div>
							<button data-ripple="" type="submit" class="main-btn">Submit</button>
							<a href="#" data-ripple="" class="main-btn3 cancel">Close</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- report popup -->

	<div class="popup-wraper1">
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

	<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active-accordion");
            var panel = this.nextElementSibling;
            // var panel = document.getElementsByClassName("panel");
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
    </script>

</body>

</html>