<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 3/12/15
 * Time: 1:08 PM
 */

require_once(ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;

if (!isset($_SESSION)) {
    session_start();
}

$logged_in = false;
$link_name = "LOGIN/SUBSCRIBE";
$url = Utility::getUrlFor('login');

$user_id = 0;
$user_api_key = 0;

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_api_key"])) {
    $user_id = $_SESSION["user_id"];
    $user_api_key = $_SESSION["user_api_key"];
    $logged_in = true;
    $link_name = "LOGOUT";
    $url = Utility::getUrlFor('login/out');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OAU Gist</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->

    <link href="<?php echo(Utility::getHrefFor('css/edited.css')); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav" id="sidenav">
            <li class="sidebar-brand">
                <a href="<?php echo(Utility::getUrlFor()); ?>"><img style="display:block;margin:0 auto;"
            </li>
            <li>
                <a href="<?php echo($url); ?>"><?php echo($link_name); ?></a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('channel/all')); ?>">ALL CHANNELS</a>
            </li>
        </ul>
    </div>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="main_content">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span
                    class="glyphicon glyphicon-th-list"></span></a>

            <div class="row">
                <div class="col-md-12" id="main-head">
                    <span><img src="<?php echo(Utility::getHrefFor('img/mail.png')); ?>" height="23%" width="23%"><span
                            class="pull-right" id="date"><?php echo(date('d/m/Y', time())); ?></span></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="hidden">
                        <p id="cred"><?php echo($user_api_key . '_' . $user_id); ?></p>
                    </div>
                    <div id="loading_div" style="display: none;">
                        <img src="<?php echo(Utility::getHrefFor('img/load.gif')); ?>">
                    </div>
                    <h3 id="channelhead">HEADLINES</h3>

                    <div class="col-md-7">
                        <section id="ccr-slide-main" class="carousel slide" data-ride="carousel">
                            <!-- Carousel items -->
                            <div class="carousel-inner" id="slider_div">

                            </div>
                            <!-- /.carousel-inner -->

                            <ol class="carousel-indicators" id="slider_indicators">

                            </ol>
                            <!-- /.carousel-indicators -->
                        </section>
                    </div>
                    <div class="col-md-5">
                        <div id="sideinfo">
                            <div class="side-news">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="trends">
                    <section>
                        <!-- .ccr-gallery-ttile -->

                        <p id="trendss">TRENDING</p>

                        <div class="row" id="trend_news">
                        </div>

                    </section>
                </div>
            </div>
        </div>
        <div class="modal-loading"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="footer" id="footer">
                    <p>&COPY;Webometrics 2015</p>
                </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="<?php echo(Utility::getHrefFor('js/jquery.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo(Utility::getHrefFor('js/bootstrap.min.js')); ?>"></script>

<script src="<?php echo(Utility::getHrefFor('js/lib.js')); ?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/pull_data.js')); ?>"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    window.onload = setUp(PAGE.index);
</script>
</body>
</html>