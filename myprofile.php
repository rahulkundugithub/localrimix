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

$user_id = $userData['oauth_uid'];

//fetch user category from db 
$query = "SELECT * FROM users WHERE oauth_uid='$user_id' LIMIT 1;";
$query_run = mysqli_query($conn, $query);
if ($query_run->num_rows > 0) {
    $row = $query_run->fetch_assoc();

    ?>
    <!DOCTYPE html>
    <html lang="en">


    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <title>My Profile - ResearchRemix </title>
        <link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

        <link rel="stylesheet" href="css/main.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/color.css">
        <link rel="stylesheet" href="css/responsive.css">


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

            .fileContainer [type=file] {
                opacity: 1;
                width: auto;
                top: auto;
                right: auto;
                overflow: none;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            function uploadProfile() {

                var bio = $('#bio').text();
                var edu = $('#edu').val();
                var workexp = $('#workexp').val();
                var other_ints = $('#other_ints').val();

                var formdata = new FormData();
                formdata.append('name', $('#name').val());
                formdata.append('username', $('#username').val());
                formdata.append('email', $('#email').val());

                formdata.append('bio', bio);
                formdata.append('edu', edu);
                formdata.append('workexp', workexp);
                formdata.append('other_ints', other_ints);

                formdata.append('username', $('#username').val());
                formdata.append('user_id', $('#user_id').val());

                formdata.append('fb', $('#fb').val());
                formdata.append('insta', $('#instagram').val());
                formdata.append('twitter', $('#twitter').val());
                formdata.append('linkedin', $('#linkedin').val());

                formdata.append('uid', $('#uid').val());


                formdata.append('cover', $('#cover')[0].files[0]);
                formdata.append('dp', $('#dp')[0].files[0]);

                $.ajax({
                    url: 'editprofile.php',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('.progress-bar').width(percentComplete + '%');
                                $('.progress-bar').html(percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        if (response == 'success') {
                            alert('Updated Successfully!');
                            // $('#title').val('');
                            // $('#description').val('');
                            // $('#video').val('');
                            // $('#thumbnail').val('');
                            // $('.preview-thumbnail').attr('src', '');
                            // $('.progress-bar').width('0%');
                            // $('.progress-bar').html('0%');
                        } else {
                            alert(response);
                        }
                    }
                });
            }

            function updatePassword() {

                var formdata = new FormData();
                formdata.append('oldpass', $('#oldpass').val());
                formdata.append('newpass', $('#newpass').val());
                formdata.append('renewpass', $('#renewpass').val());
                formdata.append('oauth_id', $('#oauth_id').val());

                $.ajax({
                    url: 'updatepassword.php',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('.progress-bar').width(percentComplete + '%');
                                $('.progress-bar').html(percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        if (response == 'success') {
                            alert('Password Updated Successfully!');

                        } else {
                            alert(response);
                        }
                    }
                });
            }

            function updatecategory() {

                var formdata = new FormData();

                formdata.append('user_id', $('#user_id').val());

                $('.myCheckbox:checked').each(function () {
                    formdata.append($(this).attr('name'), $(this).val());
                });

                $.ajax({
                    url: 'updatecategory.php',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('.progress-bar').width(percentComplete + '%');
                                $('.progress-bar').html(percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        if (response == 'success') {
                            alert('Password Updated Successfully!');

                        } else {
                            alert(response);
                        }
                    }
                });
            }
        </script>

        <?php
        if (isset($_POST['categories'])) {
            $category_check = $_POST['categories'];

            $error = "heeyy";

            $error = print_r($category_check);

            //check actegory not empty
            if(empty($category_check)){
                $error = "<font style='color: red;'>Please select any Category to Update!</font>";
            } else {
                // Process the form data here
                $category = implode(',', $_POST['categories']);
                $user_id = $userData['oauth_uid'];
                /////////////////////
    
                //$category_list = $category;

            }
        }
        ?>


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


            <!-- mobile header -->

            <!-- header	 -->

            <?php require('menu.php'); ?>

            <!-- header end -->

            <!-- mobile header end -->

            <section>
                <div class="gap2 gray-bg">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <h3>
                                    <?php echo $error; ?>
                                </h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row merged20" id="page-contents">
                                    <div class="user-profile">
                                        <figure>
                                            <!-- <div class="edit-pp">
                                                                <label class="fileContainer">
                                                                    <i class="fa fa-camera"></i>
                                                                    <input type="file">
                                                                </label>
                                                            </div> -->
                                            <img src="<?= $row['cover']; ?>" style="object-fit:cover; height: 300px;">


                                        </figure>

                                        <div class="profile-section">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="profile-author">
                                                        <div class="profile-author-thumb">
                                                            <img alt="author" src="<?= $userData['picture'] ?>">

                                                        </div>
                                                        <div class="author-content">
                                                            <a class="h4 author-name" href="">
                                                                <?= $userData['first_name'] . ' ' . $userData['last_name'] ?>
                                                            </a>
                                                            <div class="country">
                                                                <?= $userData['username'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <ul class="nav nav-tabs links-tab">
                                                        <li class="nav-item"><a class="active" href="#link1"
                                                                data-toggle="tab">About</a></li>
                                                        <li class="nav-item"><a class="" href="#link2"
                                                                data-toggle="tab">Settings</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- user profile banner  -->
                                    <div class="col-lg-12">
                                        <div class="tab-content">
                                            <div class="tab-pane active fade show" id="link1">
                                                <div class="row merged20">


                                                    <div class="col-lg-12">
                                                        <div class="central-meta">
                                                            <span class="create-post">General Info</span>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="gen-metabox">
                                                                        <span><i class="fa fa-puzzle-piece"></i> About The
                                                                            Profile</span>
                                                                        <p>
                                                                            <?= $userData['bio'] ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="gen-metabox">
                                                                        <span><i class="fa fa-plus"></i> Others
                                                                            Interests</span>
                                                                        <p>
                                                                            <?php if ($userData['other_ints'] == "") {
                                                                                echo 'Surfing Research Remix.';
                                                                            } else
                                                                                echo $userData['other_ints']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="gen-metabox">
                                                                        <span><i class="fa fa-mortar-board"></i>
                                                                            Education</span>
                                                                        <p>
                                                                            <?php if ($userData['edu'] == "") {
                                                                                echo 'Not Postted by user.';
                                                                            } else
                                                                                echo $userData['edu']; ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="gen-metabox">
                                                                        <span><i class="fa fa-certificate"></i> Work and
                                                                            experience</span>
                                                                        <p>
                                                                            <?php if ($userData['workexp'] == "") {
                                                                                echo 'Not Posted by user.';
                                                                            } else
                                                                                echo $userData['workexp']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="gen-metabox no-margin">
                                                                        <span><i class="fa fa-sitemap"></i> Social
                                                                            Networks</span>
                                                                        <ul class="sociaz-media">

                                                                            <?php
                                                                            $links = explode(',', $userData['social_links']);
                                                                            ?>
                                                                            <li><a class="facebook" href="<?= $links[0] ?>"
                                                                                    title=""><i
                                                                                        class="fa fa-facebook"></i></a></li>
                                                                            <li><a class="twitter" href="<?= $links[1] ?>"
                                                                                    title=""><i
                                                                                        class="fa fa-twitter"></i></a></li>
                                                                            <li><a class="google" href="<?= $links[2] ?>"
                                                                                    title=""><i
                                                                                        class="fa fa-linkedin"></i></a></li>

                                                                            <li><a class="instagram" href="<?= $links[3] ?>"
                                                                                    title=""><i
                                                                                        class="fa fa-instagram"></i></a>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="central-meta">
                                                            <div class="create-post">Chanel's Videos</div>
                                                            <div class="row merged20">
                                                                <?php
                                                                $sql = "SELECT * FROM videos WHERE user_id='$user_id' ORDER BY date DESC";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        ?>

                                                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                                                            <div class="tube-post">
                                                                                <figure>
                                                                                    <img src="<?= $row['thumbnail_path'] ?>"
                                                                                        style="object-fit: cover; height:154px; "
                                                                                        alt="<?= $row['title'] ?>">

                                                                                    <div class="more">
                                                                                        <div class="more-post-optns"><i
                                                                                                class="ti-more-alt"></i>
                                                                                            <ul>

                                                                                                <?php $link = "researchvideo.php?id=" . $id . "&vd=" . $row['vid_id']; ?>

                                                                                                <li class="get-lin">
                                                                                                    <i class="fa fa-link"></i>Copy
                                                                                                    Link
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </figure>
                                                                                <div class="tube-title">
                                                                                    <h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>"
                                                                                            title=""><?= $row['title'] ?></a></h6>
                                                                                    <span class="upload-time">
                                                                                        <?= time_elapsed_string($row['date']) ?>
                                                                                    </span>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }
                                                                } else
                                                                    echo "<p class='pl-2' >No Video Posted Yet..</p>" ?>

                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="link2">
                                                    <div class="central-meta">
                                                        <div class="about">
                                                            <div class="d-flex flex-row mt-2">
                                                                <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left">

                                                                    <li class="nav-item">
                                                                        <a href="#edit-profile" class="nav-link active"
                                                                            data-toggle="tab"><i class="fa fa-pencil"></i> Edit
                                                                            Profile</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a href="#password" class="nav-link"
                                                                            data-toggle="tab"><i class="fa fa-shield"></i>
                                                                            Change Password</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a href="#category" class="nav-link"
                                                                            data-toggle="tab"><i class="fa fa-th"></i> Edit
                                                                            Category</a>
                                                                    </li>

                                                                    <li class="nav-item">
                                                                        <a href="logout.php" class="nav-link"
                                                                            data-toggle="tab"><i class="ti-power-off"></i> Log
                                                                            Out</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade show active" id="edit-profile">
                                                                        <div class="set-title">
                                                                            <h5>Edit Profile</h5>
                                                                            <span>People on ResearchRemix will get to know you
                                                                                with the info below</span>
                                                                                <span style="color: red;"><b>Leave the Fields Unchange for not to
                                                                                    update the Data.</b></span><br>

                                                                        </div>
                                                                        <form method="post" enctype="multipart/form-data"
                                                                            class="c-form">
                                                                            <div class="setting-meta">

                                                                                <div class="change-photo">
                                                                                    <figure><img
                                                                                            src="<?= $userData['picture'] ?>"
                                                                                        style="height: 80px; " alt="">
                                                                                </figure>
                                                                                <div class="edit-img">
                                                                                    <div class="edit-phto">

                                                                                        <label class="fileContainer">
                                                                                            <i
                                                                                                class="fa fa-camera-retro"></i>
                                                                                            Change DP
                                                                                            <input id="dp" name="dp"
                                                                                                type="file">

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="setting-meta mt-2">
                                                                            <div class="change-photo">
                                                                                <figure><img src="<?= $userData['cover'] ?>"
                                                                                        style="width: 100px; height: 100px;"
                                                                                        alt=""></figure>
                                                                                <div class="edit-img">
                                                                                    <div class="edit-phto">

                                                                                        <label class="fileContainer">
                                                                                            <i
                                                                                                class="fa fa-camera-retro"></i>
                                                                                            Chage Profile Cover
                                                                                            <input id="cover" name="cover"
                                                                                                type="file">
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="stg-form-area">

                                                                            <div>
                                                                                <label>Display Name</label>
                                                                                <input type="text" id="name"
                                                                                    value="<?= $userData['first_name'] . " " . $userData['last_name'] ?>"
                                                                                    placeholder="<?= $userData['first_name'] . " " . $userData['last_name'] ?>">
                                                                            </div>

                                                                            <div class="uzer-nam">
                                                                                <label>User Name</label>
                                                                                <input type="text" id="username"
                                                                                    value="<?= $userData['username'] ?>"
                                                                                    placeholder="<?= $userData['username'] ?>">
                                                                            </div>
                                                                            <div>
                                                                                <label>Email Address</label>
                                                                                <input type="text" id="email"
                                                                                    value="<?= $userData['email'] ?>"
                                                                                    placeholder="<?= $userData['email'] ?>">
                                                                            </div>

                                                                            <div>
                                                                                <label>About your profile</label>
                                                                                <textarea rows="3" id="bio" class="bio"
                                                                                    placeholder="<?= $userData['bio'] ?>"><?= $userData['bio'] ?></textarea>
                                                                            </div>

                                                                            <div>
                                                                                <label>Education</label>
                                                                                <textarea rows="3" id="edu" class="edu"
                                                                                    name="edu"
                                                                                    placeholder="<?= $userData['edu'] ?>"><?= $userData['edu'] ?></textarea>
                                                                            </div>

                                                                            <div>
                                                                                <label>Other Interests</label>
                                                                                <textarea rows="3" id="other_ints"
                                                                                    class="other_ints" name="other_ints"
                                                                                    placeholder="<?= $userData['other_ints'] ?>"><?= $userData['other_ints'] ?></textarea>
                                                                            </div>

                                                                            <div>
                                                                                <label>Work Experience</label>
                                                                                <textarea rows="3" id="workexp"
                                                                                    class="workexp" name="workexp"
                                                                                    placeholder="<?= $userData['workexp'] ?>"><?= $userData['workexp'] ?></textarea>
                                                                            </div>

                                                                            <div>
                                                                                <?php
                                                                                $links = explode(',', $userData['social_links']);
                                                                                ?>
                                                                                <input type="hidden"
                                                                                    value="<?= $userData['oauth_uid'] ?>"
                                                                                    id="uid" name="uid">
                                                                                <h5>Social Links</h5>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <label>facebook</label>
                                                                                        <input type="text" id="fb" name="fb"
                                                                                            value="<?= $links[0] ?>"
                                                                                            placeholder="Facebook">

                                                                                        <label>instagram</label>
                                                                                        <input type="text" id="instagram"
                                                                                            name="instagram"
                                                                                            value="<?= $links[3] ?>"
                                                                                            placeholder="Instagram">
                                                                                    </div>

                                                                                    <div class="col-lg-6">
                                                                                        <label>twitter</label>
                                                                                        <input type="text" id="twitter"
                                                                                            name="twitter"
                                                                                            value="<?= $links[1] ?>"
                                                                                            placeholder="Twitter">

                                                                                        <label>Linkedin</label>
                                                                                        <input type="text" id="linkedin"
                                                                                            name="linkedin"
                                                                                            value="<?= $links[2] ?>"
                                                                                            placeholder="Linkedin">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="progress m-2">
                                                                                <div class="progress-bar" role="progressbar"
                                                                                    style="width:0%">0%</div>
                                                                            </div>


                                                                            
                                                                            <span>Details like Username, Name, DP, Profile
                                                                                Cover, User Bio and videos posted will be
                                                                                displayed to other users.</span>
                                                                            <div>
                                                                                <!-- <button type="submit"
                                                                                    data-ripple="">Cancel</button> -->
                                                                                <button onclick="uploadProfile()"
                                                                                    type="button">Update</button>
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                            </div><!-- edit profile -->

                                                            <div class="tab-pane fade" id="password">
                                                                <div class="set-title">
                                                                    <h5>Change Password</h5>
                                                                    <span>Change the password of your ResearchRemix
                                                                        Account</span>

                                                                </div>

                                                                <div class="stg-form-area">
                                                                    <form method="post" enctype="multipart/form-data"
                                                                        class="c-form">
                                                                        <input type="hidden"
                                                                            value="<?= $userData['oauth_uid'] ?>"
                                                                            id="oauth_id">

                                                                        <div>
                                                                            <label>Existing Password</label>
                                                                            <input id="oldpass" type="password"
                                                                                placeholder="Enter Existing Password">
                                                                        </div>

                                                                        <div class="uzer-nam">
                                                                            <label>New Password</label>
                                                                            <input type="password" id="newpass"
                                                                                placeholder="Enter New Password">
                                                                        </div>
                                                                        <div>
                                                                            <label>Re-Enter Password</label>
                                                                            <input type="password" id="renewpass"
                                                                                placeholder="Re-Enter Password">
                                                                        </div>

                                                                        <div>

                                                                            <button type="button"
                                                                                onclick="updatePassword()">Update
                                                                                Password</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div><!-- edit profile -->

                                                            <div class="tab-pane fade" id="category">
                                                                <div class="set-title">
                                                                    <h5>Edit Category </h5>
                                                                    <span>Change the User Selected Interest Category of
                                                                        your ResearchRemix
                                                                        Account</span>
                                                                </div>

                                                                <?php
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

                                                                // print_r($categories);
                                                            
                                                                ?>

                                                                <div class="stg-form-area">
                                                                    <form method="post" action="#" class="c-form">
                                                                        <div>
                                                                            <input type="hidden"
                                                                                value="<?= $userData['oauth_uid'] ?>"
                                                                                id="user_id" name="user_id">
                                                                            <label>Existing Category</label>
                                                                            <div style="display: flex;">
                                                                                <?php
                                                                                foreach ($categories as $category) {
                                                                                    echo '<p> &nbsp;' . $category . '&nbsp;</p>';
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="uzer-nam">
                                                                            <label>Update Category</label>

                                                                            <!-- a to z index -->
                                                                            <?php for ($i = ord('A'); $i <= ord('Z'); $i++): ?>
                                                                                <a href="#<?= chr($i) ?>"><?= chr($i) ?></a>
                                                                            <?php endfor; ?>

                                                                            <!-- fetching category from db -->
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
                                                                                                        name="categories"
                                                                                                        class="myCheckbox"
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
                                                                                                ?>
                                                                                                <li><input type="checkbox"
                                                                                                        id="filter-category<?= $row['id'] ?>"
                                                                                                        name="filter-category[]"
                                                                                                        value="<?= $row['category'] ?>"><label
                                                                                                        for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
                                                                                                </li>


                                                                                            <?php }
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </ul>

                                                                            </div>




                                                                        </div>


                                                                        <div>

                                                                            <button type="submit">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div><!-- edit profile -->

                                                            <!-- apps -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        <i><img style="height:20px;" src="content/logo.png" alt="researchremix"></i>
                    </div>
                </div>
            </div>
        </div><!-- bottom bar -->
        </div>


        <script src="js/main.min.js"></script>
        <script src="js/script.js"></script>

    </body>

    </html>
<?php } ?>