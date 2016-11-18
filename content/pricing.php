<?php

/** 
 * Pricing (Normal - Single Service) Accordion for Pianeta Hair Design Web Page
 * 
 * @author David Ceccato
 * @version 20161028
 */

?>
<div class="panel-group" id="services-pricing" role="tablist" aria-multiselectable="true">

    <!-- *****************************************
         **************** CUTTING **************** 
         ***************************************** -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-cutting" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-cutting" aria-expanded="false" aria-controls="services-pricing-cutting">
                    Cutting ...
                </a>
            </h4>
        </div>

        <div id="services-pricing-cutting" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-cutting">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- CUTTING Prices -->
                <div class="row">
                    <!-- ***** STYLE CUT prices ***** -->
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Style Cut</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Ladies</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">37.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Men</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">29.95</span>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td><span itemprop="description">Fringe Trim</span> <small>(fringe only)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">9.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Buzz Cut</span> <small>(clippers only)</small></td>
                                            <td class="col-xs-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">16.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Children</span> <small>(under 6)</small></td>
                                            <td class="col-xs-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">20.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Children</span> <small>(under 12)</small></td>
                                            <td class="col-xs-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">22.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    
    <!-- *******************************************
         **************** COLOURING **************** 
         ******************************************* -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-colouring" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-colouring" aria-expanded="false" aria-controls="services-pricing-colouring">
                    Colouring ... 
                </a>
            </h4>
        </div>

        <div id="services-pricing-colouring" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-colouring">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- COLOURING Prices -->
                <div class="row">                
                    <!-- ***** TINT/SEMI Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Tint / Semi</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Short Hair</span> <small>(to shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">64.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Long Hair</span> <small>(past shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">89.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Regrowth</span> <small>(up to 2.5cm)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">47.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Hair Line</span> <small>(up to 2.5cm)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">27.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                    <!-- ***** COLOUR MAN Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Colour Man</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Mens Tint</span> <small>(to shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">29.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    <!-- *******************************************
         ***************** FOILING ***************** 
         ******************************************* -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-foils" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-foils" aria-expanded="false" aria-controls="services-pricing-foils">
                    Foils ... 
                </a>
            </h4>
        </div>

        <div id="services-pricing-foils" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-foils">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- FOIL Prices -->
                <div class="row">                
                    <!-- ***** FOIL Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Foils</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Quarter Head</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">69.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Half Head</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">99.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Full Head</span></small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">149.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                    <!-- ***** HIGHLIGHT Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Highlights</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Foil Highlights</span> <small>(each)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">6.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    <!-- *******************************************
         ***************** STREAKS ***************** 
         ******************************************* -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-streaks" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-streaks" aria-expanded="false" aria-controls="services-pricing-streaks">
                    Streaks ... 
                </a>
            </h4>
        </div>

        <div id="services-pricing-streaks" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-streaks">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- STREAK Prices -->
                <div class="row">                
                    <!-- ***** CAP STRAKS Prices ***** -->
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Cap Streaks</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Short Hair</span> <small>(to shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">49.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Long Hair</span> <small>(past shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">69.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    <!-- *******************************************
         ***************** STYLING ***************** 
         ******************************************* -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-styling" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-styling" aria-expanded="false" aria-controls="services-pricing-styling">
                    Styling ... 
                </a>
            </h4>
        </div>

        <div id="services-pricing-styling" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-styling">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- STYLING Prices -->
                <div class="row">                
                    <!-- ***** BLOW DRY Prices ***** -->
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Blow Dry</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Short Hair</span> <small>(to shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">29.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Long Hair</span> <small>(past shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">39.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    <!-- ****************************************************
         ***************** CHEMICAL STYLING ***************** 
         **************************************************** -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-chemical-styling" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-chemical-styling" aria-expanded="false" aria-controls="services-pricing-chemical-styling">
                    Chemical Styling ... 
                </a>
            </h4>
        </div>

        <div id="services-pricing-chemical-styling" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-chemical-styling">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- CHEMICAL STYLING Prices -->
                <div class="row">                
                    <!-- ***** KERATIN SMOOTHING Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Keratin Smoothing</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Kerasmooth</span> <small>(service only)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">199.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Kerasmooth</span> <small>(inc products)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">299.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                    <!-- ***** KERATIN STRAIGHTENING Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Keratin Straightening</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Short Hair</span> <small>(to shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">249.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Long Hair</span> <small>(past shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">299.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                    <!-- ***** PERM / BODY WAVE Prices ***** -->
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Perm / Body Wave</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Short Hair</span> <small>(to shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">99.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">Long Hair</span> <small>(past shoulder)</small></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">149.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    <!-- **********************************************
         ***************** TREATMENTS ***************** 
         ********************************************** -->
    
    <div class="panel panel-default">    
        <div id="services-pricing-heading-treatments" class="panel-heading" role="tab">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#services-pricing" href="#services-pricing-treatments" aria-expanded="false" aria-controls="services-pricing-treatments">
                    Treatments ... 
                </a>
            </h4>
        </div>

        <div id="services-pricing-treatments" class="panel-collapse collapse fade" role="tabpanel" aria-labelledby="services-pricing-heading-treatments">
            <div class="panel-body" itemscope itemtype="http://schema.org/Product">
                <!-- TREATMENT Prices -->
                <div class="row">                
                    <!-- ***** STEAMER TREATMENT Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Steamer Treatments</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Alone</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">19.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">With Service</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">14.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                    <!-- ***** INSTANT TREATMENT Prices ***** -->
                    <div class="col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <!-- <img src="..." alt="..."> -->
                            <div class="caption">
                                <h4 itemprop="name">Instant Treatments</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <tr>
                                            <td><span itemprop="description">Alone</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">12.95</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span itemprop="description">With Service</span></td>
                                            <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <span itemprop="priceCurrency" content="AUD">$</span><span itemprop="price">9.95</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- END table-responsive -->
                            </div><!-- END caption -->
                        </div><!-- END thumbnail -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </div><!-- END panel-body -->
        </div><!-- END panel-collapse -->
    </div><!-- END panel -->

    
</div>


