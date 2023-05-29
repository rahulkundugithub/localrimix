<?php
require_once 'config.php';

include('time_ago.php');
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
		@media screen and (max-width: 480px) {
			.unit-text-caro {
				height: 100vh;
			}

			.unit-text-caro img {
				height: 100%;
				object-fit: cover;
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

		<div class="responsive-header">
			<div class="mh-head first Sticky">
				<span class="mh-btns-left">
					<a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
				</span>
				<span class="mh-text">
					<a href="index.php" title="ResearchRemix"><img src="content/logo.png" alt="ResearchRemix"></a>
				</span>
				<!-- <span class="mh-btns-right">
					<a class="fa fa-sliders" href="#shoppingbag"></a>
				</span> -->
			</div>
			<!-- <div class="mh-head second">
				<form class="mh-form">
					<input placeholder="search" />
					<a href="#/" class="fa fa-search"></a>
				</form>
			</div> -->
			<nav id="menu" class="res-menu">
				<ul>
					<li style="color: #fd7e14;"><a href="index.php" title="ResearchRemix"><span>Home</span></a></li>
					<li><a href="login.php" title="Login"><span>Login</span></a></li>
					<li><a href="register.php" title="Register"><span>Register</span></a></li>
					<li><a href="research.php" title="Research Videos"><span>Research Videos</span></a></li>
					<li><a href="contact.php" title="Contact"><span>Contact</span></a></li>

					<!-- <li><span>Pittube</span>
						<ul>
							<li><a href="pittube.html" title="">Pittube</a></li>
							<li><a href="pittube-detail.html" title="">Pittube single</a></li>
							<li><a href="pittube-category.html" title="">Pittube Category</a></li>
							<li><a href="pittube-channel.html" title="">Pittube Channel</a></li>
							<li><a href="pittube-search-result.html" title="">Pittube Search Result</a></li>
						</ul>
					</li>
					<li><span>PitPoint</span>
						<ul>
							<li><a href="pitpoint.html" title="">PitPoint</a></li>
							<li><a href="pitpoint-detail.html" title="">Pitpoint Detail</a></li>
							<li><a href="pitpoint-list.html" title="">Pitpoint List style</a></li>
							<li><a href="pitpoint-without-baner.html" title="">Pitpoint without Banner</a></li>
							<li><a href="pitpoint-search-result.html" title="">Pitpoint Search</a></li>
						</ul>
					</li>
					<li><span>Pitjob</span>
						<ul>
							<li><a href="career.html" title="">Pitjob</a></li>
							<li><a href="career-detail.html" title="">Pitjob Detail</a></li>
							<li><a href="career-search-result.html" title="">Job seach page</a></li>
							<li><a href="social-post-detail.html" title="">Social Post Detail</a></li>
						</ul>
					</li>
					<li><span>Timeline</span>
						<ul>
							<li><a href="timeline.html" title="">Timeline</a></li>
							<li><a href="timeline-photos.html" title="">Timeline Photos</a></li>
							<li><a href="timeline-videos.html" title="">Timeline Videos</a></li>
							<li><a href="timeline-groups.html" title="">Timeline Groups</a></li>
							<li><a href="timeline-friends.html" title="">Timeline Friends</a></li>
							<li><a href="timeline-friends2.html" title="">Timeline Friends-2</a></li>
							<li><a href="about.html" title="">Timeline About</a></li>
							<li><a href="blog-posts.html" title="">Timeline Blog</a></li>
							<li><a href="friends-birthday.html" title="">Friends' Birthday</a></li>
							<li><a href="newsfeed.html" title="">Newsfeed</a></li>
							<li><a href="search-result.html" title="">Search Result</a></li>
						</ul>
					</li>
					<li><span>Favourit Page</span>
						<ul>
							<li><a href="fav-page.html" title="">Favourit Page</a></li>
							<li><a href="fav-favers.html" title="">Fav Page Likers</a></li>
							<li><a href="fav-events.html" title="">Fav Events</a></li>
							<li><a href="fav-event-invitations.html" title="">Fav Event Invitations</a></li>
							<li><a href="event-calendar.html" title="">Event Calendar</a></li>
							<li><a href="fav-page-create.html" title="">Create New Page</a></li>
							<li><a href="price-plans.html" title="">Price Plan</a></li>
						</ul>
					</li>
					<li><span>Forum</span>
						<ul>
							<li><a href="forum.html" title="">Forum</a></li>
							<li><a href="forum-create-topic.html" title="">Forum Create Topic</a></li>
							<li><a href="forum-open-topic.html" title="">Forum Open Topic</a></li>
							<li><a href="forums-category.html" title="">Forum Category</a></li>
						</ul>
					</li>
					<li><span>Featured</span>
						<ul>
							<li><a href="chat-messenger.html" title="">Messenger (Chatting)</a></li>
							<li><a href="notifications.html" title="">Notifications</a></li>
							<li><a href="badges.html" title="">Badges</a></li>
							<li><a href="faq.html" title="">Faq's</a></li>
							<li><a href="contribution.html" title="">Contriburion Page</a></li>
							<li><a href="manage-page.html" title="">Manage Page</a></li>
							<li><a href="weather-forecast.html" title="">weather-forecast</a></li>
							<li><a href="statistics.html" title="">Statics/Analytics</a></li>
							<li><a href="shop-cart.html" title="">Shop Cart</a></li>
						</ul>
					</li>
					<li><span>Account Setting</span>
						<ul>
							<li><a href="setting.html" title="">Setting</a></li>
							<li><a href="privacy.html" title="">Privacy</a></li>
							<li><a href="support-and-help.html" title="">Support & Help</a></li>
							<li><a href="support-and-help-detail.html" title="">Support Detail</a></li>
							<li><a href="support-and-help-search-result.html" title="">Support Search</a></li>
						</ul>
					</li>
					<li><span>Authentication</span>
						<ul>
							<li><a href="login.html" title="">Login Page</a></li>
							<li><a href="register.html" title="">Register Page</a></li>
							<li><a href="logout.html" title="">Logout Page</a></li>
							<li><a href="coming-soon.html" title="">Coming Soon</a></li>
							<li><a href="error-404.html" title="">Error 404</a></li>
							<li><a href="error-404-2.html" title="">Error 404-2</a></li>
							<li><a href="error-500.html" title="">Error 500</a></li>
						</ul>
					</li>
					<li><span>Tools</span>
						<ul>
							<li><a href="typography.html" title="">Typography</a></li>
							<li><a href="popup-modals.html" title="">Popups/Modals</a></li>
							<li><a href="post-versions.html" title="">Post Versions</a></li>
							<li><a href="sliders.html" title="">Sliders / Carousel</a></li>
							<li><a href="google-map.html" title="">Google Maps</a></li>
							<li><a href="widgets.html" title="">Widgets</a></li>
						</ul>
					</li>
				</ul> -->
			</nav>
			<!-- <nav id="shoppingbag">
			<div>
				<div class="">
					<form method="post">
						<div class="setting-row">
							<span>use night mode</span>
							<input type="checkbox" id="nightmode"/> 
							<label for="nightmode" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Notifications</span>
							<input type="checkbox" id="switch2"/> 
							<label for="switch2" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Notification sound</span>
							<input type="checkbox" id="switch3"/> 
							<label for="switch3" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>My profile</span>
							<input type="checkbox" id="switch4"/> 
							<label for="switch4" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Show profile</span>
							<input type="checkbox" id="switch5"/> 
							<label for="switch5" data-on-label="ON" data-off-label="OFF"></label>
						</div>
					</form>
					<h4 class="panel-title">Account Setting</h4>
					<form method="post">
						<div class="setting-row">
							<span>Sub users</span>
							<input type="checkbox" id="switch6" /> 
							<label for="switch6" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>personal account</span>
							<input type="checkbox" id="switch7" /> 
							<label for="switch7" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Business account</span>
							<input type="checkbox" id="switch8" /> 
							<label for="switch8" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Show me online</span>
							<input type="checkbox" id="switch9" /> 
							<label for="switch9" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Delete history</span>
							<input type="checkbox" id="switch10" /> 
							<label for="switch10" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Expose author name</span>
							<input type="checkbox" id="switch11" /> 
							<label for="switch11" data-on-label="ON" data-off-label="OFF"></label>
						</div>
					</form>
				</div>
			</div>
		</nav>
		 -->
		</div><!-- responsive header -->

		<!-- Laptop PC Header -->

		<div class="topbar transperent stick">
			<div class="logo">
				<a title="ResearchRemix" href="index.php"><img src="content/logo.png" alt="ResearchRemix"></a>
			</div>
			<nav>
				<!-- <ul class="nav-list">
				<li><a class="" href="#" title=""><i class="fa fa-home"></i> Home Pages</a>
					<ul>
						<li><a href="index.html" title="">Pitnik Default</a></li>
						<li><a href="company-landing.html" title="">Company Landing</a></li>
						<li><a href="career.html" title="">Pitjob</a>
							<ul>
								<li><a href="career.html" title="">Pitjob</a></li>
								<li><a href="career-detail.html" title="">Pitjob Detail</a></li>
								<li><a href="career-search-result.html" title="">Job seach page</a></li>
								<li><a href="social-post-detail.html" title="">Social Post Detail</a></li>
							</ul>
						</li>
						<li><a href="pitpoint.html" title="">PitPoint</a>
							<ul>
								<li><a href="pitpoint.html" title="">PitPoint</a></li>
								<li><a href="pitpoint-detail.html" title="">Pitpoint Detail</a></li>
								<li><a href="pitpoint-list.html" title="">Pitpoint List style</a></li>
								<li><a href="pitpoint-without-baner.html" title="">Pitpoint without Banner</a></li>
								<li><a href="pitpoint-search-result.html" title="">Pitpoint Search</a></li>
							</ul>
						</li>
						<li><a href="pittube.html" title="">Pittube</a>
							<ul>
								<li><a href="pittube.html" title="">Pittube</a></li>
								<li><a href="pittube-detail.html" title="">Pittube single</a></li>
								<li><a href="pittube-category.html" title="">Pittube Category</a></li>
								<li><a href="pittube-channel.html" title="">Pittube Channel</a></li>
								<li><a href="pittube-search-result.html" title="">Pittube Search Result</a></li>
							</ul>
						</li>
						<li><a href="pitrest.html" title="">Pitrest</a></li>
						<li><a href="redpit.html" title="">Redpit</a></li>
						<li><a href="redpit-category.html" title="">Redpit Category</a></li>
						<li><a href="soundnik.html" title="">Soundnik</a></li>
						<li><a href="soundnik-detail.html" title="">Soundnik Single</a></li>
						<li><a href="shop.html" title="">Shop</a></li>
						<li><a href="classified.html" title="">Classified</a></li>
						<li><a href="chat-messenger.html" title="">Messenger</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-repeat"></i> Timeline</a>
					<ul>
						<li><a href="timeline.html" title="">Timeline</a></li>
						<li><a href="timeline-photos.html" title="">Timeline Photos</a></li>
						<li><a href="timeline-videos.html" title="">Timeline Videos</a></li>
						<li><a href="timeline-groups.html" title="">Timeline Groups</a></li>
						<li><a href="timeline-friends.html" title="">Timeline Friends</a></li>
						<li><a href="timeline-friends2.html" title="">Timeline Friends-2</a></li>
						<li><a href="about.html" title="">Timeline About</a></li>
						<li><a href="blog-posts.html" title="">Timeline Blog</a></li>
						<li><a href="friends-birthday.html" title="">Friends' Birthday</a></li>
						<li><a href="newsfeed.html" title="">Newsfeed</a></li>
						<li><a href="search-result.html" title="">Search Result</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-heart"></i> Favourit Page</a>
					<ul>
						<li><a href="fav-page.html" title="">Favourit Page</a></li>
						<li><a href="fav-favers.html" title="">Fav Page Likers</a></li>
						<li><a href="fav-events.html" title="">Fav Events</a></li>
						<li><a href="fav-event-invitations.html" title="">Fav Event Invitations</a></li>
						<li><a href="event-calendar.html" title="">Event Calendar</a></li>
						<li><a href="fav-page-create.html" title="">Create New Page</a></li>
						<li><a href="price-plans.html" title="">Price Plan</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-forumbee"></i> Forum</a>
					<ul>
						<li><a href="forum.html" title="">Forum</a></li>
						<li><a href="forum-create-topic.html" title="">Forum Create Topic</a></li>
						<li><a href="forum-open-topic.html" title="">Forum Open Topic</a></li>
						<li><a href="forums-category.html" title="">Forum Category</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-star-o"></i> Featured</a>
					<ul>
						<li><a href="chat-messenger.html" title="">Messenger (Chatting)</a></li>
						<li><a href="notifications.html" title="">Notifications</a></li>
						<li><a href="badges.html" title="">Badges</a></li>
						<li><a href="faq.html" title="">Faq's</a></li>
						<li><a href="contribution.html" title="">Contriburion Page</a></li>
						<li><a href="manage-page.html" title="">Manage Page</a></li>
						<li><a href="weather-forecast.html" title="">weather-forecast</a></li>
						<li><a href="statistics.html" title="">Statics/Analytics</a></li>
						<li><a href="shop-cart.html" title="">Shop Cart</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-gears"></i> Account Setting</a>
					<ul>
						<li><a href="setting.html" title="">Setting</a></li>
						<li><a href="privacy.html" title="">Privacy</a></li>

						<li><a href="support-and-help.html" title="">Support & Help</a></li>
						<li><a href="support-and-help-detail.html" title="">Support Detail</a></li>
						<li><a href="support-and-help-search-result.html" title="">Support Search</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-lock"></i> Authentication</a>
					<ul>
						<li><a href="login.html" title="">Login Page</a></li>
						<li><a href="register.html" title="">Register Page</a></li>
						<li><a href="logout.html" title="">Logout Page</a></li>
						<li><a href="coming-soon.html" title="">Coming Soon</a></li>
						<li><a href="error-404.html" title="">Error 404</a></li>
						<li><a href="error-404-2.html" title="">Error 404-2</a></li>
						<li><a href="error-500.html" title="">Error 500</a></li>
					</ul>
				</li>
				<li><a class="" href="#" title=""><i class="fa fa-wrench"></i> Tools</a>
					<ul>
						<li><a href="typography.html" title="">Typography</a></li>
						<li><a href="popup-modals.html" title="">Popups/Modals</a></li>
						<li><a href="post-versions.html" title="">Post Versions</a></li>
						<li><a href="sliders.html" title="">Sliders / Carousel</a></li>
						<li><a href="google-map.html" title="">Google Maps</a></li>
						<li><a href="widgets.html" title="">Widgets</a></li>
					</ul>
				</li>
			</ul> -->

				<center><a class="main-btn" title="" href="research.php" data-ripple="">Research Videos</a>
					<a class="main-btn" title="" href="login.php" data-ripple="">Login</a>
					<a class="main-btn" title="" href="register.php" data-ripple="">Register Now</a>
				</center>
			</nav><!-- nav menu -->
		</div><!-- topbar nav -->

		<section>
			<div class="gap no-gap overlap22">
				<div class="text-caro">
					<div class="unit-text-caro">
						<img src="images/resources/text-caro-1.jpg" alt="">
						<div class="text-caro-meta">
							<span>ResearchRemix</span>
							<img src="images/icon-21.png" alt="">
							<h1><a title="">A Global <span>Media Platform</span></a></h1>
							<p style="font-size:20px;">
								"Social media is not a media. The key is to listen, engage, and build relationships."-
								Author: David Alston<br><br>
								"Build it, and they will come "only works in the movies. Social Media is a "build
								it, "nurture it, engage them, and they may come and stay.
							</p>
							</p>
						</div>
					</div>
					<div class="unit-text-caro">
						<img src="images/resources/text-caro-2.jpg" alt="">
						<div class="text-caro-meta">
							<span>ResearchRemix</span>
							<img src="images/icon-21.png" alt="">
							<h1><a href="#" title="">A Global Online <span>Resarch Video Sharing Platform</span></a>
							</h1>
							<p style="font-size:20px;">
								"It has been said that 80% of what people learn is visual." - Author: Allen
								Klein<br><br>
								This quote remonds us of the times when picture spoke a lot to us than words. The trend
								still dominates; the
								only thing required is to have an eye and attitude to accept that fact!
							</p>
						</div>
					</div>
				</div>
			</div>
		</section><!-- banner carousel on top -->

		<section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="welcome-area">
								<h2>Welcome to ResearchRemix. MultiPurpose Learning Platform</h2>
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
						<div class="col-lg-6 col-md-6">
							<div class="welcome-avatar">
								<img src="content/researchremix.png" alt="researchremix">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- welcome section -->

		<section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="sec-heading style9 text-center">
								<span><i class="fa fa-trophy"></i> For the global growth</span>
								<h2>All in one <span>Plateform</span></h2>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="serv-box">
								<i class="fa fa-graduation-cap"></i>
								<h4>Learning</h4>
								<p>
									Easy, one click learning from anywhere in the world keeps you updated with ongoing
									research
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="serv-box">
								<i class="fa fa-thumbs-up"></i>
								<h4>Publishing</h4>
								<p>
									Posting your research video saves your time and money, and immedietely share your
									research contribution witht the world
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="serv-box">
								<i class="fa fa-group"></i>
								<h4>Social Accounts</h4>
								<p>
									Connecting and following several interesting fields and experts gives you a heads up
									in ongoing research advancements
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="serv-box">
								<i class="fa fa-tasks"></i>
								<h4>Jobs & Opportunities</h4>
								<p>
									It finally comes to get the deserved job in your level of competence. We help you
									get the place where your skills are equally used and challanged
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- services sec -->

		<section>
			<div class="gap">
				<div class="container">
					<div class="sec-heading style9 text-center">
						<span><i class="fa fa-trophy"></i> For the global growth</span>
						<h2>Our <span>Portfolio</span></h2>
					</div>
					<div class="row" id="page-contents">
						<div class="col-lg-12">
							<div id="options" class="isotop-full">
								<div class="option-isotop">
									<ul id="filter2" class="option-set icon-style" data-option-key="filter">
										<li><a href="#all" data-option-value="*" class="selected" data-toggle="tooltip"
												data-placement="top" title="All">all</a></li>
										<li><a href="#rtube" data-option-value=".accessory" data-toggle="tooltip"
												data-placement="top" title="ResearchTube">ResearchTube</a></li>
										<li><a href="#Networking" data-option-value=".diy" data-toggle="tooltip"
												data-placement="top" title="Networking">Networking</a></li>
										<li><a href="#jobs" data-option-value=".cloth" data-toggle="tooltip"
												data-placement="top" title="Jobs">Jobs</a></li>
										<li><a href="#others" data-option-value=".hand" data-toggle="tooltip"
												data-placement="top" title="Others">others</a></li>
									</ul>
								</div>
							</div><!-- FILTER BUTTONS -->
						</div>
						<div class="col-lg-12">
							<div class="row masonry">
								<div class="hand col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail1.jpg" alt="">
										<div class="overlinks">

										</div>
									</div>
								</div>
								<div class="jewl col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail2.jpg" alt="">
										<div class="overlinks">

										</div>
									</div>
								</div>
								<div class="accessory col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail3.jpg" alt="">
										<div class="overlinks">
											<!-- <h4><a href="#" title="">JBL Headphone</a></h4>
											<ul class="cate">
												<li><a href="#" title="">Shoes</a></li>
												<li><a href="#" title="">home made</a></li>
												<li><a href="#" title="">clothes</a></li>
											</ul> -->
										</div>
									</div>
								</div>
								<div class="diy col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail4.jpg" alt="">
										<div class="overlinks">
											<!-- <h4><a href="#" title="">Winter Cap</a></h4>
											<ul class="cate">
												<li><a href="#" title="">Shoes</a></li>
												<li><a href="#" title="">home made</a></li>
												<li><a href="#" title="">clothes</a></li>
											</ul> -->
										</div>
									</div>
								</div>
								<div class="cloth col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail5.jpg" alt="">
										<div class="overlinks">
											<!-- <h4><a href="#" title="">Men's Watch</a></h4>
											<ul class="cate">
												<li><a href="#" title="">Watches</a></li>
												<li><a href="#" title="">home made</a></li>
												<li><a href="#" title="">clothes</a></li>
											</ul> -->
										</div>
									</div>
								</div>
								<div class="hand col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail6.jpg" alt="">
										<div class="overlinks">
											<!-- <h4><a href="#" title="">Winter Cap</a></h4>
											<ul class="cate">
												<li><a href="#" title="">accessoires</a></li>
												<li><a href="#" title="">home made</a></li>
												<li><a href="#" title="">clothes</a></li>
											</ul> -->
										</div>
									</div>
								</div>
								<div class="accessory col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail7.jpg" alt="">
										<div class="overlinks">
											<!-- <h4><a href="#" title="">Stylo Shoes</a></h4>
											<ul class="cate">
												<li><a href="#" title="">Shoes</a></li>
												<li><a href="#" title="">home made</a></li>
												<li><a href="#" title="">clothes</a></li>
											</ul> -->
										</div>
									</div>
								</div>
								<div class="jewl col-lg-3 col-sm-6">
									<div class="portfolio-box">
										<img src="images/resources/folio-detail8.jpg" alt="">
										<div class="overlinks">
											<!-- <h4><a href="#" title="">G-Sound Headphone</a></h4>
											<ul class="cate">
												<li><a href="#" title="">accessoires</a></li>
												<li><a href="#" title="">home made</a></li>
												<li><a href="#" title="">clothes</a></li>
											</ul> -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- our portfolio -->

		<section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="sec-heading style9 text-center">
								<span><i class="fa fa-trophy"></i> the Global Content</span>
								<h2>Our Latest <span>Uploads</span></h2>
							</div>
						</div>
						<?php

						// fetching Lates uploades videos
						$sql = "SELECT * FROM videos ORDER BY date DESC LIMIT 3";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								?>

								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="blog-grid">
										<figure>
											<!-- <video style=" max-width: 430px;
											max-height: 290px;" src="content/Mera Toh Itna Life Kharab Ho Gaya Hai - Meme Template(480P).mp4"
												controls="" poster=""></video> -->
												<img  style=" width: 430px; height: 200px; object-fit: cover;"  src="<?= $row['thumbnail_path'] ?>" >
										</figure>
										<div class="blog-meta">
											<div class="blog-head">
												<ul class="postby">
													<li>
														<figure><img src="<?= $row['channel_img'] ?>"></figure>
														<span>
															<?= $row['channel_name'] ?>
														</span>
													</li>
													<li><span>
															<?php echo time_elapsed_string($row['date']); ?>
														</span></li>
												</ul>
												<?php
												$string = $row['title'];

												if (strlen($string) > 30) {
													$string = substr($string, 0, 35) . "..";
												}
												?>
												<!-- <a href="#" title="" class="date">06 Aug</a> -->
												<h4 class="blog-title"><a
														href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>"
														title=""><?= $string?></a>
												</h4>
											</div>
										</div>
									</div>
								</div>

							<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</section><!-- blog -->

		<!-- <section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="funfact">
								<div class="count">
									<span class="counter">39</span>
									<i>K</i>
								</div>
								<div class="counter-meta">
									<img src="images/icon-4.png" alt="">
									<h2><a href="#" title="">Registerd Users</a></h2>
									<span>Honors & Recognition</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="funfact">
								<div class="count">
									<span class="counter">289</span>
									<i>K</i>
								</div>
								<div class="counter-meta">
									<img src="images/icon-5.png" alt="">
									<h2><a href="#" title="">Post Published</a></h2>
									<span>Honors & Recognition</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="funfact">
								<div class="count">
									<span class="counter">480</span>
									<i>K</i>
								</div>
								<div class="counter-meta">
									<img src="images/icon-6.png" alt="">
									<h2><a href="#" title="">People Online</a></h2>
									<span>Honors & Recognition</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- fun facts section -->
		<section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4">
							<div class="team">
								<h5>Active <span>Team</span></h5>
								<span>Professional Developers</span>
								<p>"The strength of the team is each individual member. The strength of each member is
									team" - <i>Phil Jackson</i></p>
								<a href="#" title="" class="main-btn" data-ripple="">Get Inquiry</a>
							</div>
						</div>
						<div class="col-lg-9 col-md-8">
							<div class="team-carouzel">
								<div class="team-member">
									<img src="content/team1.webp" alt="Martin">
									<div class="team-info over-top">
										<h2><a href="#" title="">Martin Stolterfoht</a></h2>
										<span>Chief Enterpreneur</span>
									</div>
								</div>
								<div class="team-member">
									<img src="content/team2.webp" alt="poojapandey">
									<div class="team-info over-top">
										<h2><a href="#" title="">Pooja Pandey</a></h2>
										<span>Enterpreneur</span>
									</div>
								</div>
								<div class="team-member">
									<img src="content/team3.webp" alt="sachinshah">
									<div class="team-info over-top">
										<h2><a href="#" title="">Sachin Sam Shah</a></h2>
										<span>Marketing Head</span>
									</div>
								</div>
								<div class="team-member">
									<img src="content/team4.webp" alt="sahilshah">
									<div class="team-info over-top">
										<h2><a href="#" title="">Sahil Shah</a></h2>
										<span>Developer Head</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- our team -->

		<section>
			<div class="news-letter-bx">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="leter-meta">
								<h2>Subscribe To Newsletter</h2>
								<p>
									Signup now to receive latest news & exclusive and more offers.
								</p>
								<i><img src="images/envelop.png" alt=""></i>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="leter-input">
								<form method="post">
									<input type="text" placeholder="Your Email...">
									<button type="submit" class="main-btn" data-ripple="">
										Subscribe Now
										<i class="fa fa-paper-plane-o"></i>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- subscribe sec -->

		<footer class="style2 dark">
			<div class="logo">
				<img src="content/logo.png" alt="">
			</div>
			<div class="share-article">
				<a data-ripple="" href="https://www.facebook.com/profile.php?id=100088920232628" title=""
					class="facebook"><i class="fa fa-facebook"></i></a>

				<a data-ripple="" href="https://www.instagram.com/research_remix/" title="" class="instagram"><i
						class="fa fa-instagram"></i></a>
				<a data-ripple="" href="https://twitter.com/Research_Remix" title="" class="twitter"><i
						class="fa fa-twitter"></i></a>

			</div>
			<div class="nav-links">
				<a href="index.php" title="">Home</a>
				<a href="login.php" title="">Login</a>
				<a href="register.php" title="">Register</a>
				<a href="research.php" title="">Research Videos</a>
				<a href="contact.php" title="">contact</a>
			</div>
			<div class="footer-links mt-4 text-white">
				<h4>Contact Us</h4>
				<p class="text-white">
					Potsdam, 14469, Germany
					<br>
					Uttar Pradesh, India <br>
					<strong>Phone:</strong><a href="tel:+4917631188260"> +4917631188260</a><br>
					<strong>Email:</strong><a href="mailto:researchremix27@gmail.com"> researchremix27@gmail.com
					</a><br>
				</p>
			</div>
			<div class="copyright-content">
				<span class="">Copyright © 2023 ResearchRemix. All Rights Reserved.</span>
				<sub>Designed by <a href="#" title="">ResearchRemix</a></sub>
			</div>
		</footer><!-- footer -->

		<div class="popup-wraper subscription">
			<div class="popup whitish high-opacity">
				<a class="popup-closed" href="#" title=""><i class="fa fa-close"></i></a>
				<div class="popup-bg" style="background-image:url(images/resources/deal-popup-bg.jpg);"></div>
				<div class="sub-popup">
					<h4>signup <span>newsletter</span></h4>
					<h5 class="text-center text-capitalize text-danger">Level up your knowldge from inside your inbox
					</h5>
					<p>Receive the latest Knowledge, insights, trends, tools, case studies and early access straight to
						your Inbox</p>
					<form method="post">
						<input type="text" placeholder="Subscribe to newsletter">
						<button data-ripple=""><i class="fa fa-envelope"></i> &nbsp; Subscribe Now</button>
					</form>
				</div>
			</div>
		</div><!-- page onload popup -->
	</div>

	<script src="js/main.min.js"></script>
	<script src="js/jquery.funfact.min.js"></script>
	<script src="js/counterup-t-waypoint.js"></script>
	<script src="js/script.js"></script>

</body>

</html>