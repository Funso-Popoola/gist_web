<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 3/18/15
 * Time: 12:34 PM
 */

require_once(ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;

if (!isset($_SESSION)) {
    session_start();
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
    <title>Gist | Admin Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/bootstrap.min.css')); ?> " rel="stylesheet">
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
<header>
    <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>

                </button>
                <a href="<?php echo(Utility::getUrlFor()); ?>"><img
                        src="<?php echo(Utility::getHrefFor('img/maill.png')); ?>" style="margin:0 auto" width="60px"
                        class="img pull-left "><a href="#" class="navbar-brand"><strong> &nbsp Gist
                            Admin</strong></a></a>
            </div>

        </div>
    </div>

</header>
<div class="container-fluid">
    <div class="row">
        <div id="login">
            <h1>Welcome</h1>

            <form id="form">
                <div id="error_div" class="alert alert-danger hidden">
                    <p> Incorrect Username or Password</p>
                </div>
                <input type="text" placeholder="Username" id="admin_username"/>
                <input type="password" placeholder="Password" id="admin_password"/>

                <div id="forgot">
                    <a href="#">Forgot Password?</a>
                </div>
                <br>

                <div id="newdiv">
                    <a id="admin_login_btn">
                        <button class="btn btn-default pull-right" type="button" id="newbutton">Login</button>
                    </a>
                    <a href="<?php echo(Utility::getUrlFor('admin/register')); ?>">
                        <button class="btn btn-default pull-left" type="button" id="newbutton">Register</button>
                    </a>
                </div>
            </form>
        </div>

        <div class="col-md-9 col-md-offset-1 hidden" id="magic_div">
        </div>

    </div>
</div>

<!-- jQuery -->
<script src="<?php echo(Utility::getHrefFor('js/jquery.js')); ?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/admin.js')); ?>"></script>
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

    window.onload = function(){setUp(PAGE.admin_login);};
</script>

</body>

</html>