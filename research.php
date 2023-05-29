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

// Check if user is logged in
// if(!isset($_SESSION["userData"]) || $_SESSION["userData"] !== true){
//     header("location: login.php");
//     exit;
// }

if (empty($_SESSION['form_status'])) {
    header("location: login.php");
    exit;
}

// if (isset($_SESSION['oauth_status']) && $_SESSION['oauth_status'] != 'verified' && empty($_SESSION['userData'])) {
// 	header("location: login.php");
// 	exit;
// }

?>

<?php include('time_ago.php'); ?>

<!-- rediecting -->



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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function uploadVideo() {
            var formdata = new FormData();
            formdata.append('title', $('#title').val());
            formdata.append('description', $('#description').val());
            formdata.append('channel_name', $('#channel_name').val());
            formdata.append('channel_img', $('#channel_img').val());
            formdata.append('username', $('#username').val());
            formdata.append('user_id', $('#user_id').val());
            formdata.append('video', $('#video')[0].files[0]);
            formdata.append('thumbnail', $('#thumbnail')[0].files[0]);
            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress-bar').width(percentComplete + '%');
                            $('.progress-bar').html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    if (response == 'success') {
                        alert('Video uploaded successfully!');
                        $('#title').val('');
                        $('#description').val('');
                        $('#video').val('');
                        $('#thumbnail').val('');
                        $('.preview-thumbnail').attr('src', '');
                        $('.progress-bar').width('0%');
                        $('.progress-bar').html('0%');
                    } else {
                        alert(response);
                    }
                }
            });
        }

        function previewThumbnail(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.preview-thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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

        <!-- header	 -->

        <?php require('menu.php'); ?>

        <!-- header end -->

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
        <!-- category redirecting -->
        <section>
            <div style="display: flex;
  justify-content: center;">
                <?php
                    $queryy="SELECT id,parent_category FROM parent_category";
                    $result=mysqli_query($conn,$queryy);
                    while($arr=mysqli_fetch_assoc($result))
                    {
                        // echo $arr['parent_category'];
                        echo "<a class='main-btn' href='show_videos.php?id=".$id."&pid=".$arr["id"]."'>".$arr["parent_category"]."</a>";

                    }


                ?>
            </div>
        </section>

        

        <section>
            <div class="gap2 no-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row merged20" id="page-contents">
                                <!-- page-content id used for static widget parent -->
                                <div class="col-lg-12">
                                    <div class="tube-featurd-area">
                                        <div class="row merged-4px">

                                            <!-- // Video one -->

                                            <?php
                                            // $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[0]%' ORDER BY date DESC LIMIT 1";
                                            $sql="SELECT * FROM videos where tags is not null ORDER BY tags DESC LIMIT 1"; //r1
                                            $result = $conn->query($sql);

                                            $id_to_exclude;

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                //video html code
                                                $id_to_exclude = $row['vid_id'];
                                            ?>

                                                <div class="col-lg-6 col-md-6">
                                                    <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                        <figure class="featured-tube">
                                                            <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; height:429px; width:568px;" alt="<?= $row['title'] ?>">
                                                            <div class="feature-title">
                                                                <h2>
                                                                    <?= $row['title'] ?>
                                                    </a></h2>
                                                    <div class="user-fig">
                                                        <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>" style="width: 45px;">
                                                        <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>">
                                                            <?= $row['channel_name'] ?>
                                                        </a>
                                                    </div>
                                                    <span class="upload-time">
                                                        <?php echo time_elapsed_string($row['date']); ?>
                                                    </span>
                                                </div>
                                                </figure>
                                        </div>


                                    <?php
                                            }


                                            // fetching 2 category based video
                                            $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[1]%' AND vid_id !='$id_to_exclude' ORDER BY date DESC LIMIT 1";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                //video html code

                                                $id_to_exclude = $row['vid_id'];
                                    ?>



                                        <div class="col-lg-6 col-md-6">
                                            <div class="row merged-4px">
                                                <div class="col-lg-12 col-md-12">
                                                    <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                        <figure class="featured-tube">
                                                            <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; width:568px; height:213px;" alt="<?= $row['title'] ?>">
                                                            <div class="feature-title">
                                                                <h4><?= $row['title'] ?>
                                                    </a>
                                                    </h4>
                                                    <div class="user-fig">
                                                        <img alt="<?= $row['channel_name'] ?>" style="width: 45px;" src="<?= $row['channel_img'] ?>">
                                                        <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
                                                    </div>
                                                    <span class="upload-time">
                                                        <?php echo time_elapsed_string($row['date']); ?>
                                                    </span>
                                                </div>
                                                </figure>
                                            </div>

                                        <?php
                                            }


                                            // fetching 3 category based video
                                            $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[2]%' AND vid_id !='$id_to_exclude' ORDER BY date DESC LIMIT 1";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                //video html code
                                                $id_to_exclude = $row['vid_id'];

                                        ?>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                    <figure class="featured-tube">
                                                        <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; width:100%; height:201px;" alt="<?= $row['title'] ?>">
                                                        <div class="feature-title">
                                                            <h6><?= $row['title'] ?>
                                                </a></h6>
                                                <div class="user-fig">
                                                    <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                    <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
                                                </div>
                                                <span class="upload-time">
                                                    <?php echo time_elapsed_string($raw['date']); ?>
                                                </span>
                                            </div>
                                            </figure>
                                        </div>


                                    <?php
                                            }


                                            // fetching 2 category based video
                                            $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[3]%' AND vid_id !='$id_to_exclude' ORDER BY date DESC LIMIT 1";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                //video html code


                                    ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                <figure class="featured-tube">
                                                    <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; width:100%; height:201px;" alt="<?= $row['title'] ?>">
                                                    <div class="feature-title">
                                                        <h6><?= $row['title'] ?>
                                            </a>
                                            </h6>
                                            <div class="user-fig">
                                                <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
                                            </div>
                                            <span class="upload-time">
                                                <?php echo time_elapsed_string($row['date']); ?>
                                            </span>
                                        </div>
                                        </figure>
                                    </div>

                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- tube featured area -->
                </div>
                <div class="col-lg-12">
                    <div class="gap2">
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </div>
    </section><!-- feature content and nav -->


    <!-- Research Videos -->


    <section>
        <div class="gap2 no-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="central-meta">
                            <span class="create-post">Research Videos <a title="" href="videoall.php?id=<?= $id ?>&page=research">See All Videos</a></span>
                            <div class="row merged20 remove-ext">
                                <?php
                                // fetching research videos on the user category
                                $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[0]%' OR categories LIKE '%$categories[1]%' OR categories LIKE '%$categories[2]%' OR categories LIKE '%$categories[3]%' ORDER BY date DESC LIMIT 8";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>

                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="tube-post">
                                                <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="">
                                                    <figure>
                                                        <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; height:154px; width: 100%;" alt="<?= $row['title'] ?>">
                                                    </figure>
                                                </a>
                                                <div class="tube-title">
                                                    <h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title=""><?= $row['title'] ?></a></h6>
                                                    <div class="user-fig">
                                                        <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                        <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
                                                    </div>
                                                    <span class="upload-time"><?= time_elapsed_string($row['date']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- <div class="auto-load">
								<div class="wave">
									<span class="dot"></span>
									<span class="dot"></span>
									<span class="dot"></span>
								</div>
							</div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newest Upload Section -->


    <section>
        <div class="gap2 no-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="central-meta no-margin">
                            <span class="create-post">Newest Uploaded <a title="" href="videoall.php?page=newest">See All Videos</a></span>
                            <div class="row merged20 remove-ext">
                                <?php

                                // fetching Lates uploades videos
                                $sql = "SELECT * FROM videos ORDER BY date DESC LIMIT 4";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>

                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="tube-post">
                                                <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                    <figure>
                                                        <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; height:154px; width: 100%; " alt="<?= $row['title'] ?>">
                                                    </figure>
                                                </a>
                                                <div class="tube-title">
                                                    <h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
                                                    <div class="user-fig">
                                                        <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                        <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
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
                                ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- tube posts -->

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


                                            <li><button href="#random" class="accordion"><i class="fa fa-clone"></i>
                                                    Filter
                                                    Category</button>
                                                <div class="panel">
                                                    <form method="post" action="">
                                                        <?php for ($i = ord('A'); $i <= ord('Z'); $i++) : ?>
                                                            <a href="#<?= chr($i) ?>"><?= chr($i) ?></a>
                                                        <?php endfor; ?>

                                                        <button title="Filter based on selected categories" style="float: right;" name="filter" class="main-btn">Filter</button>

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
                                                                                <input type="checkbox" id="filter-category<?= $row['id'] ?>" name="filter-category[]" value="<?= $row['category'] ?>"><label for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
                                            </li>

                                        <?php }
                                                                        }

                                                                        //if 1st a is already found then this code will be printed
                                                                        // Output the data
                                                                        // echo $data;

                                                                        if ($found_letters[$letter] = true && $row['category'] == $id_word) {
                                                                            continue;
                                                                        } else {
                                        ?><li><input type="checkbox" id="filter-category<?= $row['id'] ?>" name="filter-category[]" value="<?= $row['category'] ?>"><label for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
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


                                    <li><a title="Upload Research Video" href="researchvideoupload.php?id=<?= $id ?>" class="main-btn">Upload Video</a></li>
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

    <section>
        <div class="gap2 no-top">
            <div class="container" id="random">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="central-meta">
                            <span class="create-post">Random Videos <a title="" href="videoall.php?page=random">See
                                    All Videos</a></span>
                            <div class="row merged20 remove-ext">
                                <?php
                                if (isset($_POST['filter'])) {
                                    $categories = $_POST['filter-category'];
                                    if (!empty($categories)) {

                                        //start
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
                                                        <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                            <figure>
                                                                <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; height:154px;  width: 100%; " alt="<?= $row['title'] ?>">
                                                            </figure>
                                                        </a>
                                                        <div class="tube-title">
                                                            <h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
                                                            <div class="user-fig">
                                                                <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                                <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
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
                                                    <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                        <figure>
                                                            <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; height:154px;  width: 100%; " alt="<?= $row['title'] ?>">
                                                        </figure>
                                                    </a>
                                                    <div class="tube-title">
                                                        <h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
                                                        <div class="user-fig">
                                                            <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                            <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
                                                        </div>
                                                        <span class="upload-time">
                                                            <?php echo time_elapsed_string($row['date']); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }
                                    } else {
                                        $isFiltered = True;
                                        echo '<h6 class="p-3">No Category Selected! Please select a Category to filter</h6  >';
                                    }
                                    //end filter
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
                                                    <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>">
                                                        <figure>
                                                            <img src="<?= $row['thumbnail_path'] ?>" style=" object-fit: cover; height:154px;  width: 100%; " alt="<?= $row['title'] ?>">
                                                        </figure>
                                                    </a>
                                                    <div class="tube-title">
                                                        <h6><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="<?= $row['title'] ?>"><?= $row['title'] ?></a></h6>
                                                        <div class="user-fig">
                                                            <img alt="<?= $row['channel_name'] ?>" src="<?= $row['channel_img'] ?>">
                                                            <a title="<?= $row['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>"><?= $row['channel_name'] ?></a>
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
                                ?>




                            </div>
                        </div>
                        <!-- <div class="auto-load">
                            <div class="wave">
                                <a href="research.php?id=<?= $id ?>" style="color: #fa6342;" title="Research Videos"
                                    class="showmore underline"><b> Show More &nbsp;<i
                                            class="ti-arrow-right"></i></b></a>
                            </div>
                        </div> -->
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


    <div class="popup-wraper1">
        <div class="popup direct-mesg" style="width: 90vw;">
            <span class="popup-closed"><i class="ti-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Upload Video</h5>
                </div>
                <div class="send-message">

                    <!-- upload form -->

                    <form method="post" enctype="multipart/form-data">
                        <div class="">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="">
                            <label for="description">Description:</label>
                            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                        </div>
                        <div class="">
                            <label for="video" style="margin-top: 0px;">Video:</label>
                            <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
                        </div>
                        <div class="">
                            <label for="thumbnail">Thumbnail:</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(this);" required>
                            <img class="preview-thumbnail" style="max-width: 60px; margin-top: 10px;" />
                        </div>
                        <div class="">
                            <input type="hidden" id="channel_name" name="channel_name" value="<?= $userData['first_name'] . " " . $userData['last_name'] ?>">
                            <input type="hidden" id="channel_img" name="channel_img" value="<?= $userData['picture'] ?>">
                            <input type="hidden" id="username" name="username" value="<?= $userData['username'] ?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?= $userData['oauth_uid'] ?>">
                            <div class="progress m-2">
                                <div class="progress-bar" role="progressbar" style="width:0%">0%</div>
                            </div>
                        </div>
                        <button type="button" class="main-btn" onclick="uploadVideo()">Upload</button>




                        <div class="">
                            <label for="title">Selet Category:</label>

                            <div style="width: 100%;
                                            height: calc(29.5em + 0.75rem + 2px);
                                            padding: 0.375rem 0.75rem; border: 1px solid #ced4da;
                                            border-radius: 0.25rem;
                                            transition: border-color .15s ease-in-out,
                                            box-shadow .15s ease-in-out; 
                                            overflow: auto; z-index: 999999;">
                                <div style="width: 800px; height: 800px;">
                                    <!-- Add your content here -->

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
                                                            <input type="checkbox" id="filter-category<?= $row['id'] ?>" name="filter-category[]" value="<?= $row['category'] ?>"><label for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
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
                                                        <li><input type="checkbox" id="filter-category<?= $row['id'] ?>" name="filter-category[]" value="<?= $row['category'] ?>"><label for="filter-category<?= $row['id'] ?>"><?= $row['category'] ?></label>
                                                        </li>


                                            <?php }
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>


                </form>




                <!-- upload form -->


            </div>
        </div>
    </div>
    </div><!-- send message popup -->

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

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>

    <script src="js/main.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>