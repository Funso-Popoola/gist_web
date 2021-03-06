<?php
require_once(ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;

$newsId = $GLOBALS["news"]["news_id"];

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

    <title> Gist | News</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/style.css'));?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo(Utility::getHrefFor('js/lib.js')); ?>"></script>
    <script src="<?php echo(Utility::getHrefFor('js/pull_data.js')); ?>"></script>

</head>
<body>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav" id="sidenav">
            <li class="sidebar-brand">
                <a href="<?php echo(Utility::getUrlFor()); ?>"><img style="display:block;margin:0 auto;"
                                                                    src="<?php echo(Utility::getHrefFor('img/maill.png')); ?>"
                                                                    height="55%" width="55%"></a>
            </li>
            <li>
                <a href="<?php echo($url); ?>"><?php echo($link_name); ?></a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('channel/all')); ?>">ALL CHANNELS</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->


    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle</a>
            <p class="hidden" id="news_id"><?php echo($newsId); ?></p>
                <div class="row">
                    <div class="col-md-12" id="main-head">
                        <span><img src="<?php echo(Utility::getHrefFor('img/mail.png')); ?>" height="25%" width="25%"><span class="pull-right" id="date"><?php echo(date('d/m/Y', time())); ?></span></span>
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

                        <section id="ccr-main-section">

                            <section id="ccr-left-section">
                                <div class="ccr-gallery-ttile">
                                    <span></span>

                                    <p id="channel">CHANNEL NAME</p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-md-offset-2">
                                        <img class="hidden" id="news_image"
                                             src="<?php echo(Utility::getHrefFor('img/slide/main-slide-1.jpg')); ?>"
                                             alt="News Image" style="margin-top:20px;">
                                    </div>
                                </div>


                                <article id="ccr-article">
                                    <div class="row">
                                        <div class="content col-md-12">
                                            <h3 class="text-center" id="news_title"></h3>

                                            <p id="news_content">

                                            </p>
                                        </div>
                                    </div>

                                    <div class="row" id="news-button">
                                        <button id="news_like_btn" class="btn btn-success" <?php echo(($user_id == 0) ? 'disabled' : '');?>><span class="glyphicon glyphicon-thumbs-up" id="num_of_likes"></span>
                                        </button>
                                        &nbsp;
                                        <button class="btn btn-default" disabled><span class="glyphicon glyphicon-comment" id="num_of_comments"></span></button>
                                        &nbsp;
                                        <button id="news_dislike_btn" class="btn btn-warning" <?php echo(($user_id == 0) ? 'disabled' : '');?>><span class="glyphicon glyphicon-thumbs-down" id="num_of_dislikes"></span>
                                        </button>
                                        &nbsp;
                                    </div>
                                </article>


                                <div class="row" id="existing_comments">
                                    <div class="news-container col-md-12">
                                        <section id="ccr-commnet">
                                            <div class="ccr-gallery-ttile">
                                                <span class="bottom"></span>
                                                <p id="comment_heading">Comments</p>
                                                <p class="hidden text-center" id="no_comment_heading">No Comment Yet <?php echo(($user_id != 0) ? "Be the first to Comment!" : "");?></p>
                                            </div>
                                            <!-- .ccr-gallery-ttile -->
                                        </section>
                                        <!-- /#ccr-commnet -->
                                    </div>
                                </div>

                                <div class="row<?php echo($logged_in ? '' : ' hidden'); ?>" id="post_comment">
                                    <div class="col-md-12">
                                        <section id="ccr-respond">
                                            <div class="ccr-gallery-ttile">
                                                <span class="bottom"></span>

                                                <p>Post a Comment</p>
                                            </div>
                                            <!-- .ccr-gallery-ttile -->
                                            <div id="respond">
                                                <form action="#" method="post" id="commentform">

                                                    <textarea id="comment" name="comment"
                                                              placeholder="Enter Comment Here" rows="2"
                                                              required></textarea>
                                                    <button class="btn btn-primary" type="button" id="add_comment_btn">Post</button>

                                                </form>
                                                <!-- /#commentform -->

                                            </div>
                                            <!-- /#respond -->

                                        </section>
                                        <!-- /#ccr-respond -->
                                    </div>
                                </div>

                            </section>

                        </section>
                    </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="footer" id="footer">
                    <p>&COPY;Webometrics 2015</p>
                </div>
            </div>
    </div>
</div>
<!-- page content wrapper  -->


<!--footer -->
    <div class="modal-loading"></div>
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

<script src="<?php echo(Utility::getHrefFor('js/lib.js')); ?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/moment.js')); ?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/pull_data.js')); ?>"></script>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    window.onload = function(){setUp(PAGE.news)};
</script>

</body>

</html>
