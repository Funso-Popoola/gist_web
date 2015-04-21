<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 3/18/15
 * Time: 12:34 PM
 */

require_once (ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;

if (!isset($_SESSION)){
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
    <title>Gist | Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/bootstrap.min.css'));?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/style.css'));?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<header>
    <div class="navbar navbar-default navbar-inverse navbar navbar-fixed-top" >
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle ="collapse" data-target="#navbar">
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>

                </button>
                <a href="<?php echo(Utility::getUrlFor('index'));?>" class="navbar-brand"><strong>Gist Admin</strong></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">Menu1</a> </li>
                    <li class="active"><a href="#">Menu2</a> </li>
                    <li class="active"><a href="#">Menu3</a> </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="col-md-9">

        <div id="login">
            <div id="triangle"></div>
            <h1>Welcome</h1>
            <form id="form">
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <a href="#" class="forgot">Forgot Password?</a>
                <input type="submit" value="Log in" />
            </form>
        </div>

    </div>
</div>

    <!-- jQuery -->
    <script src="<?php echo(Utility::getHrefFor('js/jquery.js'));?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo(Utility::getHrefFor('js/bootstrap.min.js'));?>"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>
