<!-- mobile header -->

<style>
    .acctive {
        color: #fd7e14;
    }
</style>
<?php

if (empty($_SESSION['form_status']) || $userData['picture'] == "" || $userData['first_name'] == "") {
    $userData['picture'] = "https://cdn-icons-png.flaticon.com/512/3870/3870822.png";
    $userData['first_name'] = "Not Logged-IN";
    $loginPOP = true;
} ?>

<div class="responsive-header">
    <div class="mh-head first Sticky">
        <span class="mh-btns-left">
            <a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
        </span>
        <span class="mh-text">
            <a href="index.php?id=<?= $id ?>" title=""><img src="content/logo.png" alt="researchremix"></a>
        </span>
        <span class="mh-btns-right">
            <a class="fa fa-sliders" href="#shoppingbag"></a>
        </span>
    </div>
    <div class="mh-head second">
        <form method="get" action="search.php" class="mh-form">
            <input name="qy" placeholder="search" />
            <input type="hidden" name="id" value="<?= $id ?>">
            <button style="background: none; margin-top: -5px;" class="fa fa-search"></button>
        </form>
    </div>
    <nav id="menu" class="res-menu">
        <ul>
            <li><a href="index.php?<?= $id ?>" title="ResearchRemix"><span>Home</span></a></li>
            <li><a href="login.php" title="Login"><span>Login</span></a></li>
            <li><a href="register.php" title="Register"><span>Register</span></a></li>
            <li class=""><a href="research.php" title="Research Videos"><span>Research Videos</span></a>
            </li>
            <li><a href="contact.php" title="Contact"><span>Contact</span></a></li>
        </ul>
    </nav>
    <nav id="shoppingbag">
        <div>
            <div class="">
                <form method="post">
                    <div class="setting-row">

                        <?= $userData['first_name'] . ' ' . $userData['last_name']; ?>
                        </h5>
                        <img src="<?= $userData['picture']; ?>" style=" border-radius:100px; border: solid 1px #fa6342; height: 45px;" alt="">

                    </div>
                    <a href="myprofile.php?id=<?= $id ?>">
                        <div class="setting-row">
                            <span>View Profile</span>
                            <i class="ti-user"></i>
                        </div>
                    </a>
                    <a href="myprofile.php?id=<?= $id ?>#link2">
                        <div class="setting-row">
                            <span>Edit Profile</span>
                            <i class="ti-pencil-alt"></i>
                        </div>
                    </a>
                    <a href="myprofile.php?id=<?= $id ?>#link2">
                        <div class="setting-row">
                            <span>Account Setting</span>
                            <i class="ti-settings"></i>
                        </div>
                    </a>
                    <div class="setting-row">
                        <a href="logout.php" title=""><span style="color:red;">Log Out</span>
                            <i style="color:red;" class="ti-power-off"></i></a>
                    </div>

                </form>
            </div>
        </div>
    </nav>
</div><!-- responsive header -->

<!-- laptop header -->

<div class="topbar stick">
    <div class="logo">
        <a title="" href="index.php?id=<?= $id ?>"><img src="content/logo.png" alt="researchremix"></a>
    </div>
    <div class="top-area">
        <!-- <div class="main-menu">
					<span>
						<i class="fa fa-braille"></i>
					</span>
				</div> -->
        <div class="top-search">
            <form method="get" action="search.php" class="">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="text" name="qy" placeholder="Search Research Video, Channel etc">
                <button data-ripple><i class="ti-search"></i></button>
            </form>
        </div>
        <div class="page-name">
            <a onclick="history.back()"><span>Research Videos</span></a>
        </div>
        <a href="research.php?id=<?= $id ?>">
            <ul class="setting-area">
                <li style="margin-left: 10px;"><i class="fa fa-home"></i>
                </li>
        </a>
        </ul>
        <div class="user-img">
            <h5>
                <?= $userData['first_name'] . ' ' . $userData['last_name']; ?>
            </h5>
            <img src="<?= $userData['picture']; ?>" style="height: 45px;" alt="">

            <div class="user-setting">

                <span class="seting-title">User setting</span>
                <ul class="log-out">
                    <?php if ($loginPOP != true) { ?><li><a href="myprofile.php?id=<?= $id ?>" title=""><i class="ti-user"></i> view profile</a></li>
                        <li><a href="myprofile.php?id=<?= $id ?>#link2" title=""><i class="ti-pencil-alt"></i>edit
                                profile</a>
                        </li>
                        <li><a href="myprofile.php?id=<?= $id ?>#link2" title=""><i class="ti-settings"></i>account
                                setting</a></li>
                        <li style="color: red;"><a href="logout.php" title=""><i class="ti-power-off"></i>log
                                out</a></li>
                        <?php } else { ?> 
                        <li style="color: red;"><a href="login.php" title=""><i class="ti-power-off"></i>log-In</a></li> <?php } ?>
                </ul>
            </div>
        </div>

    </div>
</div><!-- topbar -->

<?php if ($loginPOP == true) { ?>

    <div class="popup-wraper subscription">
        <div class="popup whitish high-opacity">
            <a class="popup-closed" href="#" title=""><i class="fa fa-close"></i></a>
            <div class="popup-bg" style="background-image:url(images/resources/deal-popup-bg.jpg);"></div>
            <div class="sub-popup">
                <h4>Unlock the Full Potential of ResearchRemix <br> <span>Sign Up Now!</span></h4>

                <p style="padding-bottom: 0px;">New to ResearchRemix?</p>
                <form action="register.php">
                    <button href="register.php" data-ripple=""><i class="fa fa-envelope"></i> &nbsp; Register Now</button>
                </form>

                <form action="login.php">
                    <button href="register.php" data-ripple=""><i class="fa fa-envelope"></i> &nbsp; Sign-Up Now</button>
                </form>
            </div>
        </div>
    </div><!-- page onload popup -->

<?php } ?>