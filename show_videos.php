<?php
require_once 'config.php';
$pid = $_GET['pid'];
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
?>



<!-- ............................... -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Upload - ResearchRemix</title>
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

    <!-- style="max-width:1500px !important" -->
        <div class="container" style="max-width:1500px !important">
            <div class="row">
                <div class="col-lg-12">
                    <div class="central-meta">
                        <?php
                        $sql = "SELECT COUNT(vid_id) FROM videos WHERE parent_category_id=" . $pid ." and tags is not NULL";
                        $result = mysqli_query($conn, $sql);
                        $arr = mysqli_fetch_assoc($result);

                        switch($pid){
                            case 1:
                echo '<div style="position:relative;">
                    <div>
                    <img src="content/research_paper_videos_1.jpg" alt="Research Paper Videos" style="height:285px;object-fit:contain;">
                    </div>
                    <div style="position:absolute;top:130px;left: 140px;">
                            <p><h2 style="color:brown;">Research Paper Videos</h2></p>
                    </div>
                    <div style="position:absolute;top:180px;left: 140px;">
                            <p><h4 style="color:brown;">'.$arr['COUNT(vid_id)'].' videos</h4></p>
                    </div>
                </div>';
                break;
                case 2:
                    echo '<div style="position:relative;">
                        <div>
                        <img src="content/conference_talk_2.jpg" alt="Conference Talks" style="height:285px;object-fit:contain;">
                        </div>
                        <div style="position:absolute;top:130px;left: 140px;">
                                <p><h2 style="color:brown;">Conference Talks</h2></p>
                        </div>
                        <div style="position:absolute;top:180px;left: 140px;">
                                <p><h4 style="color:brown;">'.$arr['COUNT(vid_id)'].' videos</h4></p>
                        </div>
                    </div>';
                    break;
                    case 3:
                        echo '<div style="position:relative;">
                            <div>
                            <img src="content/tutorials_and_lectures_3.jpg" alt="Tutorials and Lectures" style="height:285px;object-fit:contain;">
                            </div>
                            <div style="position:absolute;top:130px;left: 140px;">
                                    <p><h2 style="color:brown;">Tutorials and Lectures</h2></p>
                            </div>
                            <div style="position:absolute;top:180px;left: 140px;">
                                    <p><h4 style="color:brown;">'.$arr['COUNT(vid_id)'].' videos</h4></p>
                            </div>
                        </div>';
                        break;
                        case 4:
                            echo '<div style="position:relative;">
                                <div>
                                <img src="content/laboratory_experiments_4.jpg" alt="Laboratory Experiments" style="height:285px;object-fit:contain;">
                                </div>
                                <div style="position:absolute;top:130px;left: 140px;">
                                        <p><h2 style="color:brown;">Laboratory Experiments</h2></p>
                                </div>
                                <div style="position:absolute;top:180px;left: 140px;">
                                        <p><h4 style="color:brown;">'.$arr['COUNT(vid_id)'].' videos</h4></p>
                                </div>
                            </div>';
                            break;
                            case 5:
                                echo '<div style="position:relative;">
                                    <div>
                                    <img src="content/fun_science_5.jpg" alt="Fun Science" style="height:285px;object-fit:contain;">
                                    </div>
                                    <div style="position:absolute;top:130px;left: 140px;">
                                            <p><h2 style="color:brown;">Fun Science</h2></p>
                                    </div>
                                    <div style="position:absolute;top:180px;left: 140px;">
                                            <p><h4 style="color:brown;">'.$arr['COUNT(vid_id)'].' videos</h4></p>
                                    </div>
                                </div>';
                                break;
                            case 6:
                                    echo '<div style="position:relative;">
                                        <div>
                                        <img src="content/publication_6.jpg" alt="Publication" style="height:285px;object-fit:contain;">
                                        </div>
                                        <div style="position:absolute;top:130px;left: 140px;">
                                                <p><h2 style="color:brown;">Publication</h2></p>
                                        </div>
                                        <div style="position:absolute;top:180px;left: 140px;">
                                                <p><h4 style="color:brown;">'.$arr['COUNT(vid_id)'].' videos</h4></p>
                                        </div>
                                    </div>';
                                    break;
                default:
                break;
                        } ?>     
                        
<br>
                        <!-- RK1 -->
                        <div class="input-group" style="width:50%;margin:auto;">
                                            <input type="search" class="form-control rounded" placeholder="Filter videos by tags" aria-label="Search" aria-describedby="search-addon" id="tagbox" />
                                            <button type="button" class="btn btn-outline-primary" id="tagbtn" onclick="filter()">filter</button>
                                            <br><br>
                        </div>
                        <!-- RK1 -->

                        <div class="" style="text-align: center;">
                        <br>
                            <?php
                            echo "<a class='main-btn' href='show_videos.php?id=".$id."&pid=".$pid."'>Load all videos</a>";
                            ?>
                                            </div><br>


                        <div class="row merged20 remove-ext" id="tube-parent" style="overflow:auto;">
                            <?php
                            $sql = "SELECT * FROM videos WHERE parent_category_id=" . $pid ." and tags is not NULL";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                while ($arr = mysqli_fetch_assoc($result)) {

                            ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6" id="tube-parent">
                                        <div class="tube-post">
                                            <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $arr['vid_id'] ?>" title="">
                                                <figure>
                                                    <img src="<?= $arr['thumbnail_path'] ?>" style=" object-fit: cover; width:252px; height:154px; " alt="<?= $arr['title'] ?>">
                                                </figure>
                                                <div class="tube-title">
                                                    <h6>
                                                        <?= $arr['title'] ?>
                                            </a></h6>
                                            <div class="user-fig">
                                                <img alt="<?= $arr['channel_name'] ?>" src="<?= $arr['channel_img'] ?>">
                                                <a title="<?= $arr['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $arr['username'] ?>"><?= $arr['channel_name'] ?></a>
                                            </div>
                                            <span class="upload-time">
                                                <?php echo time_elapsed_string($arr['date']); ?>
                                            </span>
                                        </div>
                                    </div>
                        </div>

                <?php
                                }
                            } else {
                                echo "<div><h1>No video available!!</h1></div>";
                            }

                ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="auto-load">
        <div class="wave">
            <a href="research.php?id=<?= $id ?>" style="color: #fa6342;" title="Research Videos" class="showmore underline"><b><i class="ti-arrow-left"></i>&nbsp; Back To
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
</div>
<script src="https://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
</script>


<script src="js/main.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript">
    function filter() {
        
        // if($('input[class="myCheckbox"]:checked').length > 0)
        // {
            var parentid = <?php echo $pid; ?>;
            var id = "<?php echo $id; ?>";
            var formdata = new FormData();
            formdata.append('item', $('#tagbox').val());

            // $('.myCheckbox:checked').each(function() {
            //     formdata.append('categoriesid[]', $(this).attr('id'));
                
            // });
            formdata.append('pid', parentid);
            formdata.append('id', id);
            $.ajax({
                url: 'show_subcategory_videos.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                
                success: function(response) {
                        $('#tube-parent').html(response);

                    //alert(response);
                    // if (response == 'success') {
                    //     alert('Video uploaded successfully!');
                    //     $('#tube-parent').html(response);
                    // } else {
                    //     alert(response);
                    // }
                },
                error: function (response) {
                    $('#error').html(response);
                }
                
            });
        // }
        // else
        // {
        //     alert("Need to select sub-category!!");
        // }



    }
</script>

</body>

</html>