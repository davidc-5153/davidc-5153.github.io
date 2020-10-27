<?php
    session_start();

    /**
     * Website for Pianeta Hair Design
     * Framework: Bootstrap 3
     * @see http://getbootstrap.com/
     * 
     * @author David Ceccato
     * @version 2017
     * @copyright (c) 2017, Pianeta Hair Design, All Rights Reserved
     * @depends Desktop:
     *                  Chrome: (Current - 1) and Current
     *                  Edge: (Current - 1) and Current
     *                  Firefox: (Current - 1) and Current
     *                  Internet Explorer: 9+
     *                  Safari: (Current - 1) and Current
     *                  Opera: Current
     *          Mobile:
     *                  Stock browser on Android 4.0+
     *                  Safari on iOS 7+
     */

    // Error reporting
    /*
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(E_ALL|E_STRICT);
    ini_set('error_log','error.log');
    ini_set('log_errors','On');
    */

    require_once __DIR__.'/define.php';
    require_once __DIR__.'/_/php/slides.php';
    require_once __DIR__.'/_/php/products.php';
    require_once __DIR__.'/_/php/sanitize.php';
    require_once __DIR__.'/_/php/pricing.php';

    // Set Caching
    header("Cache-Control: max-age=1209600"); // 14days (60sec * 60min * 24hours * 14days)

?>

