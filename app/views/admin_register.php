<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 3/12/15
 * Time: 1:08 PM
 */

require_once (ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;

if (!isset($_SESSION)) {
    session_start();
}
$user_id = 0;
$user_api_key = 0;

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_api_key"])) {
    $user_id = $_SESSION["user_id"];
    $user_api_key = $_SESSION["user_api_key"];
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
<header>
    <div class="navbar navbar-default navbar-inverse navbar-fixed-top" >
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle ="collapse" data-target="#navbar">
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"> </span>

                </button>
                <a href="<?php echo(Utility::getUrlFor());?>"><img src="<?php echo(Utility::getHrefFor('img/maill.png'));?>"  style="margin:0 auto"  width="60px" class="img pull-left "><a href="#" class="navbar-brand"><strong> &nbsp Gist Admin</strong></a></a>
            </div>

        </div>
    </div>

</header>
<div id="admin" class="center-block">
    <div class="row" id="loginadmin">
        <div class="hidden">
            <p id="cred"><?php echo($user_api_key . '_' . $user_id); ?></p>
        </div>
        <div id="magic_div"></div>
        <div id="loginn">
            <h1>Create Channel</h1>
            <form id="form_admin" class="form-control">
                <!--  <label for="email">Name:</label>-->
                <div class="form-group">
                    <label for="user_name">Admin username</label>
                    <input type="text" id="user_name"/>
                </div>
               <div class="form-group">
                   <label for="channel_name">Channel name</label>
                <input type="text" id="channel_name"/>
               </div>
                <div class="form-group">
                    <label for="channel_desc">Channel description</label>
                    <input type="text" id="channel_desc"/>
                    </div>
                <div class="form-group">
                    <img id="channel_img_display" src="<?php echo(Utility::getHrefFor('img/avatar.png'));?>"  width="150px" height="150px">
                    <label for="channel_img">Channel img</label>
                    <input type="file" id="channel_img"/>

                </div>

                <br>
                <div class="form-group">
                    <label for="pass_word">Password</label>
                    <input type="password" id="pass_word"/>
                    <p class="help-block">NOTE: Password is case-sensitive</p>
                    </div>

                <button class="btn btn-default center-block"  type="button" id="newbutton">Register</button>
        </div>
        </form>
    </div>
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
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    window.onload = function(){setUp(PAGE.channel_register)};
</script>

</body>

</html>