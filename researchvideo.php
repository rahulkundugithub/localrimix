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

$vd_id = $_GET['vd'];

$user_id = $userData['oauth_uid'];

//fetch user category from db 
$query = "SELECT * FROM user_category WHERE user_id='$user_id' ;";
$query_run = mysqli_query($conn, $query);
if ($query_run->num_rows > 0) {
    while ($row = $query_run->fetch_assoc()) {

        //exploding user category
        $user_categories = explode(',', $row['category_list']);
    }
}

$videoId = $_GET['vd'];

// Get the number of likes, shares, and comments for the video
$likes = 0;
$shares = 0;
$comments = array();
$result = $conn->query("SELECT COUNT(*) AS likes FROM likes WHERE video_id = '$videoId'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $likes = $row['likes'];
}
$result = $conn->query("SELECT COUNT(*) AS shares FROM shares WHERE video_id = '$videoId'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $shares = $row['shares'];
}
// $result = $conn->query("SELECT * FROM comments WHERE video_id = '$videoId'");
// if ($result->num_rows > 0) {
// 	while ($row = $result->fetch_assoc()) {
// 		$comments[] = array(
// 			'id' => $row['id'],
// 			'username' => $row['username'],
// 			'comment' => $row['comment']
// 		);
// 	}
// }

// Handle a new comment
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
// 	$username = $_POST['username'];
// 	$comment = $_POST['comment'];
// 	$conn->query("INSERT INTO comments (video_id, username, comment) VALUES ('$videoId', '$username', '$comment')");
// 	header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id . '&vd=' . $videoId);
// 	exit;
// }

// Handle a new like or share
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type === 'like') {
        $conn->query("INSERT INTO likes (video_id) VALUES ('$videoId')");
        echo "like done!";
        header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id . '&vd=' . $videoId);
    } else if ($type === 'share') {
        $conn->query("INSERT INTO shares (video_id) VALUES ('$videoId')");
        echo "comment done!";
        header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id . '&vd=' . $videoId);
    }
    // header('Location: /video.php?id=' . $videoId);
    exit;
}

// Process form submission