<!DOCTYPE html>
<html id="PianetaHairDesign.com.au" lang="en" prefix="og: http://ogp.me/ns#">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="title" content="<?php echo PHP_MAIN_TITLE; ?>" />
        <meta name="language" CONTENT="English" />
        <meta name="google" content="notranslate" />
        <meta name="Pianeta Hair Design" content="<?php echo PHP_MAIN_TITLE; ?>" />
        <meta name="description" content="<?php echo PHP_MAIN_DESCRIPTION; ?>" />
        <meta name="classification" CONTENT="<?php echo PHP_MAIN_CLASSIFICATION; ?>">
        <meta name="author" content="Pianeta Hair Design" />
        <meta name="subject" CONTENT="Hair Salon" />
        <meta name="keywords" content="<?php echo PHP_MAIN_KEYWORDS; ?>" />
        <meta name="robots" content="index, nofollow" />
        <meta name="revisit-after" content="1 month" />
        <meta name="geography" CONTENT="Norwest Marketown, Shop T9, 4 Century Cct, Baulkham Hills, NSW, 2153" />
        <meta name="city" CONTENT="Castle Hill" />
        <meta name="zipcode" CONTENT="2154" />
        <meta name="country" CONTENT="Australia" />
        <meta name="geo.region" content="AU-NSW" />
        <meta name="geo.placename" content="Castle Hill" />
        <meta name="geo.position" content="-33.733676;150.980929" />
        <meta http-equiv="Cache-control" CONTENT="public" />
        <meta name="copyright" CONTENT="Copyright Pianeta Hair Design. All rights reserved." />
        <meta name="designer" CONTENT="Pianeta Hair Design" />
        <meta name="publisher" CONTENT="Pianeta Hair Design" />

        <link rel="author" href="https://PianetaHairDesign.com.au"/>
        <link rel="publisher" href="https://PianetaHairDesign.com.au"/>
        <!-- <link rel="alternate" href="https://PianetaHairDesign.com.au" hreflang="en-au" /> -->
        
        <link rel="shortcut icon" href="_/icons/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" sizes="57x57" href="_/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="_/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="_/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="_/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="_/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="_/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="_/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="_/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="_/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="_/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="_/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="_/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="_/icons/favicon-16x16.png">
        <link rel="manifest" href="_/icons/manifest.json">
        <meta name="application-name" content="Pianeta Hair Design" /> 
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="_/icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
	<meta property="og:url"           content="https://PianetaHairDesign.com.au" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<?php echo PHP_MAIN_TITLE; ?>" />
	<meta property="og:description"   content="<?php echo PHP_MAIN_DESCRIPTION; ?>" />
	<meta property="og:image"         content="https://pianetahairdesign.com.au/og-image.jpg" />
        <meta property="og:site_name" content="Pianeta Hair Design" />
	<meta property="fb:admins" content="172148699479935" />

        <meta name="twitter:card" content="summary" />
	<meta name="twitter:url" content="https://PianetaHairDesign.com.au" />
	<meta name="twitter:title" content="<?php echo PHP_MAIN_TITLE; ?>" />
	<meta name="twitter:description" content="<?php echo PHP_MAIN_DESCRIPTION; ?>" />
	<meta name="twitter:image" content="https://pianetahairdesign.com.au/pianeta-logo.png" />

        <!--[if lt IE 9]>
            <style>
                #ltie9 {
                    display: block !important; 
                }
            </style>
        <![endif]-->
        
        <!-- ***************** LOAD CRITICAL CSS ************************** --> 
        <style>
            html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}body{margin:0}footer,nav,section{display:block}a{background-color:transparent}strong{font-weight:700}h1{margin:.67em 0;font-size:2em}small{font-size:80%}img{border:0}button,input,textarea{margin:0;font:inherit;color:inherit}button{overflow:visible}button{text-transform:none}button{-webkit-appearance:button}button::-moz-focus-inner,input::-moz-focus-inner{padding:0;border:0}input{line-height:normal}textarea{overflow:auto}table{border-spacing:0;border-collapse:collapse}td{padding:0}@font-face{font-family:'Glyphicons Halflings';src:url(_/fonts/glyphicons-halflings-regular.eot);src:url(_/fonts/glyphicons-halflings-regular.eot?#iefix) format('embedded-opentype'),url(_/fonts/glyphicons-halflings-regular.woff2) format('woff2'),url(_/fonts/glyphicons-halflings-regular.woff) format('woff'),url(_/fonts/glyphicons-halflings-regular.ttf) format('truetype'),url(_/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format('svg')}.glyphicon{position:relative;top:1px;display:inline-block;font-family:'Glyphicons Halflings';font-style:normal;font-weight:400;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.glyphicon-plus:before{content:"\002b"}.glyphicon-minus:before{content:"\2212"}.glyphicon-envelope:before{content:"\2709"}.glyphicon-user:before{content:"\e008"}.glyphicon-ok:before{content:"\e013"}.glyphicon-remove:before{content:"\e014"}.glyphicon-time:before{content:"\e023"}.glyphicon-chevron-left:before{content:"\e079"}.glyphicon-chevron-right:before{content:"\e080"}.glyphicon-calendar:before{content:"\e109"}.glyphicon-comment:before{content:"\e111"}.glyphicon-phone-alt:before{content:"\e183"}.glyphicon-scissors:before{content:"\e226"}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px}body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}button,input,textarea{font-family:inherit;font-size:inherit;line-height:inherit}a{color:#337ab7;text-decoration:none}img{vertical-align:middle}.carousel-inner>.item>img{display:block;max-width:100%;height:auto}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0}h1,h3,h4,h5{font-family:inherit;font-weight:500;line-height:1.1;color:inherit}h1,h3{margin-top:20px;margin-bottom:10px}h4,h5{margin-top:10px;margin-bottom:10px}h1{font-size:36px}h3{font-size:24px}h4{font-size:18px}h5{font-size:14px}p{margin:0 0 10px}small{font-size:85%}.text-center{text-align:center}.text-muted{color:#777}ol,ul{margin-top:0;margin-bottom:10px}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media(min-width:768px){.container{width:750px}}@media(min-width:992px){.container{width:970px}}@media(min-width:1200px){.container{width:1170px}}.row{margin-right:-15px;margin-left:-15px}.col-sm-10,.col-sm-2,.col-sm-6,.col-xs-12{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.col-xs-12{float:left}.col-xs-12{width:100%}@media(min-width:768px){.col-sm-10,.col-sm-2,.col-sm-6{float:left}.col-sm-10{width:83.33333333%}.col-sm-6{width:50%}.col-sm-2{width:16.66666667%}.col-sm-offset-3{margin-left:25%}.col-sm-offset-2{margin-left:16.66666667%}}table{background-color:transparent}.table{width:100%;max-width:100%;margin-bottom:20px}.table>tbody>tr>td{padding:8px;line-height:1.42857143;vertical-align:top;border-top:1px solid #ddd}.table-bordered{border:1px solid #ddd}.table-bordered>tbody>tr>td{border:1px solid #ddd}.table-striped>tbody>tr:nth-of-type(odd){background-color:#f9f9f9}.table-responsive{min-height:.01%;overflow-x:auto}@media screen and (max-width:767px){.table-responsive{width:100%;margin-bottom:15px;overflow-y:hidden;-ms-overflow-style:-ms-autohiding-scrollbar;border:1px solid #ddd}.table-responsive>.table{margin-bottom:0}.table-responsive>.table>tbody>tr>td{white-space:nowrap}.table-responsive>.table-bordered{border:0}.table-responsive>.table-bordered>tbody>tr>td:first-child{border-left:0}.table-responsive>.table-bordered>tbody>tr>td:last-child{border-right:0}.table-responsive>.table-bordered>tbody>tr:last-child>td{border-bottom:0}}label{display:inline-block;max-width:100%;margin-bottom:5px;font-weight:700}.form-control{display:block;width:100%;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075)}.form-control::-moz-placeholder{color:#999;opacity:1}.form-control:-ms-input-placeholder{color:#999}.form-control::-webkit-input-placeholder{color:#999}.form-control::-ms-expand{background-color:transparent;border:0}.form-control[disabled]{background-color:#eee;opacity:1}textarea.form-control{height:auto}.form-group{margin-bottom:15px}.has-feedback{position:relative}.has-feedback .form-control{padding-right:42.5px}.form-control-feedback{position:absolute;top:0;right:0;z-index:2;display:block;width:34px;height:34px;line-height:34px;text-align:center}.help-block{display:block;margin-top:5px;margin-bottom:10px;color:#737373}.form-horizontal .form-group{margin-right:-15px;margin-left:-15px}@media(min-width:768px){.form-horizontal .control-label{padding-top:7px;margin-bottom:0;text-align:right}}.form-horizontal .has-feedback .form-control-feedback{right:15px}.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;background-image:none;border:1px solid transparent;border-radius:4px}.btn[disabled]{filter:alpha(opacity=65);-webkit-box-shadow:none;box-shadow:none;opacity:.65}.btn-default{color:#333;background-color:#fff;border-color:#ccc}.btn-default .badge{color:#fff;background-color:#333}.btn-primary{color:#fff;background-color:#337ab7;border-color:#2e6da4}.btn-sm{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.fade{opacity:1}.collapse{display:none}.input-group{position:relative;display:table;border-collapse:separate}.input-group .form-control{position:relative;z-index:2;float:left;width:100%;margin-bottom:0}.input-group .form-control,.input-group-addon{display:table-cell}.input-group .form-control:not(:first-child):not(:last-child){border-radius:0}.input-group-addon{width:1%;white-space:nowrap;vertical-align:middle}.input-group-addon{padding:6px 12px;font-size:14px;font-weight:400;line-height:1;color:#555;text-align:center;background-color:#eee;border:1px solid #ccc;border-radius:4px}.input-group-addon:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.input-group-addon:first-child{border-right:0}.input-group .form-control:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.nav{padding-left:0;margin-bottom:0;list-style:none}.nav>li{position:relative;display:block}.nav>li>a{position:relative;display:block;padding:10px 15px}.navbar{position:relative;min-height:50px;margin-bottom:20px;border:1px solid transparent}@media(min-width:768px){.navbar{border-radius:4px}}@media(min-width:768px){.navbar-header{float:left}}.navbar-collapse{padding-right:15px;padding-left:15px;overflow-x:visible;-webkit-overflow-scrolling:touch;border-top:1px solid transparent;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.1);box-shadow:inset 0 1px 0 rgba(255,255,255,.1)}@media(min-width:768px){.navbar-collapse{width:auto;border-top:0;-webkit-box-shadow:none;box-shadow:none}.navbar-collapse.collapse{display:block!important;height:auto!important;padding-bottom:0;overflow:visible!important}.navbar-fixed-top .navbar-collapse{padding-right:0;padding-left:0}}.navbar-fixed-top .navbar-collapse{max-height:340px}@media(max-device-width:480px) and (orientation:landscape){.navbar-fixed-top .navbar-collapse{max-height:200px}}.container>.navbar-collapse,.container>.navbar-header{margin-right:-15px;margin-left:-15px}@media(min-width:768px){.container>.navbar-collapse,.container>.navbar-header{margin-right:0;margin-left:0}}.navbar-fixed-top{position:fixed;right:0;left:0;z-index:1030}@media(min-width:768px){.navbar-fixed-top{border-radius:0}}.navbar-fixed-top{top:0;border-width:0 0 1px}.navbar-brand{float:left;height:50px;padding:15px 15px;font-size:18px;line-height:20px}.navbar-brand>img{display:block}@media(min-width:768px){.navbar>.container .navbar-brand{margin-left:-15px}}.navbar-toggle{position:relative;float:right;padding:9px 10px;margin-top:8px;margin-right:15px;margin-bottom:8px;background-color:transparent;background-image:none;border:1px solid transparent;border-radius:4px}.navbar-toggle .icon-bar{display:block;width:22px;height:2px;border-radius:1px}.navbar-toggle .icon-bar+.icon-bar{margin-top:4px}@media(min-width:768px){.navbar-toggle{display:none}}.navbar-nav{margin:7.5px -15px}.navbar-nav>li>a{padding-top:10px;padding-bottom:10px;line-height:20px}@media(min-width:768px){.navbar-nav{float:left;margin:5px 0 0 0}.navbar-nav>li{float:left}.navbar-nav>li>a{padding-top:15px;padding-bottom:15px}}.navbar-default{background-color:#f8f8f8;border-color:#e7e7e7}.navbar-default .navbar-brand{color:#777}.navbar-default .navbar-nav>li>a{color:#777}.navbar-default .navbar-nav>.active>a{color:#555;background-color:#e7e7e7;border-radius:4px}.navbar-default .navbar-toggle{border-color:#ddd}.navbar-default .navbar-toggle .icon-bar{background-color:#888}.navbar-default .navbar-collapse{border-color:#e7e7e7}.badge{display:inline-block;min-width:10px;padding:3px 7px;font-size:12px;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:middle;background-color:#777;border-radius:10px}.btn .badge{position:relative;top:-1px}.jumbotron{padding-top:30px;padding-bottom:30px;margin-bottom:30px;color:inherit;background-color:#eee}.jumbotron p{margin-bottom:15px;font-size:21px;font-weight:200}.container .jumbotron{padding-right:15px;padding-left:15px;border-radius:6px}.jumbotron .container{max-width:100%}@media screen and (min-width:768px){.jumbotron{padding-top:48px;padding-bottom:48px}.container .jumbotron{padding-right:60px;padding-left:60px}}.thumbnail{display:block;padding:4px;margin-bottom:20px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px}.thumbnail .caption{padding:9px;color:#333}.panel-body{padding:15px}.panel-group .panel-heading+.panel-collapse>.panel-body{border-top:1px solid #ddd}.panel-default>.panel-heading+.panel-collapse>.panel-body{border-top-color:#ddd}.close{float:right;font-size:21px;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;filter:alpha(opacity=20);opacity:.2}button.close{-webkit-appearance:none;padding:0;background:0;border:0}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0}.modal.fade .modal-dialog{-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);-o-transform:translate(0,-25%);transform:translate(0,-25%)}.modal-dialog{position:relative;width:auto;margin:10px}.modal-content{position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #999;border:1px solid rgba(0,0,0,.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5)}.modal-header{padding:15px;border-bottom:1px solid #e5e5e5}.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.42857143}.modal-body{position:relative;padding:15px}.modal-footer{padding:15px;text-align:right;border-top:1px solid #e5e5e5}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}@media(min-width:768px){.modal-dialog{width:600px;margin:30px auto}.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5)}}@media(min-width:992px){.modal-lg{width:900px}}.carousel{position:relative}.carousel-inner{position:relative;width:100%;overflow:hidden}.carousel-inner>.item{position:relative;display:none}.carousel-inner>.item>img{line-height:1}@media all and (transform-3d),(-webkit-transform-3d){.carousel-inner>.item{-webkit-backface-visibility:hidden;backface-visibility:hidden;-webkit-perspective:1000px;perspective:1000px}.carousel-inner>.item.active{left:0;-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}}.carousel-inner>.active{display:block}.carousel-inner>.active{left:0}.carousel-control{position:absolute;top:0;bottom:0;left:0;width:15%;font-size:20px;color:#fff;text-align:center;text-shadow:0 1px 2px rgba(0,0,0,.6);background-color:rgba(0,0,0,0);filter:alpha(opacity=50);opacity:.5}.carousel-control.left{background-image:-webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);background-image:-o-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);background-image:-webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,.0001)));background-image:linear-gradient(to right,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000',endColorstr='#00000000',GradientType=1);background-repeat:repeat-x}.carousel-control.right{right:0;left:auto;background-image:-webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);background-image:-o-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);background-image:-webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.0001)),to(rgba(0,0,0,.5)));background-image:linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000',endColorstr='#80000000',GradientType=1);background-repeat:repeat-x}.carousel-control .glyphicon-chevron-left,.carousel-control .glyphicon-chevron-right{position:absolute;top:50%;z-index:5;display:inline-block;margin-top:-10px}.carousel-control .glyphicon-chevron-left{left:50%;margin-left:-10px}.carousel-control .glyphicon-chevron-right{right:50%;margin-right:-10px}.carousel-indicators{position:absolute;bottom:10px;left:50%;z-index:15;width:60%;padding-left:0;margin-left:-30%;text-align:center;list-style:none}.carousel-indicators li{display:inline-block;width:10px;height:10px;margin:1px;text-indent:-999px;background-color:#000\9;background-color:rgba(0,0,0,0);border:1px solid #fff;border-radius:10px}.carousel-indicators .active{width:12px;height:12px;margin:0;background-color:#fff}@media screen and (min-width:768px){.carousel-control .glyphicon-chevron-left,.carousel-control .glyphicon-chevron-right{width:30px;height:30px;margin-top:-10px;font-size:30px}.carousel-control .glyphicon-chevron-left{margin-left:-10px}.carousel-control .glyphicon-chevron-right{margin-right:-10px}.carousel-indicators{bottom:20px}}.clearfix:after,.clearfix:before,.container:after,.container:before,.form-horizontal .form-group:after,.form-horizontal .form-group:before,.modal-footer:after,.modal-footer:before,.modal-header:after,.modal-header:before,.nav:after,.nav:before,.navbar-collapse:after,.navbar-collapse:before,.navbar-header:after,.navbar-header:before,.navbar:after,.navbar:before,.panel-body:after,.panel-body:before,.row:after,.row:before{display:table;content:" "}.clearfix:after,.container:after,.form-horizontal .form-group:after,.modal-footer:after,.modal-header:after,.nav:after,.navbar-collapse:after,.navbar-header:after,.navbar:after,.panel-body:after,.row:after{clear:both}.center-block{display:block;margin-right:auto;margin-left:auto}.pull-right{float:right!important}.pull-left{float:left!important}.hidden{display:none!important}@-ms-viewport{width:device-width}.visible-xs-inline{display:none!important}@media(max-width:767px){.visible-xs-inline{display:inline!important}}@media(max-width:767px){.hidden-xs{display:none!important}}@media(min-width:768px) and (max-width:991px){.hidden-sm{display:none!important}}.btn-default,.btn-primary{text-shadow:0 -1px 0 rgba(0,0,0,.2);-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.15),0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 0 rgba(255,255,255,.15),0 1px 1px rgba(0,0,0,.075)}.btn-primary[disabled]{-webkit-box-shadow:none;box-shadow:none}.btn-default .badge{text-shadow:none}.btn-default{text-shadow:0 1px 0 #fff;background-image:-webkit-linear-gradient(top,#fff 0,#e0e0e0 100%);background-image:-o-linear-gradient(top,#fff 0,#e0e0e0 100%);background-image:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#e0e0e0));background-image:linear-gradient(to bottom,#fff 0,#e0e0e0 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe0e0e0',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);background-repeat:repeat-x;border-color:#dbdbdb;border-color:#ccc}.btn-primary{background-image:-webkit-linear-gradient(top,#337ab7 0,#265a88 100%);background-image:-o-linear-gradient(top,#337ab7 0,#265a88 100%);background-image:-webkit-gradient(linear,left top,left bottom,from(#337ab7),to(#265a88));background-image:linear-gradient(to bottom,#337ab7 0,#265a88 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7',endColorstr='#ff265a88',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);background-repeat:repeat-x;border-color:#245580}.btn-primary[disabled]{background-color:#265a88;background-image:none}.thumbnail{-webkit-box-shadow:0 1px 2px rgba(0,0,0,.075);box-shadow:0 1px 2px rgba(0,0,0,.075)}.navbar-default{background-image:-webkit-linear-gradient(top,#fff 0,#f8f8f8 100%);background-image:-o-linear-gradient(top,#fff 0,#f8f8f8 100%);background-image:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#f8f8f8));background-image:linear-gradient(to bottom,#fff 0,#f8f8f8 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#fff8f8f8',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);background-repeat:repeat-x;border-radius:4px;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.15),0 1px 5px rgba(0,0,0,.075);box-shadow:inset 0 1px 0 rgba(255,255,255,.15),0 1px 5px rgba(0,0,0,.075)}.navbar-default .navbar-nav>.active>a{background-image:-webkit-linear-gradient(top,#dbdbdb 0,#e2e2e2 100%);background-image:-o-linear-gradient(top,#dbdbdb 0,#e2e2e2 100%);background-image:-webkit-gradient(linear,left top,left bottom,from(#dbdbdb),to(#e2e2e2));background-image:linear-gradient(to bottom,#dbdbdb 0,#e2e2e2 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdbdbdb',endColorstr='#ffe2e2e2',GradientType=0);background-repeat:repeat-x;-webkit-box-shadow:inset 0 3px 9px rgba(0,0,0,.075);box-shadow:inset 0 3px 9px rgba(0,0,0,.075)}.navbar-brand,.navbar-nav>li>a{text-shadow:0 1px 0 rgba(255,255,255,.25)}.navbar-fixed-top{border-radius:0}html,body{overflow-x:hidden;font-family:'Droid Serif',serif}body{position:relative;height:100%;width:100%;color:#555;background-color:#fcfcfc}body#HOME{padding-right:0!important}table tbody tr td{vertical-align:top;padding:.5rem}table td{white-space:nowrap}a{outline:0}a:visited,a:link{text-decoration:none;color:#612c7c}small{color:#888;font-size:75%}.section{padding-top:40px;padding-bottom:40px;overflow-x:hidden}h1{background-color:#ac88be;background-image:linear-gradient(to bottom,#ac88be 0,#612c7c 100%);border:1px solid #999;padding:10px 15px;border-radius:6px;color:#fff;text-shadow:1px 1px 2px #000;text-align:center}label{white-space:nowrap}.form-control{height:auto}.navbar-default{background-color:#e5e5e5;background-image:-webkit-linear-gradient(top,#fff 0,#e5e5e5 100%);background-image:-o-linear-gradient(top,#fff 0,#f8f8f8 100%);background-image:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#e5e5e5));background-image:linear-gradient(to bottom,#fff 0,#e5e5e5 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe5e5e5',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false)}.nav>li>a{padding-left:13px;padding-right:13px}button.navbar-toggle.booking-button{padding:6px}a.navbar-brand>img{margin-top:-6px;margin-right:15px}table.center-block{display:table}.jumbotron{margin-top:0;margin-bottom:10px;background-repeat:no-repeat;background-position:top center;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;background-attachment:fixed;z-index:-1}.container .jumbotron{padding-left:0;padding-right:0;overflow-x:auto}.jumbotron p{font-weight:bold}.btn,.btn:visited{outline:0;background-color:#DDD}.btn-primary,.btn-primary:visited,button.navbar-toggle.btn.btn-primary.booking-button{color:#fff;background-image:linear-gradient(to bottom,#ac88be 0,#612c7c 100%);background-color:#612c7c;border-color:#555}.btn-primary[disabled]{background-color:#777}.footer{position:fixed;bottom:0;width:100%;background-color:#e5e5e5;background-image:-webkit-linear-gradient(top,#fff 0,#e5e5e5 100%);background-image:-o-linear-gradient(top,#fff 0,#f8f8f8 100%);background-image:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#e5e5e5));background-image:linear-gradient(to bottom,#fff 0,#e5e5e5 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe5e5e5',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);background-repeat:repeat-x;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.15),0 -1px 5px rgba(0,0,0,.075);box-shadow:inset 0 1px 0 rgba(255,255,255,.15),0 -1px 5px rgba(0,0,0,.075);padding:5px;z-index:98}.footer .block{display:inline-block;width:50%;vertical-align:middle}.footer .container{white-space:nowrap;overflow:hidden}.footer .block.left{text-align:left}.footer .block.right{text-align:right}.footer p{margin:0}.misc-content,.misc-content p{font-size:10px;color:#777}.carousel-inner>.item>img{display:block;width:100%;height:auto}img.logo{max-width:75%}#logo-micro{display:none}span.glyphicon{padding-left:1rem;padding-right:1rem}#map_canvas img{width:100%}#map-outer{height:350px;width:100%}#map_canvas{height:100%;width:100%}#changeMap{background-color:#777;display:block;padding:.1em .5em;position:absolute;margin-top:1%;margin-left:1%;z-index:99;color:#fff;border-radius:3px}#BOOKING{display:none;padding-top:50px;padding-bottom:50px;z-index:50;background-color:#fcfcfc;top:-100%;left:0;height:100%;width:100%;overflow-y:auto;opacity:0}#BOOKING .jumbotron{padding-top:15px;padding-bottom:0}#BOOKING button.close{position:relative;top:-15px}#formBooking{padding-top:15px}#chosenServices label{text-align:left;margin-bottom:5px}#bookingServicePills .service{display:inline-block;white-space:nowrap}div.service{margin:10px}div.service button.btn{width:18.5em}.booking-button-desktop{display:block;position:fixed;right:15px;top:8px}.button-text{vertical-align:text-top;padding-left:1em;font-weight:bold}input#bookingDate,input#bookingTime{background-color:#fff}input#bookingTime2,input#bookingTime3{background-color:#fdfdfd}input#bookingTime:disabled,input#bookingTime2:disabled,input#bookingTime3:disabled{background-color:#ddd}#selectedServices-modal-button .badge{top:3px;margin-right:5px}#selectedServices-modal-button.btn-default .badge{display:none}div#selectServices{height:auto;overflow-y:auto;max-height:15em;text-align:center;border-top-right-radius:0;border-top-left-radius:0;border-top:0;padding-left:.5em}div.service .badge{margin-left:-70px;position:relative}#booking-services-glyph{border-bottom-left-radius:0}#booking-services-title{background-color:#eee;border-bottom-right-radius:0;overflow:hidden;white-space:nowrap}span.badge.zero{background-color:#bbb;color:#eee}span.pill-text{padding-top:2px;display:inline-block;padding-right:5px}span.pill-modify{border:1px solid #eee;border-radius:4px;padding:5px;margin:5px 4px 5px 0}span.pill-count{padding:0 8px 0 4px}div#modal-selected-services,div#bookingHelp{height:7em;overflow-y:auto;border-radius:6px;border:1px inset #ddd;padding:.5em;background-color:#f9f9f9}@media only screen and (max-width :300px){#logo-small{display:none}#logo-micro{display:block;position:fixed}}
        </style>
        
        <title><?php echo PHP_MAIN_TITLE; ?></title>
    
        <?php 
            /* *** DC *** Facebook Pixel Code removed
            <!-- Facebook Pixel Code -->
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '143744492897085');
                fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=143744492897085&ev=PageView&noscript=1"/></noscript>
            <!-- End Facebook Pixel Code -->
            */
        ?>
        <!-- Global site tag (gtag.js) - Google Ads: 987012530 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-987012530"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'AW-987012530');
        </script>

    </head>

    <body id="HOME" data-spy="scroll" data-target="nav.navbar.active">
        
        <!--*********************** LT IE 9 Warning ************************-->
        <div id="ltie9" style="display: none; position: fixed; background-color: red; text-align: center; width: 100%; z-index: 999999;">
            <h1>This site has been designed a modern web browser.</h1>
            <h1>A simple version of this site can be viewed <strong><a href="basic.php" rel="nofollow">here</a></strong>.</h1>
        </div>
        
        <!--**************************** NAVBAR ****************************-->
        <nav class="navbar navbar-default navbar-fixed-top active">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bd-main-nav" aria-expanded="false">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="navbar-toggle btn btn-primary booking-button" onclick="toggleBooking();">
                        <span class="sr-only">Book</span>
                        <span class="glyphicon glyphicon-scissors"></span>
                    </button>
                    <a id="logo-small" class="navbar-brand" href="/"><img src="_/img/logo-small.png" alt="Pianeta"/></a>
                    <a id="logo-micro" class="navbar-brand" href="/"><img src="_/img/logo-micro.png" alt="Pianeta"/></a>
                </div>
                <div class="collapse navbar-collapse" id="bd-main-nav">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="#HOME" onclick="scrollToElement(null,this.hash,0);">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li>
                            <a href="#ABOUT-US" onclick="scrollToElement(null,this.hash,0);">About Us</a>
                        </li>
                        <li>
                            <a href="#CONTACT-US" onclick="scrollToElement(null,this.hash,0);">Contact Us</a>
                        </li>
                        <li>
                            <a href="#SERVICES" onclick="scrollToElement(null,this.hash,0);">Services</a>
                        </li>
                        <li>
                            <a href="#PRODUCTS" onclick="scrollToElement(null,this.hash,0);">Products</a>
                        </li>
                        <li>
                            <a href="#INFORMATION" onclick="scrollToElement(null,this.hash,0);">Information</a>
                        </li>
                    </ul>
                </div>
                <button type="button" class="hidden-xs btn btn-primary booking-button booking-button-desktop" onclick="toggleBooking();">
                    <span class="glyphicon glyphicon-scissors"><span class="hidden-sm button-text">Book Online</span></span>
                </button>
            </div>
        </nav>

        <div id="CONTENT">
            
            <!--**************************** CAROUSEL ****************************-->
            <section id="CAROUSEL" class="section">
                <?php 
                    bootstrapSlideshow();
                ?>
            </section>

            <!--***************************** Logo *******************************-->
            <section id="LOGO" class="section animate fadeIn">
                <div class="container text-center">
                    <img class="logo lazyload" src="_/img/logo.small.jpg" data-src="_/img/logo.large.jpg" alt="Pianeta Hair Design"/>
                    <h3>
                        <a href="tel:0298944247" class="phone">(02) 9894 <span class="animatePhone">4247</span></a>
                    </h3>
                    <h3>
                        <a href="geo:-33.7333859,150.9625141">
                            Norwest Marketown<br/>
                            Shop T9, 4 Century Cct<br/>
                            Baulkham Hills, NSW, 2153
                        </a>
                    </h3>
                    <?php // include("content/christmas-closures.php"); // *** XMAS *** ?>
                </div>
            </section>

            <!--********************** JUMBOTRON: About Us ***********************-->
            <section id="ABOUT-US" class="section">
                <div class="jumbotron content parallax" style="background-image: url(_/img/about-us.small.jpg)">
                    <div class="container">
                        <div class="content-inner animate fadeIn">
                            <h2>About Us</h2>
                            <div>
                                <?php include("content/about-us.php"); ?>
                            </div>
                            <p><a class="btn btn-primary btn-lg" role="button" onclick="showBooking();">Request a Booking</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <!--*********************** Contact Us ACCORDION ***********************-->
            <section id="CONTACT-US" class="section">
                <div class="container">
                    <h1>Contact Us</h1>
                    <div class="jumbotron">
                        <?php include("content/contact-us.php"); ?>
                    </div>
                    <div class="panel-group" id="contact-us" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div id="contact-us-heading-map" class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#contact-us" href="#contact-us-map" aria-expanded="false" aria-controls="contact-us-map">
                                        <img src="_/img/contact-map.small.jpg" alt="Map Image" class="img-circle" style="height:25px;width:25px;margin-right:1em;"/><span class="ghost">Map ... </span><span class="animate slideIn fadeIn">Map ... </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="contact-us-map" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="contact-us-heading-map">
                                <div class="panel-body">
                                    <div id="map-outer">
                                        <!-- <a id="changeMap" class="imageBorderShadow">View Inside</a>-->
                                        <div id="map_canvas" class="imageRight imageBorderShadow">
                                            <div class="verticalDummy"></div>
                                            <img src="_/img/map.jpg" alt="Map"/>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div id="contact-us-heading-hours" class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#contact-us" href="#contact-us-hours" aria-expanded="false" aria-controls="contact-us-hours">
                                        <img src="_/img/contact-hours.small.jpg" alt="Hours Image" class="img-circle" style="height:25px;width:25px;margin-right:1em;"/><span class="ghost">Hours ... </span><span class="animate slideIn fadeIn">Hours ... </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="contact-us-hours" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="contact-us-heading-hours">
                                <div class="panel-body">
                                    <!-- HOURS of OPERATION -->
                                    <?php include("content/hours-of-operation.php"); ?>
                                </div>
                                <?php // include("content/christmas-closures.php"); // *** XMAS *** ?>
                            </div>
                        </div>
                        <div id="enquiry-panel" class="panel panel-default">
                            <div id="contact-us-heading-form" class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#contact-us" href="#contact-us-form" aria-expanded="false" aria-controls="contact-us-form">
                                        <img src="_/img/contact-enquiry.small.jpg" alt="Form Image" class="img-circle" style="height:25px;width:25px;margin-right:1em;"/><span class="ghost">Enquiry ... </span><span class="animate slideIn fadeIn">Enquiry ... </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="contact-us-form" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="contact-us-heading-form">
                                <div class="panel-body">
                                    <!-- CONTACT US FORM -->
                                    <?php include("content/contact-us-form.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--******************* JUMBOTRON: Services ********************-->
            <section id="SERVICES" class="section">
                <div class="jumbotron content parallax" style="background-image: url(_/img/services.small.jpg)">
                    <div class="container">
                        <div class="content-inner animate fadeIn">
                            <h2>Our Services</h2>
                            <div>
                                <?php include("content/services.php"); ?>
                            </div>
                            <p><a class="btn btn-primary btn-lg" role="button" onclick="showBooking();">Request a Booking</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <!--*********************** SERVICES ***********************-->
            <section id="PRICING" class="section">
                
                <!-- Pricing Accordion -->
                <div class="container">
                    <h1>Service Pricing</h1>
                    <?php generatePricingAccordian($PHP_GLOBAL_SERVICES_ARRAY, 'services-pricing'); ?>
                </div>

                <?php
                    /* 
                     * REMOVED *** DC ***
                     *
                        <!-- Pricing BUNDLE SPECIALS Accordion -->
                        <div class="container">
                            <h1>Discount<span class="visible-xs-inline">s</span><span class="hidden-xs">ed Services</span></h1>
                            <?php generatePricingAccordian($PHP_GLOBAL_SERVICES_DISCOUNTED_ARRAY,'services-pricing-discounted'); ?>
                        </div>
                     *
                     */
                ?>
                
            </section>

            <!--********************** JUMBOTRON: Products ***********************-->
            <section id="PRODUCTS" class="section">
                <?php productJumbotron(); ?>
            </section>

            <!--***************** FURTHER INFORMATION ******************-->
            <section id="INFORMATION" class="section">
                <div class="container">
                    <h1><span class="hidden-xs">Further </span>Information</h1>
                    <div id="pianeta-facebook" class="col-sm-6 col-xs-12 center-block text-center">
                        <div class="jumbotron">
                            <div class="container">
                                <!-- Facebook Feed -->
                                <h2 class="text-center">Facebook</h2>
                                <br/><br/>
                                <div class="informationContent">
                                    <div class="fb-page" data-href="https://www.facebook.com/PianetaHairDesign" data-tabs="timeline" data-small-header="true" data-height="500" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                        <blockquote cite="https://www.facebook.com/PianetaHairDesign" class="fb-xfbml-parse-ignore">
                                            <a href="https://www.facebook.com/PianetaHairDesign">Pianeta on facebook</a>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pianeta-subscribe" class="col-sm-6 col-xs-12 center-block">
                        <div class="jumbotron">
                            <div class="container">
                                <!-- Begin MailChimp Signup Form -->
                                <div id="mc_embed_signup" class="form-horizontal">
                                    <form id="formSubscribe" name="mc-embedded-subscribe-form" class="form-horizontal validate" action="//PianetaHairDesign.us2.list-manage.com/subscribe/post?u=d1c17bfc9f59ca5cb4f788db9&amp;id=5ec6bec0a6" method="post" target="_blank">
                                        <div id="mc_embed_signup_scroll">
                                            <h2 class="text-center">Subscribe<span class="hidden-xs"> for Specials</span></h2>
                                            <br/><br/>
                                            <div class="informationContent">
                                                <div id="subscribe-fname-form-group" class="mc-field-group form-group has-feedback">
                                                    <label for="mce-FNAME" class="col-sm-2 control-label">First</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                                            <input type="text" value="" name="FNAME" class="required form-control" id="mce-FNAME" maxlength="100" placeholder="Your first name...">
                                                        </div>
                                                        <span class="subscribe-fname-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
                                                        <span class="subscribe-fname-success sr-only-hidden hidden">(success)</span>
                                                        <span class="subscribe-fname-error help-block hidden">Please enter your first name.</span>
                                                        <span class="subscribe-fname-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                                                        <span class="subscribe-fname-error sr-only-hidden hidden">(error)</span>
                                                    </div>
                                                </div>

                                                <div id="subscribe-lname-form-group" class="mc-field-group form-group has-feedback">
                                                    <label for="mce-LNAME" class="col-sm-2 control-label">Last</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                                            <input type="text" value="" name="LNAME" class="required form-control" id="mce-LNAME" maxlength="100" placeholder="Your last name...">
                                                        </div>
                                                        <span class="subscribe-lname-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
                                                        <span class="subscribe-lname-success sr-only-hidden hidden">(success)</span>
                                                        <span class="subscribe-lname-error help-block hidden">Please enter your last name.</span>
                                                        <span class="subscribe-lname-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                                                        <span class="subscribe-lname-error sr-only-hidden hidden">(error)</span>
                                                    </div>
                                                </div>
                                                
                                                <div id="subscribe-email-form-group" class="mc-field-group form-group has-feedback">
                                                    <label for="mce-EMAIL" class="col-sm-2 control-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                                                            <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" maxlength="100" placeholder="Email Address...">
                                                        </div>
                                                        <span class="subscribe-email-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
                                                        <span class="subscribe-email-success sr-only-hidden hidden">(success)</span>
                                                        <span class="subscribe-email-error help-block hidden">Please enter your email.</span>
                                                        <span class="subscribe-email-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                                                        <span class="subscribe-email-error sr-only-hidden hidden">(error)</span>
                                                    </div>
                                                </div>
                                                
                                                <div id="mce-responses" class="clear">
                                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                                </div>
                                                <div id="subscribe-form-help" class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <div class="alert alert-info" role="alert">All fields must be completed</div>
                                                    </div>
                                                </div>
                                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_d1c17bfc9f59ca5cb4f788db9_5ec6bec0a6" tabindex="-1" value=""></div>
                                                <div class="clear">
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button id="subscribeSubmitButton" type="submit" name="subscribe" class="btn btn-primary" disabled="disabled" onclick="ajaxSubmitForm('mc-embedded-subscribe-form','<?php echo PHP_SUBSCRIBE_SUCCESS; ?>');">Subscribe</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <!-- *** EMPLOYMENT Opportunities *** -->
                    <div class="container text-center">
                        <h2>Employment<span class="hidden-xs"> Opportunities</span></h2>
                        <div id="employment-opportunities">
                            <br/>
                            <?php include("content/employment.php"); ?>
                        </div>
                    </div>
                </div><!-- END container -->
            </section>

            
            <!--************************ JUMBOTRON: Footer *************************-->
            <div id="BASE_FOOTER">
                <div class="jumbotron">
                    <div class="container">
                        <div class="misc-content">
                            <h4 class="text-center"><strong>Pianeta Hair Design</strong></h4>
                            <table class="table-bordered table-condensed center-block">
                                <tbody>
                                    <tr>
                                        <td class="text-right">Phone:</td>
                                        <td>(02) 9894 4247</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Address:</td>
                                        <td>
                                            Norwest Marketown<br/>
                                            Shop T9, 4 Century Cct<br/>
                                            Baulkham Hills, NSW, 2153
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Email:</td>
                                        <td>info@PianetaHairDesign.com.au</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Facebook:</td>
                                        <td>facebook.com/PianetaHairDesign</td>
                                   </tr>
                                    <tr>
                                        <td class="text-right">Instagram:</td>
                                        <td>instagram.com/Pianeta_Hair_Design</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">ABN:</td>
                                        <td>20 469 511 479</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <div class="panel-group" id="misc-info" role="tablist" aria-multiselectable="false">
                            <div class="panel panel-default">
                                <div id="misc-info-heading-terms" class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a class="collapsed text-center" role="button" data-toggle="collapse" data-parent="#misc-info" href="#misc-info-terms" aria-expanded="false" aria-controls="misc-info-terms">
                                            <small>Terms of Use</small>
                                        </a>
                                    </h4>
                                </div>
                                <div id="misc-info-terms" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="misc-info-heading-terms">
                                    <div class="panel-body">
                                        <!-- TERMS OF USE -->
                                        <div id="terms-of-use" class="misc-content">
                                            <?php include("content/terms-of-use.php"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div id="misc-info-heading-privacy" class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a class="collapsed text-center" role="button" data-toggle="collapse" data-parent="#misc-info" href="#misc-info-privacy" aria-expanded="false" aria-controls="misc-info-privacy">
                                            <small>Privacy Policy</small>
                                        </a>
                                    </h4>
                                </div>
                                <div id="misc-info-privacy" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="misc-info-heading-privacy">
                                    <div class="panel-body">
                                        <!-- PRIVACY POLICY -->
                                        <div id="privacy-policy" class="misc-content">
                                            <?php include("content/privacy-policy.php"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="misc-content">
                            <p class="text-center">Copyright&COPY; Pianeta Hair Design <?php echo date("Y"); ?> All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!--*********************** ONLINE BOOKING *********************-->
        <section id="BOOKING" class="section">  
            <div class="container">
                <h1>Book Online</h1>
                <p class="text-muted text-center">Request a booking at Pianeta Hair Design</p>
                <div class="jumbotron">
                    <div class="container" style="text-align:center">
                        <?php require_once("content/booking-form.php"); ?>
                    </div>
                </div>
            </div>
        </section>

        <!--************************** FIXED FOOTER **************************-->
        <footer class="footer">
            <div class="container">
                <div class="block left">
                    <p class="text-muted"><small>Copyright&COPY; Pianeta Hair Design <?php echo date("Y"); ?> </small><small class="hidden-xs">All Rights Reserved</small></p>
                </div>
                <div class="block right">
                    <!-- Facebook like button -->
                    <div class="fb-like" 
                            data-href="https://PianetaHairDesign.com.au" 
                            data-layout="button" 
                            data-action="like" 
                            data-show-faces="false" 
                            data-size="small" 
                            data-share="false">
                    </div>
                </div>
            </div>
        </footer>

        <!--************************* BOOKING MODAL **************************-->
        <div id="servicesModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Selected Services</h3>
                    </div>
                    <div class="modal-body content">
                        <h4>Selected Services ...</h4>
                        <div id="modal-selected-services">
                            
                        </div>
                        <br/>
                        <h4>Help ...</h4>
                        <div id="bookingHelp">
                            <p>The <strong>Name</strong>, <strong>Phone</strong> and <strong>Email</strong> address fields must be completed with valid entries to ensure we can contact you if needed.</p>
                            <p>Indicate what date you would like to make your booking by clicking on the <strong>Date</strong> field.</p>
                            <p>After selecting a date, please select up to 3 time preferences for you appointment by clicking on the <strong>Time</strong> fields.</p>
                            <p>Then click on the <strong>Services</strong> you wish to receive by clicking the <span class="pill-modify glyphicon glyphicon-plus"></span><span class="sr-only">plus</span> button as many times as required for the chosen service.</p>
                            <p>Instances of a service can be removed by clicking the <span class="pill-modify glyphicon glyphicon-minus"></span><span class="sr-only">plus</span> button as many times as required.</p>
                            <p>Comments and additional instructions that may help generate your booking can then be added to the <strong>comments</strong> field if required.</p>
                            <p>Finally, once all required fields (*) are complete, clicking the <strong>Request Booking</strong> button will send the request to us.</p>
                            <p>Please allow a full working day for us to confirm your booking. If the requested date/times are unavailable, we will contact you via phone or email to arrange an alternative</p>
                            <p>If you have any issues with creating a booking, please call or email us using our <a href="#CONTACT-US" onclick="scrollToElement(null,this.hash,0);">contact details</a> for assistance.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="removeAllServices(); $('#servicesModal').modal('hide');">Clear All Services</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <noscript id="deferred-styles">
            <link rel="stylesheet" type="text/css" href="_/css/pianeta.combined.min.css"/>
        </noscript>
        <script>
            var loadDeferredStyles = function() {
                var addStylesNode = document.getElementById("deferred-styles");
                var replacement = document.createElement("div");
                replacement.innerHTML = addStylesNode.textContent;
                document.body.appendChild(replacement);
                addStylesNode.parentElement.removeChild(addStylesNode);
            };
            var raf = requestAnimationFrame || mozRequestAnimationFrame ||
                webkitRequestAnimationFrame || msRequestAnimationFrame;
            if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
            else window.addEventListener('load', loadDeferredStyles);
        </script>

        <!--************************ Specials MODAL **************************-->
        <?php
            if (PHP_ENABLE_SPECIALS) {
                include('content/specials.php');
            }
        ?>
        <!--********** Google Structured http://schema.org Data ************-->
        <script type="application/ld+json"> {"@context":"http://schema.org","@type":"http://schema.org/LocalBusiness","@id":"https://PianetaHairDesign.com.au","additionalType":"http://schema.org/HairSalon","url":"https://PianetaHairDesign.com.au","name":"Pianeta Hair Design","image": "https://pianetahairdesign.com.au/logo.png","logo":"https://pianetahairdesign.com.au/logo.png","email":"info@PianetaHairDesign.com.au","sameAs":"https://www.facebook.com/PianetaHairDesign","hasMap":"https://www.google.com.au/maps/place/Pianeta+Hair+Design/@-33.7333859,150.9603254,17z/data=!3m1!4b1!4m5!3m4!1s0x6b12a19468075139:0x3f7d235d301d00a3!8m2!3d-33.7333859!4d150.9625141","openingHours":["Mo 09:00-17:30","Tu 09:00-17:30","We 09:00-17:30","Th 09:00-21:00","Fr 09:00-17:30","Sa 09:00-17:00"],"description":"<?php echo PHP_MAIN_CLASSIFICATION; ?>","address":{"@type":"PostalAddress","streetAddress":"Norwest Marketown, Shop T9, 4 Century Cct","addressLocality":"Baulkham Hills","addressRegion":"NSW","postalCode":"2153","addressCountry":"AU","telephone":"(02) 9894 4247"},"geo":{"@type":"GeoCoordinates","latitude":-33.7333859,"longitude":150.9625141},"priceRange":"$$","paymentAccepted":"Cash, Eftpos, Visa, Mastercard","currenciesAccepted":"AUD"}</script>

        <script>
            // Set Max Carousel Height based on Screen Size
            function sizeCarousel() {
                var documentHeight = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                document.getElementById("main-carousel-inner" ).style.maxHeight = (<?php echo PHP_CAROUSEL_MAX_HEIGHT_RATIO; ?>*documentHeight)+"px";
            }
            sizeCarousel();
            window.addEventListener('resize', function(event){
                sizeCarousel();
            },true);
            // Cookie constant field names ***
            var COOKIE_piaID = "<?php echo PHP_COOKIE_piaID; ?>";
            var COOKIE_NAME = "<?php echo PHP_COOKIE_NAME; ?>";
            var COOKIE_PHONE = "<?php echo PHP_COOKIE_PHONE; ?>";
            var COOKIE_EMAIL = "<?php echo PHP_COOKIE_EMAIL; ?>";
            var COOKIE_DATE = "<?php echo PHP_COOKIE_DATE; ?>";
            var COOKIE_TIME = "<?php echo PHP_COOKIE_TIME; ?>";
            var COOKIE_TIME_2 = "<?php echo PHP_COOKIE_TIME_2; ?>";
            var COOKIE_TIME_3 = "<?php echo PHP_COOKIE_TIME_3; ?>";
            var COOKIE_SERVICES = "<?php echo PHP_COOKIE_SERVICES; ?>";
            var COOKIE_ENQUIRY = "<?php echo PHP_COOKIE_ENQUIRY; ?>";
            var CHILD_SERVICE_ARRAY = "<?php echo PHP_SERVICE_CHILD; ?>".split(',');
            <?php 
                // Set availableServicesJson using $PHP_GLOBAL_SERVICES_ARRAY
                echo 'var availableServicesJson = '.json_encode($PHP_GLOBAL_BOOKING_SERVICES).';'."\n";
            ?>
        </script>


        <!--************************ LOAD SCRIPTS using RequireJS *************************-->     
        <script data-main="_/js/pianeta.require.min" src="_/js/require.min.js" async></script>

        <div id="fb-root"></div>
        <script>
            // GOOGLE ANALYTICS
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-21841704-1', 'auto');
            ga('send', 'pageview');
            // FACEBOOK SDK
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        
    </body>
</html>

