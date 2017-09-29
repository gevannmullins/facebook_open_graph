<?php

error_reporting(-1);

session_start();

include_once "facebook_config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/facebook-style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            background-color: #f5f5f5;
        }
        .body-container {
            background-color: #fff;
            border-left: #ccc 1px solid;
            border-right: #ccc 1px solid;
        }
        .back-link a {
            position: relative;
            top: 30px;
            color: darkorange;
        }

        .bordered_container {
            border: #ccc 1px solid;
        }
        .margin_bottom {
            margin-bottom: 15px;
        }

        .top-container {
            border-bottom: #ccc 1px solid;
        }

        .right-sidebar {
            border-left: #ccc 1px solid;
            padding-top: 20px;
            height: 100%;
        }

        .left-sidebar {
            padding-top: 20px;
            /*display: inline-flex;*/
        }

        .left-sidebar a {
            color: darkorange;
        }

    </style>

</head>

<body>



    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Logo</a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#">Manage Fanbase</a>
                            </li>
                            <li>
                                <a href="#">Updates</a>
                            </li>
                            <li>
                                <a href="#">Message</a>
                            </li>
                            <li>
                                <a href="#">Rewards</a>
                            </li>
                            <li>
                                <a href="#">Events</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <div class="col-xs-2 text-center">
<!--                    <p><a href="#" onClick="logInWithFacebook()">Log In with the JavaScript SDK</a></p>-->
                </div>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container body-container">



        <!-- top row container -->
        <div class="row top-container">

            <!-- fanprofile -->
            <div class="col-xs-6">

                <h2>Fan Profile</h2>

            </div>

            <!-- back button -->
            <div class="col-xs-6 text-right back-link">
                <a href="#">< Back to table</a>
            </div>

        </div>

        <div class="row">

            <!-- Comments and Likes Sidebar Links Container -->
            <div class="col-lg-3 left-sidebar">

                <ul>
                    <li><a href="fb_likes.php" class="fb_data_links">Facebook Posts Likes</a></li>
                    <li><a href="fb_comments.php" class="fb_data_links">Facebook Posts Comments</a></li>
                </ul>



            </div>

            <!-- Content Column -->
            <div class="col-lg-5 fb_content_container">
                <?php
                include_once "fb_likes.php";
                ?>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4 right-sidebar">
                <?php
                include_once "fb_user_profile.php";
                ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Font-Awesome Embedded script -->
    <script src="https://use.fontawesome.com/357fb63140.js"></script>


    <script>
        logInWithFacebook = function() {
            FB.login(function(response) {
                if (response.authResponse) {
                    alert('You are logged in &amp; cookie set!you are here');
                    // Now you can redirect the user or do an AJAX request to
                    // a PHP script that grabs the signed request from the cookie.
                } else {
                    alert('User cancelled login or did not fully authorize.');
                }
            });
            return false;
        };
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '126341198088946',
                xfbml      : true,
                version    : 'v2.10'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        $(document).ready(function(){

            $('.fb_data_links').on('click', function(e){
                e.preventDefault();
                var href = $(this).attr('href');

                $('.fb_content_container').load(href);

            })

        });
    </script>


    </body>

</html>