if (isset($_POST['comment'])) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;

    $sql = "INSERT INTO comments (parent_id, name, comment, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $parent_id, $name, $comment);
    mysqli_stmt_execute($stmt);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Research Video - ResearchRemix</title>
    <link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/video-player.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
        .related-tube-psts {
            max-height: 442px;
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

        <section>
            <div class="gap2" style="background: #d4deeb">
                <div class="container">
                    <div class="row" id="page-contents">
                        <div class="col-lg-8">

                            <!-- main video start -->

                            <?php
                            $sql = "SELECT * FROM videos WHERE vid_id='$vd_id' LIMIT 1";
                            $result = $conn->query($sql);


                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                                $categories = explode(',', $row['categories']);

                                //video html code
                            ?>

                                <div class="pittube-video">
                                    <div class="video-frame">
                                        <video id="my_video_1" class="video-js vjs-default-skin" controls preload="none" height="370" data-setup="{}" style="object-fit:cover;" poster="<?= $row['thumbnail_path'] ?>">
                                            <source src="<?= $row['vid_path'] ?>" type="video/mp4" />
                                            <source src="<?= $row['vid_path'] ?>" type="video/webm" />
                                        </video>

                                        <ul class="pit-opt">
                                            <li>
                                                <div title="Like/Dislike" onclick="like(<?= $videoId ?>)" class="likes heart">❤ <span>
                                                        <?php echo $likes ?>
                                                    </span></div>
                                            </li>

                                            <li title="Report" class="bad-report" onclick="window.location.href='contact.php?id=<?= $id ?>&vd=<?= $videoId ?>'">
                                                <a herf=""><i class="fa fa-flag"></i></a>
                                            </li>

                                            <li title="Shares" onclick="copyTextToClipboard('<?= $url ?>')" class="share-pstt"><i class="fa fa-share-alt"></i></li>


                                            </li>
                                        </ul>
                                        <span class="uploadtime"><i class="fa fa-upload"></i>
                                            <?= time_elapsed_string($row['date']) ?>
                                        </span>
                                        <h4>
                                            <?= $row['title'] ?>
                                        </h4>
                                    </div>
                                    <div class="chanel-avatar">
                                        <figure><a href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>" title="<?= $row['channel_name'] ?>"><img style="width: 80px; height:100%;" src="<?= $row['channel_img'] ?>" alt="<?= $row['channel_name'] ?>"></a>
                                        </figure>
                                        <div class="channl-author">
                                            <h5><a href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>" title="">
                                                    <?= $row['channel_name'] ?>
                                                </a></h5>
                                            <?php $channel_username = $row['username']; ?>
                                            <span>
                                                <?= $row['username'] ?>
                                            </span>
                                            <!-- <em>3.2M followers</em> -->
                                        </div>
                                    </div>
                                    <div class="addnsend">
                                        <a class="" href="mailto:<?= $row['email'] ?>" title="" data-ripple=""><i class="fa fa-envelope-o"></i>Send Message</a>
                                        <style>
                                            .coming-soon::before {
                                                content: 'coming soon';
                                                background: #ffd578c4;
                                                position: absolute;
                                                rotate: -20deg;
                                                top: 0;
                                                padding: 0px 5px;
                                                border-radius: 2px;
                                                left: -15px;
                                                box-shadow: 4px 7px 12px 0 rgb(250 99 66 / 20%);


                                            }

                                            .reply {
                                                padding-left: 30px;
                                            }

                                            a.disabled {
                                                pointer-events: none;
                                                cursor: default;
                                            }
                                        </style>

                                        <?php
                                        //subscribe or unsubscribe button
                                        $user_iid = $userData['username'];

                                        // check if the user has already subscribed to the channel
                                        $sql = "SELECT * FROM subscribe WHERE user_id = '$user_iid' AND channel_username = '$channel_username'";
                                        $result = mysqli_query($conn, $sql);

                                        if ($loginPOP == true)
                                            $disable = 'disabled';
                                        else
                                            $disable = '';

                                        if (mysqli_num_rows($result) > 0) {
                                            // user has already subscribed, so show unsubscribe button

                                            // set the HTML button text to 'Subscribe'
                                            echo "<a class='main-btn " . $disable . "' href='subscribe.php?channel_username=$channel_username&link=$url' style='background:#888da8;' >Unsubscribe</a>";
                                        } else {
                                            // user has not subscribed yet, so subscribe them

                                            // set the HTML button text to 'Unsubscribe'
                                            echo "<a class='main-btn " . $disable . "' href='subscribe.php?channel_username=$channel_username&link=$url'>Subscribe</a>";
                                        }
                                        ?>
                                        <!-- <a class="main-btn coming-soon" href="#" title="" data-ripple="">Subscribe</a> -->

                                    </div>

                                </div>

                            <?php
                            }
                            ?>

                            <!-- main Video end -->

                        </div>
                        <div class="col-lg-4">
                            <div class="central-meta">
                                <span class="create-post">Related Videos</span>
                                <div class="related-tube-psts">
                                    <?php
                                    $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[0]%' OR categories LIKE '%$categories[1]%' OR categories LIKE '%$categories[2]%' OR categories LIKE '%$categories[3]%' ORDER BY date DESC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>

                                            <div class="rlted-video">
                                                <figure><img src="<?= $row['thumbnail_path'] ?>" style="object-fit: cover; height:90px; width:130px; " alt="<?= $row['title'] ?>"></figure>
                                                <div class="tube-pst-meta">
                                                    <h5><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title="">
                                                            <?= $row['title'] ?>
                                                        </a></h5>
                                                    <span>
                                                        <?= time_elapsed_string($row['date']) ?>
                                                    </span>
                                                    <div class="user-fig">
                                                        <img src="<?= $row['channel_img'] ?>" style="object-fit: cover; height:20px; width:20px; " alt="<?= $row['channel_name'] ?>">
                                                        <a href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>" title="<?= $row['channel_name'] ?>"><?= $row['channel_name'] ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="gap2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="central-meta">
                                <?php
                                $sql = "SELECT * FROM videos WHERE vid_id='$vd_id' LIMIT 1";
                                $result = $conn->query($sql);


                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc(); ?>

                                    <div class="create-post">
                                        <div class="user-fig">
                                            <img style="height:; width:;" src="<?= $row['channel_img'] ?>" alt="<?= $row['channel_name'] ?>">
                                            <a href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>" title="<?= $row['channel_name'] ?>"><?= $row['channel_name'] ?></a>
                                        </div>
                                    </div>
                                    <div class="about-video">
                                        <h6>Description</h6>
                                        <div>
                                            <input type="checkbox" class="read-more-state" id="post-1" />
                                            <p class="read-more-wrap">
                                                <?= $row['descrip'] ?></span>
                                            </p>
                                            <!-- <label for="post-1" class="read-more-trigger"></label> -->
                                        </div>
                                    </div>

                                <?php }
                                ?>


                                <h6 class="comet-title"><i class="fa fa-comments"></i> Comments</h6>
                                <div class="coment-area" style="display: block">

                                    <ul class="we-comet">

                                        <style>
                                            .reply {
                                                /* display: none; */
                                                /* overflow: hidden; */
                                            }
                                        </style>

                                        <?php

                                        // Get comments
                                        $sql = "SELECT * FROM comments WHERE parent_id IS NULL ORDER BY created_at DESC";
                                        $result = mysqli_query($conn, $sql);

                                        // Display comments
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<li>
											<div class="comet-avatar">
												<img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png"
													alt="">
											</div>
											<div class="we-comment">';
                                            echo '<h5><a href="research-channel.php?id=' . $id . '&chnl=' . $row['name'] . '">' . $row['name'] . '</a></h5>';
                                            echo '<p>' . $row['comment'] . '</p>';
                                            echo '<div class="inline-itms">
											<span>' . time_elapsed_string($row['created_at']) . '</span>
											<a class="we-reply" id="replybutton" title="Reply"><i
													class="fa fa-reply"></i></a>
											</div>
											</div>
											</li>';

                                            // Display replies
                                            $sql2 = "SELECT * FROM comments WHERE parent_id=" . $row['id'] . " ORDER BY created_at DESC";
                                            $result2 = mysqli_query($conn, $sql2);

                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                echo '<li id="reply" class="reply" style="display: none;" >
											<div class="comet-avatar">
												<img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png"
													alt="">
											</div>
											<div class="we-comment">';
                                                echo '<h5><a href="research-channel.php?id=' . $id . '&chnl=' . $row['name'] . '">' . $row['name'] . '</a></h5>';
                                                echo '<p>' . $row['comment'] . '</p>';
                                                echo '<div class="inline-itms">
											<span>' . time_elapsed_string($row['created_at']) . '</span>
											<a class="we-reply" id="replybutton" title="Reply"><i
													class="fa fa-reply"></i></a>
											</div>
											</div>
											</li>';
                                            }

                                            // Add reply form
                                            echo '<li id="reply" class="post-comment reply">
											<div class="comet-avatar">
												<img src="' . $userData['picture'] . '" alt="">
											</div>
											<div class="post-comt-box">
												<form method="post">
													<input type="hidden" value="' . $userData['username'] . '"
														name="name">';
                                            echo '<textarea name="comment" placeholder="Post your comment" required></textarea>';
                                            echo '<button style="z-index: 1; background :#fa6342;" type="submit">Submit</button>';
                                            echo '</form>
												</div>
											</li>';
                                        }

                                        // Add comment form
                                        echo '<li class="post-comment">
										<div class="comet-avatar">
											<img src="' . $userData['picture'] . '" alt="">
										</div>
										<div class="post-comt-box">
											<form method="post">
												<input type="hidden" value="' . $userData['username'] . '"
													name="name">';
                                        echo '<textarea name="comment" placeholder="Post your comment" required></textarea>';
                                        echo '<button style="z-index: 1; background :#fa6342;"
										type="submit">Submit</button>';
                                        echo '</form>
											</div>
										</li>';

                                        ?>


                                        <!-- main comments -->
                                        <!-- <li>
                                            <div class="comet-avatar">
                                                <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png"
                                                    alt="">
                                            </div>
                                            <div class="we-comment">
                                                <h5><a href="time-line.html" title="">Sophia</a></h5>
                                                <p>we are working for the dance and sing songs. this video is very
                                                    awesome for the youngster.
                                                    <i class="em em-smiley"></i>
                                                </p>
                                                <div class="inline-itms">
                                                    <span>1 year ago</span>
                                                    <a class="we-reply" href="#" title="Reply"><i
                                                            class="fa fa-reply"></i></a>
                                                </div>
                                            </div>
                                        </li> -->

                                        <!-- <li class="post-comment">
                                            <div class="comet-avatar">
                                                <img src="<?= $userData['picture'] ?>" alt="">
                                            </div>
                                            <div class="post-comt-box">
                                                <form method="post">
                                                    <input type="hidden" value="<?= $userData['username'] ?>"
                                                        name="username">
                                                    <textarea placeholder="Post your comment"></textarea>
                                                    <button style="z-index: 9999; background :#fa6342;"
                                                        type="submit"></button>
                                                </form>
                                            </div>
                                        </li> -->
                                    </ul>



                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="central-meta">
                                <span class="create-post">More Videos</span>
                                <div class="more-tube-psts">
                                    <?php
                                    $sql = "SELECT * FROM videos WHERE categories LIKE '%$categories[0]%' OR categories LIKE '%$categories[1]%' OR categories LIKE '%$categories[2]%' OR categories LIKE '%$categories[3]%' ORDER BY date DESC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>

                                            <div class="rlted-video">
                                                <figure><img src="<?= $row['thumbnail_path'] ?>" style="object-fit: cover; height:90px; width:130px; " alt="<?= $row['title'] ?>"></figure>
                                                <div class="tube-pst-meta">
                                                    <h5><a href="researchvideo.php?id=<?= $id ?>&vd=<?= $row['vid_id'] ?>" title=""><?= $row['title'] ?></a>
                                                    </h5>
                                                    <span>
                                                        <?= time_elapsed_string($row['date']) ?>
                                                    </span>
                                                    <div class="user-fig">
                                                        <img src="<?= $row['channel_img'] ?>" style="object-fit: cover; height:20px; width:20px; " alt="<?= $row['channel_name'] ?>">
                                                        <a href="research-channel.php?id=<?= $id ?>&chnl=<?= $row['user_id'] ?>" title="<?= $row['channel_name'] ?>"><?= $row['channel_name'] ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php }
                                    } ?>

                                </div>
                            </div>

                            <div class="auto-load">
                                <div class="wave">
                                    <a href="research.php" style="color: #fa6342;" title="Research Videos" class="showmore underline"><b><i class="ti-arrow-left"></i>&nbsp; Back To
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
                        <i><img style="height:20px;" src="content/logo.png" alt="researchremix"></i>
                    </div>
                </div>
            </div>
        </div><!-- bottom bar -->
    </div>

    <!-- JavaScript for sending requests to the server when the buttons are clicked -->
    <script>
        function like(videoId) {
            fetch('/like.php?id=' + videoId + '&type=like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'like',
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok.');
                    }
                })
                .then(json => {
                    console.log(json);
                    // Do something with the response JSON, if needed.
                    window.location.reload();
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }


        function copyTextToClipboard(text) {
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.type = 'text';
            tempInput.value = text;
            document.body.appendChild(tempInput);

            // Select the text
            tempInput.select();

            // Copy the text to the clipboard
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Create a message element
            const message = document.createElement('div');
            message.textContent = 'Link Copied';
            message.style.zIndex = '9999';
            message.style.position = 'fixed';
            message.style.top = '50%';
            message.style.left = '50%';
            message.style.transform = 'translate(-50%, -50%)';
            message.style.backgroundColor = '#333';
            message.style.color = '#fff';
            message.style.padding = '10px';
            message.style.borderRadius = '5px';
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.3s ease-out';
            document.body.appendChild(message);

            // Fade in the message
            setTimeout(() => {
                message.style.opacity = '1';
            }, 100);

            // Fade out the message
            setTimeout(() => {
                message.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(message);
                }, 300);
            }, 2000);
        }
    </script>

    <!-- script for toggle div -->
    <script type="text/javascript">
        function toggleDiv(divId) {
            var div = document.getElementById(divId);
            if (div.style.display === 'none') {
                div.style.display = 'block';
            } else {
                div.style.display = 'none';
            }
        }
    </script>

    <script>
        // Select the replybutton element by ID
        var replyButton = document.getElementById("replybutton");

        // Add a click event listener to the replybutton element
        replyButton.addEventListener("click", function() {
            var panel = document.getElementById("reply");

            // Toggle the display of the panel element
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    </script>


    <script src="js/main.min.js"></script>
    <script src="js/video-player.js"></script>
    <script src="js/script.js"></script>

</body>

</html>