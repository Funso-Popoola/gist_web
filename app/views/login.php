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
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span
                    class="glyphicon glyphicon-th-list"></span></a>


            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div id="login">
                        <h1>Welcome</h1>
                        <div id="magic_div"></div>

                        <form id="form" method="post">
                            <div id="error_div" class="alert alert-danger hidden">
                                <p> Incorrect Username or Password</p>
                            </div>
                            <input id="username_email" type="text" placeholder="Username or Email" required/>
                            <input id="user_password" type="password" placeholder="Password" required/>

                            <div id="forgot">
                                <a href="#">Forgot Password?</a>
                            </div>
                            <br>

                            <div id="newdiv" class="form-group">
                                <button class="btn btn-default pull-right" type="button" id="login_btn">Login</button>
                                <a href="<?php echo(Utility::getUrlFor('user/register')); ?>">
                                    <button class="btn btn-default pull-left" type="button" id="newbutton">Register
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

            <script src="<?php echo(Utility::getHrefFor('js/index.js')); ?>"></script>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>

<!-- /#wrapper -->
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

    window.onload = setUp(PAGE.login);
</script>

</body>

</html>