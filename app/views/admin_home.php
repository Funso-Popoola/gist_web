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

$logged_in = false;
$link_name = "LOGIN/SUBSCRIBE";
$url = Utility::getUrlFor('login');

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_api_key"])) {
    $user_id = $_SESSION["user_id"];
    $user_api_key = $_SESSION["user_api_key"];
    $logged_in = true;
    $link_name = "LOGOUT";
    $url = Utility::getUrlFor('login/out');
}

$channel_id = 0;
if (isset($_SESSION['channel_id'])) {
    $channel_id = $_SESSION['channel_id'];
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
    <title>Gist | Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo(Utility::getHrefFor('css/bootstrap.min.css'));?> " rel="stylesheet">
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
            ,<a href="<?php echo(Utility::getUrlFor('admin/logout'));?>"><span class="pull-right glyphicon glyphicon-log-out" id="logout">Logout</span></a>
        </div>
    </div>

</header>
<div class="container-fluid">
    <div class="row">
        <div class="side_bar">
            <div class="col-md-3">
                <!-- the navigation bar goes in here-->
                <ul class="nav nav-tabs">
                    <li><a href="#general" data-toggle="tab"></a></li>
                    <li class="active"><a href="#Posts" data-toggle="tab"><h5>POSTS</h5></a></li>
                    <li><a href="#Profile" data-toggle="tab"><h5>PROFILE</h5></a></li>
                </ul>
            </div>

            <!-- col ; end of navigation bar-->
        </div>

        <div class="col-md-8">
            <!-- the  content of all tabs-->
            <div class="tab-content">


                <!-- tab contents proper-->
                <div class="tab-pane active" id="Posts">

                    <div id="post-form" class="hidden">

                        <h3 id="channelname">New Post</h3>
                        <hr>
                        <!-- start the form for home settings -->
                        <form role="form" style="margin-top:30px;">
                            <div class="form-group">
                                <label id="channelname" for="adminNewPostTitle">Title:</label>
                                <input type="text" class="form-control" placeholder="Enter News title" id="adminNewPostTitle">
                            </div>

                            <div class="form-group">
                                <label id="channelname" for="news_category">News Category:</label>
                                <select id="news_category" class="form-control">
                                </select>
                            </div>

                            <div class="form-group">
                                <label id="channelname">Image:</label><br>
                                <img id="news_display_img" src="<?php echo(Utility::getHrefFor('img/avatar.png'));?>" width="150px" height="150px">
                                <input class="form-inline" type="file" id="adminNewPostImageUrl">
                            </div>

                            <div class="form-group">
                                <label id="channelname" for="adminNewPostDetails">News Detail:</label><br>
                                <textarea class="form-control" rows="15" id="adminNewPostDetails"></textarea>
                            </div>


                            <div class="form-group">
                                <label id="channelname" for="adminNewPostTitle">External Link:</label>
                                <input type="url" class="form-control" id="adminNewPostLink">
                            </div>

                            <div class="row">
                                <div class="col-md-6"><button id="adminNewPostPublish" type="button" class="btn btn-info">Publish</button><button type="reset" class="btn btn-info" id="cancelPost">Cancel</button></div>

                            </div>
                        </form>
                    </div>


                    <h3 id="channelname">Posts</h3>
                    <hr>

                    <div><button id="addPost" class="btn btn-info pull-right">Add Post &nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button></div>

                    <div class="hidden" id="channel_id"><?php echo($channel_id); ?></div>
                    <div class="hidden">
                        <p id="cred"><?php echo($user_api_key . '_' . $user_id); ?></p>
                    </div>
                    <div id="postlist">
                        <ul>

                        </ul>
                    </div>

                    <div  id="loadpostbutton">
                        <button class="btn btn-success" id="load_more_posts">Load More Posts</button>
                    </div>
                </div>
                <!-- end of posts tab -->

                <!-- tab contents proper-->
                <div class="tab-pane" id="Profile">

                    <h3 id="channelname">Profile</h3>

                    <hr>
                    <!-- start the form for home settings -->

                    <div class="form-group">
                        <label id="channelname">CHANNEL NAME:</label><br>
                        <input type="text" class="form-control" placeholder="Enter desired name here">
                    </div>

                    <div>
                        <p id="channelname">IMAGE:</p>
                        <img src="../static/img/img.jpeg" width="150px" height="150px">
                        <input type="file">
                    </div><br>



                    <div class="form-group">
                        <label id="channelname">DESCRIPTION:</label><br>
                        <textarea class="form-control" rows="8"></textarea>
                    </div>


                    <div class="row">
                        <div class="col-md-6"><button id="adminSave" type="button" class="btn btn-info">Save</button></div>
                    </div>

                </div>

            </div>
            <!-- End of tab contents-->


        </div>

    </div>
</div>
</div>

<!-- jQuery -->
<script src="<?php echo(Utility::getHrefFor('js/jquery.js'));?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/admin.js'));?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo(Utility::getHrefFor('js/bootstrap.min.js'));?>"></script>

<script src="<?php echo(Utility::getHrefFor('js/lib.js'));?>"></script>
<script src="<?php echo(Utility::getHrefFor('js/pull_data.js'));?>"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    window.onload = function(){setUp(PAGE.admin_home)};

</script>

</body>

</html>