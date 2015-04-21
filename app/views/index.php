<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 3/12/15
 * Time: 1:08 PM
 */

require_once (ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;

if (!isset($_SESSION)){
    session_start();
}

$logged_in = false;
$link_name = "LOGIN/SUBSCRIBE";
$url = Utility::getUrlFor('login');

$user_id = 0;
$user_api_key = 0;

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_api_key"])){
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
    <link href="<?php echo(Utility::getHrefFor('css/bootstrap.min.css'));?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/style.css')); ?>" rel="stylesheet">

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
                    <a href="<?php echo(Utility::getUrlFor());?>"><img style="display:block;margin:0 auto;" src="<?php echo(Utility::getHrefFor('img/maill.png')); ?>"  height="55%" width="55%"></a>
                </li>

                <li>
                    <a href="<?php echo($url);?>"><?php echo($link_name); ?></a>
                </li>
                <li>
                   <a href="<?php echo(Utility::getUrlFor('channel/all'));?>">ALL CHANNELS</a>
                </li>


            </ul>
        </div>
        <!-- /#sidebar-wrapper -->



        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle</a>
               <div class="col-md-9" id="content">

                          <div class="container">
                            <div class="col-md-9" id="main-head">
                                <div id="loading_div" style="display: none;">
                                    <img src="<?php echo(Utility::getHrefFor('img/load.gif'));?>">
                                </div>

                                <span><img src="<?php echo(Utility::getHrefFor('img/mail.png')); ?>" height="25%" width="25%"><span class="pull-right" id="date"><?php echo(date('d/m/Y', time()));?></span></span>
                            </div>
                        </div>


                <div class="row">
                        <div class="container" id="main_content">
                            <div class="hidden">
                                <p id="cred"><?php echo($user_api_key . '_' . $user_id);?></p>
                            </div>
                            <div class="col-md-6">

                                <h3 id="channelhead">HEADLINES</h3>
                                <section id="ccr-slide-main" class="carousel slide" data-ride="carousel">

                                    <!-- Carousel items -->
                                    <div class="carousel-inner" id="slider_div">


                                    </div> <!-- /.carousel-inner -->


                                    <ol class="carousel-indicators" id="slider_indicators">
                                    </ol> <!-- /.carousel-indicators -->

                                </section>

                            </div>
                            <div class="container">
                                <div class="col-md-3">
                                    <div id="sideinfo">


                                    </div>                                  </div>

                                    </div>
                            </div>


                            <div class="container">


                                <div class="col-md-9" id="trends">
                                    <section >
                                        <!-- .ccr-gallery-ttile -->

                                        <p id="trendss">TRENDING</p>

                                        <div class="row" id="newsrow">
                                            <div class="ccr-thumbnail col-md-4">
                                                <img src="<?php echo(Utility::getHrefFor('img/portrait/03.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                                <div class="row" id="channelnam">
                                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                                    <span class="glyphicon glyphicon-thumbs-down">8</span>&nbsp;
                                                </div>
                                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                                <br><a href="#postlink" id="link-font">Fire Outbreak in Moremi hall</a>
                                            </div>


                                            <div class="ccr-thumbnail col-md-4">
                                                <img src="<?php echo(Utility::getHrefFor('img/portrait/05.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                                <div class="row" id="channelnam">
                                                    <br><span class="glyphicon glyphicon-thumbs-up">106</span>&nbsp;
                                                    <span class="glyphicon glyphicon-comment">230</span>&nbsp;
                                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                                </div>
                                                <a href="channel.php" id="channelname">FASHION</a>
                                                <br><a href="#postlink" id="link-font">Fashion takes new toll</a>
                                            </div>


                                            <div class="ccr-thumbnail col-md-4">
                                                <img src="../static/img/portrait/07.jpg" alt="Thumbnail 1" height="100px" width="100px">
                                                <div class="row" id="channelnam">
                                                    <br><span class="glyphicon glyphicon-thumbs-up">622</span>&nbsp;
                                                    <span class="glyphicon glyphicon-comment">800</span>&nbsp;
                                                    <span class="glyphicon glyphicon-thumbs-down">4</span>&nbsp;
                                                </div>
                                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                                <br><a href="#postlink" id="link-font">Wizkid Ayo Balogun storms OAU live.</a>
                                            </div>

                                        </div>

                                    </section>

                                </div>
                            </div>

                            <div class="container">
                                <div class="col-md-9">
                                    <a href="" class="btn btn-success" id="loadbutton">LOAD MORE</a>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- /#page-content-wrapper -->

         <!--footer -->

         <footer class="footer">
            <div class="container" id="footer">
         <p>&COPY;Webometrics 2015</p>
        </div>
        </footer> 
        <!--footer -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo(Utility::getHrefFor('js/jquery.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo(Utility::getHrefFor('js/bootstrap.min.js')); ?>"></script>

<script src="<?php echo(Utility::getHrefFor('js/lib.js'));?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/pull_data.js'));?>"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    window.onload = setUp(PAGE.index);
</script>

</body>

</html>