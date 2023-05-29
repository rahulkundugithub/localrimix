<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property='og:title' content='NFE | Discover' />
    <!-- <meta property='og:image' content='' /> -->
    <meta property='og:description' content='Discovers by NFE' />
    <meta property='og:url' content='nfediscover.ml' />
    <!-- <meta property='og:image:width ' content='1200 ' />
    <meta property='og:image:height ' content='627 ' /> -->
    <meta property="og:type" content='website ' />
    <meta name="theme-color" content="#222222" />
    <meta name="msapplication-TileColor" content="#222222" />
    <!-- CSS only -->

    <!-- Animation CSS -->
    <link rel="stylesheet" href="https://unpkg.com/animon/dist/animon.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>NFE | Discover</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@900&display=swap');

        @font-face {
            font-family: 'poppinsthin';
            /*a name to be used later*/
            src: url('https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap');
            /*URL to font*/
        }

        /* width */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #222222;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background: #222222;
            color: white;
            overflow-x: hidden;
            height: 5000px;
        }

        .bottom {
            position: fixed;
            bottom: 0;
            font-size: 15px;
            color: #afafaf;
        }

        .header {
            text-align: center;
            justify-self: center;
        }

        .head-title {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .head-text {
            color: #afafaf;
        }

        .avtar {
            border-radius: 100%;
            float: right;
            width: 90px;
        }

        .laptop {
            width: 21vh;
        }

        .battery {
            margin-top: -8px;
        }

        .top-bar {
            height: 2px;
            background: linear-gradient(to right, #2775ff, #7202bb);
        }

        a{
            color: white;
            text-decoration: none;
        }

        h1 {
            margin: 0;
            padding: 0;
            font-family: Poppins, sans-serif;
            position: fixed;
            top: 28%;
            transform: translateY(-50%);
            white-space: nowrap;
            font-size: 18.4vh;
            -webkit-text-stroke: 2px rgb(56, 56, 56);
            -webkit-text-fill-color: transparent;
            color: #68696a;
            left: 200px;
            z-index: -1;
            /* overflow-x: hidden; */
        }

        h3 {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            position: fixed;
            top: 30%;
            transform: translateY(-50%);
            white-space: nowrap;
            font-size: 6em;
            color: #68696a;
            right: 50%;
        }

        .mobile {
            display: none;
        }

        .pc {
            align-items: center;
            justify-content: center;
        }

        .center {
            align-items: center;
            justify-content: center;
        }

        .img-thumbnail {
            background-color: #1a1a1a;
            border: 0px;
            padding: 0px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 0;
                padding: 0;
            }

            h1 {
                font-size: 26vw;
            }

            .pc {
                display: none;
            }

            .mobile {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="top-bar"></div>

    <h1>DISCOVER</h1>
    <!-- <h3></h3> -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('scroll', function() {
            $('h1').css("left", Math.max(200 - 0.35 * window.scrollY) +
                "px");
        })
    </script>


    <div class="container">
        <div class="row">
            <div class="col ">

                <div class="head-title m-4 animonItem" data-effect="fadeInUp">
                    <p class="fs-5">Aww..Good to see you!</p>
                    <p class="head-text fs-5">Welcome to
                        <font color="white">NFE Discover</font> <br>here are some discovers by nfe.
                    </p>
                </div>

            </div>

            <div class="col">

                <div class="head-title m-4 animonItem" data-effect="fadeInUp">
                    <img class="avtar" src="avtar.jpg" alt="">
                    <p class="fs-5">Parth Chopra</p>
                    <p class="fs-6 fw-lighter" style="color:#afafaf; margin-top: -20px;">_not_for.everyone_</p>

                    <p class="head-text fs-5">Web Developer<br>
                        <font class="fs-6"><i class="fa fa-instagram"></i> &nbsp; &nbsp;<i class="fa fa-whatsapp"></i> &nbsp; &nbsp;<i class="fa fa-linkedin"></i> &nbsp; &nbsp;<i class="fa fa-facebook"></i></font>
                    </p>
                </div>

            </div>
        </div>

        <?php
        $db = pg_connect("host=dpg-cegjpjh4rebariaieem0-a.oregon-postgres.render.com port=5432 dbname=nfe_usk5 user=nfe password=2nKxwfpZgPezO6l0K8ZHQdOtRp34flGV");
        // $db = pg_connect("host=<External Database URL> port=5432 dbname=nfe user=nfe password=<pwd>");
        // postgres://nfe:2nKxwfpZgPezO6l0K8ZHQdOtRp34flGV@dpg-cegjpjh4rebariaieem0-a.oregon-postgres.render.com/nfe_usk5
        // $query = "SELECT * FROM `battery` WHERE name='MSI'";

        $result = pg_query($db, "SELECT * FROM battery WHERE name='MSI'");

        while ($row = pg_fetch_assoc($result)) {

        ?>

            <div class="row pc">
                <div class="col-12">
                    <p class="fs-3" style="text-align: center; padding: 0px 20px 0px 20px">Hi! I'm NFE, a Web Developer with a bit of backend magic✨!!</p>
                </div>
                <div class="col-9">
                    <div class="head-title m-4 ">
                        <div class="row">
                            <div class="col-3"><img class="laptop img-thumbnail" src="msi.png" alt=""></div>

                            <div class="col ">
                                <p class="fs-5">BiTH</p>
                                <p class="fs-6 fw-lighter" style="color:#afafaf; margin-top: -20px;">MSI Laptop</p>

                                <p class="head-text battery fs-6">Battery :
                                    <font color="white">
                                        <?= $row['battery'] ?>%</font>
                                </p>
                                <p class="head-text battery fs-6">Battery plugged in :
                                    <font color="white">
                                        <? if ($row['charge'] == "false") {
                                            echo 'False';
                                        } else {
                                            echo 'True';
                                        } ?>
                                    </font>
                                </p>
                                <p class="head-text battery fs-6">Battery left :
                                    <font color="white">
                                        <?= $row['time'] ?>
                                    </font>
                                </p>
                            </div>

                            <div class="col">
                                <p class="fs-6 fw-lighter" style="color:#afafaf; ">Its a Battery Tile, it shows the current or last laptop battery status. <br> Built with Python, PHP & PostgreSQL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mobile">
                <div class="col-12">
                    <p class="fs-3" style="text-align: center; padding: 0px 20px 0px 20px">Hi! I'm NFE, a Web Developer with a bit of backend magic✨!!</p>
                </div>
                <div class="col">
                    <div class="head-title m-4 ">
                        <div class="row">
                            <div class="col-4"><img class="laptop img-thumbnail" src="msi.png" alt=""></div>

                            <div class="col ">
                                <p class="fs-5">BITh</p>
                                <p class="fs-6 fw-lighter" style="color:#afafaf; margin-top: -20px;">MSI Laptop</p>

                                <p class="head-text battery fs-6">Battery :
                                    <font color="white">
                                        <?= $row['battery'] ?>%</font>
                                </p>
                                <p class="head-text battery fs-6">Battery plugged in :
                                    <font color="white">
                                        <? if ($row['charge'] == 0) {
                                            echo 'False';
                                        } else {
                                            echo 'True';
                                        } ?>
                                    </font>
                                </p>
                                <p class="head-text battery fs-6">Battery left :
                                    <font color="white">
                                        <?= $row['time'] ?>
                                    </font>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <div class="row center">
            <div class="col col-sm-6 col-lg-4">
                <div class="head-title m-4 ">
                    <p class="fs-3 mb-0" style="text-align: center;">Workshop</p>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-4">
                <div class="head-title m-4 ">
                    <p class="fs-3 mb-0" style="text-align: center;">Projects</p>
                </div>
            </div>
            <!-- <div class="col col-sm-6 col-lg-4">
                <a href="/internship/">
                <div class="head-title m-4 ">
                    <p class="fs-3 mb-0" style="text-align: center;">Wordpress Internship</p>
                </div>
                </a>
            </div> -->
        </div>

    </div>

    <p class="bottom fw-lighter">Designed & Managed by Parth Chopra.</p>


    <!-- Animation Js -->
    <script type="text/javascript" src="https://unpkg.com/animon/dist/animon.iife.js"></script>
    <script type="text/javascript">
        Animon.animon();
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0f8aba5733.js" crossorigin="anonymous"></script>

</body>

</html>