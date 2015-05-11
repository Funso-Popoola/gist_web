<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 3/12/15
 * Time: 1:08 PM
 */

require_once (ROOT_DIR . '/app/libs/Utility.php');
use libs\Utility;
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
                <a href="<?php echo(Utility::getUrlFor('index'));?>"><img style="display:block;margin:0 auto;" src="<?php echo(Utility::getHrefFor('img/maill.png')); ?>"  height="55%" width="55%"></a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('login'));?>">LOGIN/SUBSCRIBE</a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('allChannels'));?>">ALL CHANNELS</a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('category'));?>">OAU NEWS</a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('category'));?>">ACADEMICS</a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('category'));?>">FASHION</a>
            </li>
            <li>
                <a href="<?php echo(Utility::getUrlFor('category'));?>">ENTERTAINMENT</a>
            </li>
        </ul>
    </div>
<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span class="glyphicon glyphicon-th-list"></span></a>
            <div class="row">
                <div class="col-md-12" id="main-head" >
                    <span><img src="<?php echo(Utility::getHrefFor('img/mail.png')); ?>" height="25%" width="25%"><span class="pull-right" id="date">April 09, 2015</span></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3 id="channelhead">HEADLINES</h3>
                    <div class="col-md-6">
                        <section id="ccr-slide-main" class="carousel slide" data-ride="carousel">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="active item">
                                    <div class="slide-element">
                                        <img src="<?php echo(Utility::getHrefFor('img/landscape/04.jpg')); ?>"  width="530px" height="370px" >
                                        <p><a href="news.php">Wizkid Storms OAU</a></p>
                                    </div> <!-- /.slide-element -->
                                </div> <!--/.active /.item -->
                                <div class="item">
                                    <div class="slide-element">
                                        <img src="<?php echo(Utility::getHrefFor('img/landscape/13.jpg')); ?>"  alt="Main Slide Image 1"   width="530px" height="370px">
                                        <p><a href="news.php">Moremi Hall of Residence on fire.</a></p>
                                    </div> <!-- /.slide-element -->
                                </div> <!--  /.item -->
                                <div class="item">
                                    <div class="slide-element">
                                        <img src="<?php echo(Utility::getHrefFor('img/landscape/19.jpg')); ?>" alt="Main Slide Image 1"  width="530px" height="370px">
                                        <p><a href="news.php">Best graduating student - Udeh Chikodili</a></p>
                                    </div> <!-- /.slide-element -->
                                </div> <!--  /.item -->

                                <div class="item">
                                    <div class="slide-element">
                                        <img src="<?php echo(Utility::getHrefFor('img/landscape/17.jpg')); ?>" alt="Main Slide Image 1" width="530px" height="370px">
                                        <p><a href="news.php">Latest arrivals from Doll house.</a></p>
                                    </div> <!-- /.slide-element -->
                                </div> <!--  /.item -->

                            </div> <!-- /.carousel-inner -->

                            <ol class="carousel-indicators">
                                <li data-target="#ccr-slide-main" data-slide-to="0" class="active"></li>
                                <li data-target="#ccr-slide-main" data-slide-to="1"></li>
                                <li data-target="#ccr-slide-main" data-slide-to="2"></li>
                                <li data-target="#ccr-slide-main" data-slide-to="3"></li>
                            </ol> <!-- /.carousel-indicators -->
                        </section>
                    </div>
                    <div class="col-md-6">
                        <div id="sideinfo">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="<?php echo(Utility::getHrefFor('img/portrait/14.jpg')); ?>" alt="Avatar"  height="60px" width="60px"align="left">

                                    <div id="channelnam">
                                        <span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-comment">200</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp; &nbsp;
                                        <br><a href="channel.php" id="channelname">OLOFOFO</a>
                                        <br><span><a href="news.php">Popular Fashion icon visits OAU</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="side-news">
                                <div class="col-md-12">
                                    <img src="<?php echo(Utility::getHrefFor('img/portrait/07.jpg')); ?>" alt="Avatar" height="60px" width="60px" align="left">
                                    <div id="channelnam">
                                        <span class="glyphicon glyphicon-thumbs-up">118</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-comment">86</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-thumbs-down">8</span>&nbsp; &nbsp;
                                        <br><a href="channel.php" id="channelname">FASHION</a>
                                        <br><span><a href="news.php">Blue and black dress causes controversy among students.</a></span>
                                    </div>
                                </div>
                            </div>


                            <div class="row" id="side-news">
                                <div class="col-md-12">
                                    <img src="<?php echo(Utility::getHrefFor('img/portrait/11.jpg')); ?>" alt="Avatar" height="60px" width="60px" align="left">
                                    <div id="channelnam">
                                        <span class="glyphicon glyphicon-thumbs-up">46</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-comment">102</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-thumbs-down">4</span>&nbsp; &nbsp;
                                        <br><a href="channel.php" id="channelname">OAU NEWS</a>
                                        <br><span><a href="news.php">Coming elections disrupt Student timetable.</a></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="side-news">
                                <div class="col-md-12">
                                    <img src="<?php echo(Utility::getHrefFor('img/portrait/13.jpg')); ?>" alt="Avatar" height="60px" width="60px" align="left">
                                    <div id="channelnam">
                                        <span class="glyphicon glyphicon-thumbs-up">110</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-comment">130</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp; &nbsp;
                                        <br><a href="channel.php" id="channelname">OLOFOFO</a>
                                        <br><span><a href="news.php">Funsho wins a car during the etisalat show.</a></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="side-news">
                                <div class="col-md-12">
                                    <img src="<?php echo(Utility::getHrefFor('img/portrait/09.jpg')); ?>" alt="Avatar" height="60px" width="60px" align="left">
                                    <div id="channelnam">
                                        <span class="glyphicon glyphicon-thumbs-up">110</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-comment">130</span>&nbsp; &nbsp;
                                        <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp; &nbsp;
                                        <br><a href="channel.php" id="channelname">OLOFOFO</a>
                                        <br><span><a href="news.php">Funsho wins a car during the etisalat show.</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <section >
                        <div class="ccr-gallery-ttile">
                            <span></span>
                            <p id="channelheading">NEONATA</p>
                        </div><!-- .ccr-gallery-ttile -->
                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/18.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">56</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">100</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">20</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ACADEMICS</a>
                                <br><a href="#postlink" id="link-font">Funsho wins a car during the etisalat show.</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/12.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Popular Fashion icon visits OAU Popular Fashion icon visits OAU</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/12.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">64</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">300</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">0</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">Wizkid Ayo Balogun storms OAU live.</a>

                            </div>
                            <div class="ccr-thumbnail col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/10.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">Coming elections disrupt Student timetable.</a>
                            </div>

                        </div>

                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/08.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">16</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">399</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">0</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">SPORTS</a>
                                <br><a href="#postlink" id="link-font">New cinema opens in Ile-ife</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/02.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">111</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Blue and black dress made by Ujunwa Irogbarachi causes controversy among students.</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/04.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">Funsho wins a car during the etisalat show.</a>
                            </div>

                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/04.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Popular Fashion icon visits OAU</a>
                            </div>
                        </div>
                    </section> <!--  /#ccr-latest-post-gallery  -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="trends">
                    <section >
                        <!-- .ccr-gallery-ttile -->

                        <p id="trendss">TRENDING</p>

                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-4 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/03.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">8</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">Fire Outbreak in Moremi hall</a>
                            </div>


                            <div class="ccr-thumbnail col-md-4 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/05.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">106</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">230</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Fashion takes new toll</a>
                            </div>


                            <div class="ccr-thumbnail col-md-4 col-xs-12">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/07.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
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
            <div class="row">
                <div class="col-md-12">
                    <section >
                        <div class="ccr-gallery-ttile">
                            <span></span>
                            <p id="channelheading">OAU GOSSIP</p>
                        </div><!-- .ccr-gallery-ttile -->


                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/09.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">Funsho wins a car during the etisalat show.</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/11.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Popular Fashion icon visits OAU Fashion icon visits OAU</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/15.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">Wizkid Ayo Balogun storms OAU live.</a>
                            </div>
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/17.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">Coming elections disrupt student timetable.</a>
                            </div>

                        </div>

                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/01.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">New cinema opens in Ile-ife</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/10.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Blue and black dress made by Ujunwa Irogbarachi causes controversy among students.</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/12.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">Funsho wins a car during the etisalat show.</a>
                            </div>

                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/18.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">Popular Fashion icon visits OAU</a>
                            </div>
                        </div>
                    </section> <!--  /#ccr-latest-post-gallery  -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <section >
                        <div class="ccr-gallery-ttile">
                            <span></span>
                            <p id="channelheading">FASHIONISTA</p>
                        </div><!-- .ccr-gallery-ttile -->


                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/10.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">Funsho wins a car during the etisalat show.</a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/06.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Popular Fashion icon visits OAU Fashion icon visits </a>
                            </div>


                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/08.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ACADEMICS</a>
                                <br><a href="#postlink" id="link-font">Wizkid Ayo Balogun storms OAU live.</a>
                            </div>
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/03.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">Coming elections disrupt student timetable.</a>
                            </div>

                        </div>

                        <div class="row" id="newsrow">
                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/18.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">OAU NEWS</a>
                                <br><a href="#postlink" id="link-font">New cinema opens in Ile-ife</a>
                            </div>

                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/04.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Blue and black dress made by Ujunwa Irogbarachi causes controversy among students.</a>
                            </div>

                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/01.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">ENTERTAINMENT</a>
                                <br><a href="#postlink" id="link-font">Funsho wins a car during the etisalat show.</a>
                            </div>

                            <div class="ccr-thumbnail col-md-3 col-md-3 col-xs-6">
                                <img src="<?php echo(Utility::getHrefFor('img/portrait/07.jpg')); ?>" alt="Thumbnail 1" height="100px" width="100px">
                                <div class="row" id="channelnam">
                                    <br><span class="glyphicon glyphicon-thumbs-up">146</span>&nbsp;
                                    <span class="glyphicon glyphicon-comment">200</span>&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down">10</span>&nbsp;
                                </div>
                                <a href="channel.php" id="channelname">FASHION</a>
                                <br><a href="#postlink" id="link-font">Popular Fashion icon visits OAU</a>
                            </div>
                        </div>
                    </section> <!--  /#ccr-latest-post-gallery  -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="btn btn-success" id="loadbutton">LOAD MORE</a>
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
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo(Utility::getHrefFor('js/jquery.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo(Utility::getHrefFor('js/bootstrap.min.js')); ?>"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>