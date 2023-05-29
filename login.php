<?php
require_once('config.php');
require_once 'User.class.php';
require_once('user_auth.php');

// echo $_SESSION['first_name'];

// Auth using Lnkedin Start

if ($_SESSION['form_status'] == "verified") {
    header('Location: ./research.php?id=f');
}

$authUrl = $output = '';
if (isset($_SESSION['oauth_status']) && $_SESSION['oauth_status'] == 'verified' && !empty($_SESSION['userData'])) {
    $userData = $_SESSION['userData'];
    if (!empty($userData)) {
        // $output  = '<h2>LinkedIn Profile Details</h2>';
        // $output .= '<div class="ac-data">';
        // $output .= '<img src="'.$userData['picture'].'"/>';
        // $output .= '<p><b>LinkedIn ID:</b> '.$userData['oauth_uid'].'</p>';
        // $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>';
        // $output .= '<p><b>Email:</b> '.$userData['email'].'</p>';
        // $output .= '<p><b>Logout from</b> <a href="logout.php">LinkedIn</a></p>';
        // $output .= '</div>';
        // $output .= '<p>You are already logged in.!</p>';

        header('Location: ./research.php');
    }
} elseif ((isset($_GET["oauth_init"]) && $_GET["oauth_init"] == 1) || (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) || (isset($_GET['code']) && isset($_GET['state']))) {
    $client = new oauth_client_class;

    $client->client_id = LIN_CLIENT_ID;
    $client->client_secret = LIN_CLIENT_SECRET;
    $client->redirect_uri = LIN_REDIRECT_URL;
    $client->scope = LIN_SCOPE;
    $client->debug = 1;
    $client->debug_http = 1;
    $application_line = __LINE__;

    if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0) {
        echo "Problem";
        die();
    }

    // If authentication returns success
    if ($success = $client->Initialize()) {
        if (($success = $client->Process())) {
            if (strlen($client->authorization_error)) {
                $client->error = $client->authorization_error;
                $success = false;
            } elseif (strlen($client->access_token)) {
                $success = $client->CallAPI(
                    'https://api.linkedin.com/v2/me?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))',
                    'GET',
                    array(
                        'format' => 'json'
                    ),
                    array('FailOnAccessError' => true),
                    $userInfo
                );
                $emailRes = $client->CallAPI(
                    'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))',
                    'GET',
                    array(
                        'format' => 'json'
                    ),
                    array('FailOnAccessError' => true),
                    $userEmail
                );
            }
        }
        $success = $client->Finalize($success);
    }

    if ($client->exit)
        exit;

    if (strlen($client->authorization_error)) {
        $client->error = $client->authorization_error;
        $success = false;
    }

    if ($success) {
        $user = new User();
        $inUserData = array();
        $inUserData['oauth_uid'] = !empty($userInfo->id) ? $userInfo->id : '';
        $inUserData['first_name'] = !empty($userInfo->firstName->localized->en_US) ? $userInfo->firstName->localized->en_US : '';
        $inUserData['last_name'] = !empty($userInfo->lastName->localized->en_US) ? $userInfo->lastName->localized->en_US : '';
        $inUserData['email'] = !empty($userEmail->elements[0]->{'handle~'}->emailAddress) ? $userEmail->elements[0]->{'handle~'}->emailAddress : '';
        $inUserData['picture'] = !empty($userInfo->profilePicture->{'displayImage~'}->elements[0]->identifiers[0]->identifier) ? $userInfo->profilePicture->{'displayImage~'}->elements[0]->identifiers[0]->identifier : '';
        $inUserData['link'] = 'https://www.linkedin.com/';

        $inUserData['oauth_provider'] = 'linkedin';
        $userData = $user->checkUser($inUserData);


        $_SESSION['userData'] = $userData;
        $_SESSION['oauth_status'] = 'verified';
        $_SESSION['form_status'] = "verified";

        if ($userData['password'] == "") {
            header('location: ./password.php?id=l');
        } else
            header('Location: ./research.php');
    } else {
        $output = 'error' . HtmlSpecialChars($client->error);
    }
} elseif (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
    $output = $_GET["oauth_problem"];
} else {
    $authUrl = '?oauth_init=1';

    $output = '<a href="?oauth_init=1"><img src="images/linkedin-sign-in-btn.png"></a>';
}

