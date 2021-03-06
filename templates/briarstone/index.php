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

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' . $this->template . '/js/template.js');
// Add Stylesheets
$doc->addStyleSheet('templates/' . $this->template . '/css/template.css');
// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);
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
    <jdoc:include type="head" />
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
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <jdoc:include type="modules" name="logo" style="xhtml" />
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <jdoc:include type="modules" name="mainmenu" style="xhtml" />
            </div>
        </div>
    </div>


    <div  class="container-fluid" id="slider-wrap" >
        <div class="row ">
            <jdoc:include type="modules" name="slider" style="xhtml" />
        </div>
    </div>

    <div class="container indexContent">
        <div class="row">
            <?php if ($this->countModules('rightsidebar')) : ?>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                </div>
                <div class='col-lg-4 col-md-4 col-sm-4'>
                    <jdoc:include type="modules" name="rightsidebar" style="xhtml" />
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class='clearfix'></div>
    <br /><br />

    <div class='container indexContent'>
        <div class='row'>
            <div class='col-sm-4'>
                <jdoc:include type="modules" name="contentbottom-1" style="xhtml" />
            </div>
            <div class='col-sm-4'>
                <jdoc:include type="modules" name="contentbottom-2" style="xhtml" />
            </div>
            <div class='col-sm-4'>
                <jdoc:include type="modules" name="contentbottom-3" style="xhtml" />
            </div>
        </div>
    </div>

</div>

<div id='footer' class="container-fluid img-responsive" >
    <div class="container">
        <div class="row" >
            <div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
                <jdoc:include type="modules" name="footer-1" style="xhtml" />
            </div>

            <div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
                <jdoc:include type="modules" name="footer-2" style="xhtml" />
            </div>

            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <jdoc:include type="modules" name="footer-3" style="xhtml" />
            </div>
        </div>
    </div>
</div>
<div class='container-fluid footerBar'>
    <div class="row">
        <div class="footCopyrightText col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-8 col-md-8 col-sm-6 col-xs-5">
            <jdoc:include type="modules" name="copyright" style="xhtml" />
            <div style="float: left;">
                &copy; <?php echo date('Y'); ?> Briarstone Building, Inc. All Rights Reserved.
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 nwrap pull-right">
            <jdoc:include type="modules" name="socialbar" style="xhtml" />
        </div>
    </div>
</div>
</body>
</html>


