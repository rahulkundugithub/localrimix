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

if (empty($_SESSION['form_status'])) {
    header("location: login.php");
    exit;
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


    $sql = "INSERT INTO admin_contact SET email = '" . $email . "' , subject = '" . $oauth_uid . "', message = '" . $Fname . "'";
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
    <title>Upload - ResearchRemix</title>
    <link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <style>
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

            var description = $('.nicEdit-main').html();

            var formdata = new FormData();
            formdata.append('title', $('#title').val());
            //formdata.append('description',$('#description').val());
            formdata.append('description', description);
            // alert($('#description').val());
            formdata.append('channel_name', $('#channel_name').val());
            formdata.append('channel_img', $('#channel_img').val());
            formdata.append('username', $('#username').val());
            formdata.append('user_id', $('#user_id').val());
            formdata.append('pcat_id', $('#parentcategory option:selected').attr('id'));
            formdata.append('pcat_val', $('#parentcategory option:selected').val());
            $('.myCheckbox:checked').each(function() {
                formdata.append($(this).attr('name'), $(this).val());
                formdata.append('categoriesid[]', $(this).attr('id'));
            });
            $('.myCheckbox_tag:checked').each(function() {
                formdata.append($(this).attr('name'), $(this).val());//tags[]
                formdata.append('tagid[]', $(this).attr('id'));
            });


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
                   // alert(response);
                    if (response == 'success') {
                        alert(response);
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

        function search() {
            //alert($('#tagbox').val());
            var formdata = new FormData();
            formdata.append('item', $('#tagbox').val());
            $('.myCheckbox:checked').each(function() {
                // formdata.append($(this).attr('name'), $(this).val());
                formdata.append('categoriesid[]', $(this).attr('id'));
                //alert(formdata.getAll('categoriesid[]'));
            });
            $.ajax({ //is being used to send data to load_tag.php page and to fetch result from that page
                url: 'load_tag.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(result) {
                    //alert(result);
                    $('#tag').html(result);
                    if (result == 'success') {
                        alert('Successfully!');
                    } else {
                        alert(response);
                    }
                }

            });
        }
        $(document).ready(function() {
            $("#togbtn").click(function() {
                //alert("trigger");
                $('#togbtn').html("Show all tags");
                $("#tag").toggle(searchAll());
            });
            $("#parentcategory").change(function(){
                //alert("trigger1");
                 $("#tag").html("");
                 $('#togbtn').html("Show all tags");
            });
            $("#subcatlist").change(function(){
                //alert("trigger2");
                 $("#tag").html("");
                 $('#togbtn').html("Show all tags");
            });
        });

        function searchAll() {
            var formdata = new FormData();
            // $('#tag').html("pi pi");
            $('.myCheckbox:checked').each(function() {
                // formdata.append($(this).attr('name'), $(this).val());
                formdata.append('categoriesid[]', $(this).attr('id'));
                // alert(formdata.getAll('categoriesid[]'));
            });
            $.ajax({ //is being used to send data to loadall_tag.php page and to fetch result from that page
                url: 'loadall_tag.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(result) {
                    //alert(result);
                    $('#tag').html(result);
                    $('#togbtn').html("Hide all tags");
                    if (result == 'success') {
                        alert('Successfully!');
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
    <div class="theme-layout">

        <!-- header  -->

        <?php require('menu.php'); ?>

        <!-- header end -->

        <section>
            <div class="page-header">
                <div class="header-inner">
                    <h2>Upload Research Video</h2>
                    <p>
                        Sharing your research with the scientific community is an essential step towards advancing
                        knowledge and solving important challenges. Upload your research video to showcase your
                        findings, explain your methodology, and engage with peers and experts around the world. With
                        easy-to-use platforms and tools, you can now share your research video in just a few clicks, and
                        reach a wider audience than ever before.
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

                                    <!-- upload form -->

                                    <form method="post" enctype="multipart/form-data">
                                        <div class="">
                                            <label for="parentcategory">Select Category:</label>
                                            <select class="form-control" id="parentcategory" name="parentcategory">
                                            <option class="pcategorydrop" id="-1" value=""><-- Select Category --></option>
                                                <?php
                                                $parentcategory = "SELECT * FROM parent_category";
                                                $result = mysqli_query($conn, $parentcategory);
                                                while ($arr = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <option class="pcategorydrop" id="<?= $arr['id'] ?>" value="<?= $arr['parent_category'] ?>"><?= $arr['parent_category'] ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="">
                                            <label for="title">Select Sub-Category:</label>

                                            <div style="width: 100%;
                                            padding: 0.375rem 0.75rem; border: 1px solid #ced4da;
                                            border-radius: 0.25rem;
                                            transition: border-color .15s ease-in-out,
                                            box-shadow .15s ease-in-out; 
                                             z-index: 999999;">
                                                <div class="filter-item">
                                                    <ul class="" id="subcatlist" style="list-style-type: none;">
                                                        <div id="subcategory" name="subcategory" style="display: flex;justify-content: center;align-items: center;"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>

                                        <div class="input-group">
                                            <input type="search" class="form-control rounded" placeholder="Search for tags" aria-label="Search" aria-describedby="search-addon" id="tagbox" />
                                            <button type="button" class="btn btn-outline-primary" id="tagbtn" onclick="search()">search</button>
                                            <br><br>
                                        </div>
                                        <div class="input-group" style="justify-content: center;">
                                            <button type="button" class="btn btn-info" id="togbtn">Show all tags</button>


                                        </div>

                                        <div class="">
                                            <label for="title">Select Tags:</label>

                                            <div style="width: 100%;
                                            padding: 0.375rem 0.75rem; border: 1px solid #ced4da;
                                            border-radius: 0.25rem;
                                            transition: border-color .15s ease-in-out,
                                            box-shadow .15s ease-in-out; 
                                             z-index: 999999;">
                                                <div class="filter-item">
                                                    <ul class="">
                                                        <div id="tag" name="tag"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        <div class="">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" rows="3" id="description" name="description" required></textarea>
                                        </div>
                                        <div class="">
                                            <label for="video" style="margin-top: 0px;">Video:</label>
                                            <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
                                        </div>
                                        <div class="">
                                            <label for="thumbnail">Thumbnail:</label>
                                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(this);" required>
                                            <img class="preview-thumbnail" style="max-width: 150px; margin-top: 10px;" />
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



                                    </form>
                                </div>


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
            <a title="" href="register.php?id=<?= $id ?>">Sign up</a>
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

    <script src="https://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>


    <script src="js/main.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#parentcategory').change(function() {
                //alert('hi');
                var parentid = $('#parentcategory option:selected').attr('id');
                //alert(parentid);
                if (parentid > 0) {
                    $.ajax({ //is being used to send data to load_subcategory page and to fetch result from that page
                        type: 'POST',
                        url: 'load_subcategory.php',
                        data: {
                            'parent_id': parentid
                        },
                        success: function(result) {
                            //alert(result);
                            $('#subcategory').html(result);
                            // if (result == 'success') {
                            //     alert('Successfully!');
                            // } else {
                            //     alert(response);
                            // }
                        }

                    });
                }
            });
        });
    </script>

</body>

</html>