// Auth using Lnkedin End


// Login using Form Start

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//login using form
// When form submitted, check and create user session.
if (isset($_POST['password'])) {
    debug_to_console("received");
    $email = stripslashes($_REQUEST['email']); // removes backslashes
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $oauth_uid = "";
    $oauth_provider = "";

    debug_to_console("Check");
    // Check user is exist in the database
    $query = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    while ($row = $result->fetch_assoc()) {
        debug_to_console("found1");

        $oauth_uid = $row['oauth_uid'];
        $oauth_provider = $row['oauth_provider'];

    }

    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        debug_to_console("session-start");

        session_start();

        $_SESSION['oauth_uid'] = $oauth_uid;
        $_SESSION['oauth_provider'] = $oauth_provider;

        // echo $_SESSION['oauth_uid']." ".$_SESSION['oauth_provider'];
        ?>

        <?php include 'user_auth.php'; ?>

        <?php
        // echo $userData['first_name']." ".$userData['last_name'];

        header('Location: research.php?id=f');
    } else {
        $success = "User Not Found! Incorrect UserName or Password ";
    }
}

// Login using Form End


//google auth start

$login_button = '';


if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);


        $_SESSION['access_token'] = $token['access_token'];


        $google_service = new Google_Service_Oauth2($google_client);


        $data = $google_service->userinfo->get();


        if (!empty($data['given_name'])) {
            $first_name = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $last_name = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $email = $data['email'];
        }

        if (!empty($data['gender'])) {
            $gender = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $picture = $data['picture'];
        }

        //check if user exist? yes then fetchall the data and put into $userData $_SESSION['userData']

        $oauth_uid = "";
        $oauth_provider = "";

        debug_to_console("Check user");
        // Check user is exist in the database
        $query = "SELECT * FROM `users` WHERE email='$email' AND first_name='$first_name'";
        $result = mysqli_query($conn, $query);
        while ($row = $result->fetch_assoc()) {
            debug_to_console("found1");

            $oauth_uid = $row['oauth_uid'];
            $oauth_provider = $row['oauth_provider'];

        }

        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            debug_to_console("session-start");

            session_start();

            $_SESSION['oauth_uid'] = $oauth_uid;
            $_SESSION['oauth_provider'] = $oauth_provider;

            // echo $_SESSION['oauth_uid']." ".$_SESSION['oauth_provider'];
            ?>

            <?php include 'user_auth.php'; ?>

            <?php
            // echo "user is exist in the database" . $userData['first_name']." ".$userData['last_name'];

            //header('Location: research.php?id=f');
        
}
        //if user not found,  insert data into db, then input data into $userData $_SESSION['userData]
        else {

            //insert into db
            include 'insert-google-user.php';

            debug_to_console("session-start");

            session_start();
            $oauth_provider = "google";

            $_SESSION['oauth_uid'] = $oauth_uid;
            $_SESSION['oauth_provider'] = $oauth_provider;

            // echo "user not found" .$_SESSION['oauth_uid']." ".$_SESSION['oauth_provider'];
            //echo $oauth_uid." ".$oauth_provider;


            $_SESSION['userData'] = $userData;
            

            //header('Location: research.php?id=f');
        }

        //Check is $userData['password'] is empty - yes - redirect to password.php
        if ($userData['password'] == "") {
           // header('Location: password.php?id=f');
            echo '<script>
                    function pageRedirect() {
                     window.location.replace("password.php?id=f");
                    }      
                    setTimeout("pageRedirect()", 0);
                    </script>';
        } else
           // header('Location: research.php?id=f');
           echo '<script>
                    function pageRedirect() {
                     window.location.replace("research.php?id=f");
                    }      
                    setTimeout("pageRedirect()", 0);
                    </script>';


    }
}


// if not logged in the show button

if (!isset($_SESSION['access_token'])) {

    $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img style="margin-top: 20px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiTo_OujGqM3a-xuMfMGEFPMHkSrIJFHmBJzTrgA7TJbgSGr_LQoyq-_b0aSbUFLlszA&usqp=CAU" /></a>';
}


