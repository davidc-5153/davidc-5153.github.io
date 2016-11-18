<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <!-- <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
        
        <!-- Bootstrap V4: http://v4-alpha.getbootstrap.com/ 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous" />
        -->
        
        <!-- Bootstrap V3: http://getbootstrap.com/getting-started/ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
        <link rel="stylesheet" type="text/css" href="_/css/pianeta.css" />
    </head>

    <body data-spy="scroll">
        
        <!--**************************************************************** 
            **************************** NAVBAR ****************************
            ****************************************************************-->
        
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bd-main-nav" aria-expanded="false">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="_/img/logo-small.png" alt="Pianeta"/></a>
                </div>
                <div class="collapse navbar-collapse" id="bd-main-nav">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="/">Menu Item 1 <span class="sr-only">(current)</span></a>
                        </li>
                        <li>
                            <a href="/">Menu Item 2</a>
                        </li>
                        <li>
                            <a href="/">Menu Item 3</a>
                        </li>
                        <li>
                            <a href="/">Menu Item 4</a>
                        </li>
                    </ul>
                </div>
            </div><!-- END container -->
        </nav>

        
        <!--****************************************************************** 
            **************************** CAROUSEL ****************************
            ******************************************************************-->
        
        <section id="SECTION_CAROUSEL">
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#main-carousel" data-slide-to="1"></li>
                    <li data-target="#main-carousel" data-slide-to="2"></li>
                </ol>
                <!-- Slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img class="lazyload" src="_/img/slide00.jpg" data-src="_/img/slide00-large.jpg" alt="Slide 00" />
                        <div class="carousel-caption">
                            <h2>Slide 00</h2>
                        </div>
                    </div>
                    <div class="item">
                        <img class="lazyload" src="_/img/slide00.jpg" data-src="_/img/slide00-large.jpg" alt="Slide 01" />
                        <div class="carousel-caption">
                            <h2>Slide 01</h2>
                        </div>
                    </div>
                    <div class="item">
                        <img class="lazyload" src="_/img/slide00.jpg" data-src="_/img/slide00-large.jpg" alt="Slide 02" />
                        <div class="carousel-caption">
                            <h2>Slide 02</h2>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        
        <!--****************************************************************** 
            ************************ JUMBOTRON: Logo *************************
            ******************************************************************-->
        <section id="SECTION_LOGO">
            <div class="container text-center">
                <img class="logo" src="_/img/logo-large.png" alt="Pianeta Hair Design"/>
            </div>
        </section>
        
        
        <!--**************************************************************** 
            *********************** About Us SECTION ***********************
            ****************************************************************-->
        
        <section id="SECTION_ABOUT_US">
            <div class="container">
                <h1>About Us</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <?php include("content/about-us.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <!--****************************************************************** 
            ****************** JUMBOTRON: Contact Us Image *******************
            ******************************************************************-->
        
        <section id="SECTION_JUMBOTRON_contact_us">
            <div class="container text-center">
                <img class="jumbotron lazyload" src="_/img/contact-us.jpg" data-src="_/img/contact-us-large.jpg" alt="Contact Us"/>
            </div>
        </section>


        <!--******************************************************************** 
            *********************** Contact Us ACCORDION ***********************
            ********************************************************************-->
        
        <section id="SECTION_CONTACT_US">
            <div class="container">
                <h1>Contact Us</h1>
                <div class="jumbotron">
                    <?php include("content/contact-us.php"); ?>
                </div>
                <div class="panel-group" id="contact-us" role="tablist" aria-multiselectable="true">
                    <!-- Converted Contact Us Details into Jumbotron that is always displayed - SEE Above
                    <div class="panel panel-default">
                        <div id="contact-us-heading-details" class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#contact-us" href="#contact-us-details" aria-expanded="true" aria-controls="contact-us-details">
                                    Details
                                </a>
                            </h4>
                        </div>
                        <div id="contact-us-details" class="panel-collapse collapse fade in" role="tabpanel" aria-labelledby="contact-us-heading-details">
                            <div class="panel-body ">
                                <!-- CONTACT DETAILS 
                                <?php // include("content/contact-us.php"); ?>
                            </div>
                        </div>
                    </div>
                    -->
                    <div class="panel panel-default">
                        <div id="contact-us-heading-map" class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#contact-us" href="#contact-us-map" aria-expanded="false" aria-controls="contact-us-map">
                                    Map
                                </a>
                            </h4>
                        </div>
                        <div id="contact-us-map" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="contact-us-heading-map">
                            <div class="panel-body">
                                <!-- MAP -->
                                <div id="map-outer">
                                    <a id="changeMap" class="imageBorderShadow">View Inside</a>	
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
                                    Hours
                                </a>
                            </h4>
                        </div>
                        <div id="contact-us-hours" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="contact-us-heading-hours">
                            <div class="panel-body">
                                <!-- HOURS of OPERATION -->
                                <?php include("content/hours-of-operation.php"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div id="contact-us-heading-form" class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#contact-us" href="#contact-us-form" aria-expanded="false" aria-controls="contact-us-form">
                                    Form
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
                </div><!-- END panel-group -->
            </div><!-- END container -->
        </section>

        
        <!--****************************************************************** 
            ******************* JUMBOTRON: Services Image ********************
            ******************************************************************-->
        
        <section id="SECTION_JUMBOTRON_services">
            <div class="container text-center">
                <img class="jumbotron lazyload" src="_/img/services.jpg" alt="Services" data-src="_/img/services-large.jpg"/>
                    <!--
                    <h2>Hello, world!</h2>
                    <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                    -->
            </div>
        </section>
        
        
        <!--******************************************************** 
            *********************** SERVICES ***********************
            ********************************************************-->

        <section id="SECTION_SERVICES_TEXT">
            
            <!-- ***** TEXT ***** -->
            <div class="container">
                <h1>Our Services</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <?php include("content/services.php"); ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ***** Pricing Accordion ***** -->
            <div class="container">
                <?php include("content/pricing.php"); ?>
            </div>
                       
            <!-- ***** Pricing BUNDLE SPECIALS Accordion ***** -->
            <div class="container">
                <h1>Discount<span class="visible-xs-inline">s</span><span class="hidden-xs">ed Services</span></h1>
                <?php include("content/pricing-special.php"); ?>
            </div>
            
        </section>
        

        <!--****************************************************************** 
            ************************ JUMBOTRON: XXXX *************************
            ******************************************************************-->
        
        <section id="SECTION_JUMBOTRON_xxx">
            <div class="container text-center">
                <div class="jumbotron">
                </div>
            </div>
        </section>
        

        <!--*************************************************************** 
            ************************ LOAD SCRIPTS *************************
            ***************************************************************-->

        <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script> -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        
        <!-- Bootstrap V4: http://v4-alpha.getbootstrap.com/ 
        Need Tether ???
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
        -->
 

        <!-- Bootstrap V3: http://getbootstrap.com/getting-started/ -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript" src="_/js/pianeta.js"></script>

    </body>

</html>