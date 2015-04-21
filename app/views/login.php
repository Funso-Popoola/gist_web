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
                    <a href="<?php echo(Utility::getUrlFor('index'));?>"><img style="display:block;margin:0 auto;" src="<?php echo(Utility::getHrefFor('img/maill.png')); ?>"  height="55%" width="55%"></a>
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
        <div class="row">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
            <div class="col-md-9 col-md-offset-1"  id="content">
                     <div class="container">
                            <div class="col-md-9" id="main-head">

                                <span><img src="<?php echo(Utility::getHrefFor('img/mail.png')); ?>" height="25%" width="25%"><span class="pull-right" id="date">April 09, 2015</span></span>
                            </div>
                        </div>


         <div class="container-fluid">
           <div class="col-md-9 col-md-offset-1">
               <div id="loading_div" style="display: none;">
                   <img src="<?php echo(Utility::getHrefFor('img/load.gif'));?>">
               </div>
               <div class="hidden">
                   <p id="cred"><?php echo($user_api_key . '_' . $user_id);?></p>
               </div>

             <div id="login">
              <h1>Welcome</h1>
             <div id="error_div" class="alert alert-danger hidden" role="alert">
                 <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                 <span class="sr-only">Error:</span>
                 Invalid username/email or password
             </div>
              <form id="form">
                <input id="username_email" type="text" placeholder="Username OR Email" />
                <input id="user_password" type="password" placeholder="Password" />
                <a href="#" class="forgot">Forgot Password?</a>
                <input id="login_btn" type="button" value="Log in" />
            </form>
        </div>
       <div class="col-md-9 col-md-offset-1 hidden" id="magic_div">
       </div>

    </div>
</div>
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

<script src="<?php echo(Utility::getHrefFor('js/index.js'));?>"></script>
</div>
</div>
    <!-- /#page-content-wrapper -->

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

    window.onload = setUp(PAGE.login);
</script>

</body>

</html>