//google auth end


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Login - ResearchRemix</title>
    <link rel="icon" href="content/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/weather-icon.css">
    <link rel="stylesheet" href="css/weather-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>
    <div class="www-layout">
        <section>
            <div class="gap no-gap signin whitish medium-opacity">
                <div class="bg-image" style="background-image:url(content/theme-bg.jpg)"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="big-ad">
                                <figure><a href="index.php"><img src="content/logo-org.png" alt="researchremix"
                                            style="height:100px;"></a></figure>
                                <h1>Welcome to the ResearchRemix</h1>
                                <p>
                                    <b>ResearchRemix</b> is a free to use service and can be a great space for research
                                    enthusiast to discover and learn things as they like. For many young people,
                                    <b>ResearchRemix</b> is used to watch <span class="text-danger">Science Videos,
                                        Research Reviews, Technology Advancements, Experimental Tutorials, Laboratory
                                        Working</span> and more. Teens also use the video-sharing service to follow
                                    their favouriteResearch field, subscribe to other Researchers and Professors they
                                    are interested in.
                                </p>

                                <!-- <div class="fun-fact">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-4">
                                            <div class="fun-box">
                                                <i class="ti-check-box"></i>
                                                <h6>Registered People</h6>
                                                <span>1,01,242</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-4">
                                            <div class="fun-box">
                                                <i class="ti-layout-media-overlay-alt-2"></i>
                                                <h6>Posts Published</h6>
                                                <span>21,03,245</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-4">
                                            <div class="fun-box">
                                                <i class="ti-user"></i>
                                                <h6>Online Users</h6>
                                                <span>40,145</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="barcode">
                                    <figure><img src="images/resources/Barcode.jpg" alt=""></figure>
                                    <div class="app-download">
                                        <span>Download Mobile App and Scan QR Code to login</span>
                                        <ul class="colla-apps">
                                            <li><a title="" href="https://play.google.com/store?hl=en"><img src="images/android.png" alt="">android</a></li>
                                            <li><a title="" href="https://www.apple.com/lae/ios/app-store/"><img src="images/apple.png" alt="">iPhone</a></li>
                                            <li><a title="" href="https://www.microsoft.com/store/apps"><img src="images/windows.png" alt="">Windows</a></li>
                                        </ul>
                                    </div>
                                </div>-->

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="we-login-register">
                                <div class="form-title">
                                    <i class="fa fa-key"></i>login
                                    <span>sign in now and meet the awesome Friends around the world.</span>
                                </div>
                                <form class="we-form" action="" method="post">

                                    <input type="email" name="email" placeholder="Email">
                                    <span class="error">
                                        <?php echo $emailErr; ?>
                                    </span>

                                    <input type="password" name="password" placeholder="Password">
                                    <span class="error">
                                        <?php echo $passwordErr; ?>
                                    </span>
                                    <span class="success">
                                        <?php echo $success; ?>
                                    </span>

                                    <input type="checkbox"><label>remember me</label>
                                    <button type="submit" data-ripple="">sign in</button>
                                    <a class="forgot underline" href="#" title="">forgot password?</a>
                                </form>

                                OR
                                <hr>
                                <?= $output; ?>
                                <!-- <a class="with-smedia twitter" href="?oauth_init=1" title="" style="width:100%; font-size: 14px;">Continue with LinkedIn <i style="font-size: 20px;" class="fa fa-linkedin"></i></a> -->
                                <a class="with-smedia google" href="index.php" title="ResearchRemix"
                                    style=" position:fixed ; top: 0; left:0; margin:20px 0px 0px 20px; font-size: 14px;"><i
                                        style="font-size: 20px;" class="fa fa-home"></i></a>

                                <!-- google auth button -->
                                <?php
                                if ($login_button == '') {
                                    // echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
                                    // echo '<img src="' . $_SESSION["user_image"] . '" class="img-responsive img-circle img-thumbnail" />';
                                    // echo '<h3><b>Name :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
                                    // echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . '</h3>';
                                    // echo '<h3><a href="logout.php">Logout</h3></div>';
                                    header('Location: ./research.php?id=f');
                                } else {
                                    echo '<div align="center">' . $login_button . '</div>';
                                }
                                ?>

                                <span>don't have an account? <a class="we-account underline" href="register.php"
                                        title="">register now</a></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="js/main.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>