<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$user = JFactory::getUser();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
?>
<!DOCTYPE html >
<html>
    <head>
        <title>Briarstone Building Inc.</title>
        <meta charset="UTF-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="templates/briarstone/css/main.css" media="screen">

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-6">
                    <jdoc:include type="modules" name="logo" style="xhtml" />
                </div>
                <div class="col-lg-10 col-md-10 col-sm-6">
                    <jdoc:include type="modules" name="mainmenu" style="xhtml" />
                </div>
            </div>
        </div>



        <div id="bodywrap" class='container'>
            <div class='row'>
                <div class='col-lg-12'>


                    <jdoc:include type="message" />
                    <jdoc:include type="component" />


                </div>
            </div>
        </div>
        <script type="text/css">

            .transition-timer-carousel .carousel-caption {
                background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 4%, rgba(0,0,0,0.5) 32%, rgba(0,0,0,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(4%,rgba(0,0,0,0.1)), color-stop(32%,rgba(0,0,0,0.5)), color-stop(100%,rgba(0,0,0,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
                width: 100%;
                left: 0px;
                right: 0px;
                bottom: 0px;
                text-align: left;
                padding-top: 5px;
                padding-left: 15%;
                padding-right: 15%;
            }
            .transition-timer-carousel .carousel-caption .carousel-caption-header {
                margin-top: 10px;
                font-size: 24px;
            }

            @media (min-width: 970px) {
                /* Lower the font size of the carousel caption header so that our caption
                doesn't take up the full image/slide on smaller screens */
                .transition-timer-carousel .carousel-caption .carousel-caption-header {
                    font-size: 36px;
                }
            }
            .transition-timer-carousel .carousel-indicators {
                bottom: 0px;
                margin-bottom: 5px;
            }
            .transition-timer-carousel .carousel-control {
                z-index: 11;
            }
            .transition-timer-carousel .transition-timer-carousel-progress-bar {
                height: 5px;
                background-color: #5cb85c;
                width: 0%;
                margin: -5px 0px 0px 0px;
                border: none;
                z-index: 11;
                position: relative;
            }
            .transition-timer-carousel .transition-timer-carousel-progress-bar.animate{
                /* We make the transition time shorter to avoid the slide transitioning
                before the timer bar is "full" - change the 4.25s here to fit your
                carousel's transition time */
                -webkit-transition: width 4.25s linear;
                -moz-transition: width 4.25s linear;
                -o-transition: width 4.25s linear;
                transition: width 4.25s linear;
            }

        </script>


        <div class='underNavIndex clearfix hidden-lg hidden-md hidden-sm'>
            <br /><br />
        </div>

        <!--id='sliderWrite'-->

        <div  class="container-fluid" >
            <div class="row ">
                <!-- The carousel -->
                <div id="transition-timer-carousel" class=" carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#transition-timer-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#transition-timer-carousel" data-slide-to="1"></li>
                        <li data-target="#transition-timer-carousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class='img-responsive center-block' src="templates/Briarstone/images/slider/panel_1.jpg" />
                        </div>

                        <div class="item">
                            <img class='img-responsive center-block' src="templates/Briarstone/images/slider/panel_2.jpg" />
                        </div>

                        <div class="item">
                            <img class='img-responsive center-block' src="templates/Briarstone/images/slider/panel_3.jpg" />
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#transition-timer-carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#transition-timer-carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                    <!--             Timer "progress bar"
                                <hr class="transition-timer-carousel-progress-bar animate" />-->
                </div>
            </div>
        </div>

        <div class="container indexContent">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <h1>Knowledge. Equipment. Experience.</h1>

                    <h3 class='textAdjust'>Bacon ipsum dolor amet prosciutto ham short loin beef ribs. Pork loin bacon ham shank, cupim filet mignon kevin tri-tip strip steak.</h3>

                    Bacon ipsum dolor amet prosciutto ham short loin beef ribs. Pork loin bacon ham shank, cupim filet mignon kevin tri-tip strip steak fatback tenderloin beef tongue doner. Ribeye ham hock pork belly, filet mignon turducken sirloin turkey bresaola. Shankle meatloaf beef ribs, hamburger turducken prosciutto cupim short ribs shoulder. Sirloin beef tenderloin cupim, bacon pig boudin.

                </div>
                <div class='col-lg-3 col-md-3 col-sm-3'>
                    <a href='history.php'><img class='img-responsive' src='images/company-history.jpg'></a>
                </div>
            </div>
        </div>

        <div class='clearfix'></div>
        <br /><br />

        <div class='container indexContent'>
            <div class='row'>
                <div class='col-sm-4'>
                    <ul>
                        <li id='equipment'><a href='equip.php'>Equipment</a></li>
                    </ul>
                    Bacon ipsum dolor amet prosciutto ham short loin beef ribs. Pork loin bacon ham shank, cupim filet mignon kevin tri-tip strip steak fatback tenderloin beef tongue doner. Ribeye ham hock pork belly, filet mignon turducken sirloin turkey bresaola. Shankle meatloaf beef ribs, hamburger turducken prosciutto cupim short ribs shoulder. Sirloin beef tenderloin cupim, bacon pig boudin.
                </div>
                <div class='col-sm-4'>
                    <ul>
                        <li id='products'><a href='photo.php'>Product Samples</a></li>
                    </ul>
                    Bacon ipsum dolor amet prosciutto ham short loin beef ribs. Pork loin bacon ham shank, cupim filet mignon kevin tri-tip strip steak fatback tenderloin beef tongue doner. Ribeye ham hock pork belly, filet mignon turducken sirloin turkey bresaola. Shankle meatloaf beef ribs, hamburger turducken prosciutto cupim short ribs shoulder. Sirloin beef tenderloin cupim, bacon pig boudin.
                </div>
                <div class='col-sm-4'>
                    <ul>
                        <li id='employment'><a href='employ.php'>Employment</a></li>
                    </ul>
                    Bacon ipsum dolor amet prosciutto ham short loin beef ribs. Pork loin bacon ham shank, cupim filet mignon kevin tri-tip strip steak fatback tenderloin beef tongue doner. Ribeye ham hock pork belly, filet mignon turducken sirloin turkey bresaola. Shankle meatloaf beef ribs, hamburger turducken prosciutto cupim short ribs shoulder. Sirloin beef tenderloin cupim, bacon pig boudin.
                </div>
            </div>
        </div>

        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>

                </div>
            </div>
        </div>
    </div>

    <div id='footer' class="container-fluid image-responsive" >
        <div class="container">
            <div class="row" >
                <div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
                    <a href='history.php'><h1 class="footTitle">About</h1></a>
                    <hr />
                    <p class='footText'>Instrumental Machine & Development (IMD) was founded in 1991, originally located in Milford, Indiana. In the fall of 1992, the need for more manufacturing space provided the opportunity for IMD to move to Warsaw, Indiana.</p>
                </div>

                <div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
                    <a href='contact.php'><h1 class="footTitle">Contact Us</h1></a>
                    <hr />
                    <p class='footText'>INSTRUMENTAL MACHINE & DEVELOPMENT<br />
                        2098 N. Pound Drive, West<br />
                        Warsaw, Indiana 46582<br />
                        <br />
                        Phone: 574-267-7713<br />
                        Fax: 574-267-2551</p>
                </div>
            </div>
        </div>
    </div>


    <div class='container-fluid footerBar'>
        <div class="row">
            <div class="footCopyrightText col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-8 col-md-8 col-sm-6 col-xs-5">
                © 2014 Instrumental Machine & Development, Inc. All Rights Reserved.
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 nwrap">
                <a href="https://www.facebook.com/pages/Instrumental-Machine-Development-Inc/116956151744466"><img class='pull-right' src='images/fbicon.png'></a>
                <a href="http://www.anab.org/"><img class='pull-right footBadgeSpace' src='images/anabicon.png'></a>
                <a href="images/ISO_Cert.pdf"><img class='pull-right' src='images/pjicon.png'></a>
            </div>
        </div>
    </div>
</body>
</html>


