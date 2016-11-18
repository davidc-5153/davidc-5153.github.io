/**
 *  Pianeta Hair Design Website
 *  JavaScript
 *
 *  @author: David Ceccato
 *  @version: 20161027
 */

/*************** JS CONSTANTS **************/
var EMAIL_MAILTO = '<a href="mailto:info@pianetahairdesign.com.au?subject=Enquiry via PianetaHairDesign.com.au">@@@</a>'; // Where @@@ will be replaces with Obsfocated Email address
var MAP_INSIDEVIEW_PROMPT = "View Inside";
var MAP_MAPVIEW_PROMPT = "View Map";
var MAP = null; // Google Map Object
var PANORAMA = null; // Google Inside Street View Object
var MARKER = null; // Google Map animated location marker
var PIANETA;

(function(){
    
    /************* Obsfocated Email **************/
    var contactHTML = $('.contact').html();
    var replacementData = EMAIL_MAILTO.replace('@@@', contactHTML);
    $('.contact').html(replacementData);

    /*************** Load Google Map ******************/
    googleMapsLoadScript();
    
    /*************** Toggle Between Map and Inside View *************/
    $('#changeMap').click(function(){
        toggleMap();
    });

    /*********** Stop Click within panels propogating to body ************/
    $('.panel-body').click(function(){ return false; });
    
    /*************** Initailise Map Size **************/
    // Set initial map canvas size to shown content size 
    //      when the map is being shown by bootstrap (Else map would be 0px)
    $("#contact-us-map").on('shown.bs.collapse', function(){
        // Bootstrap event - Collapse content shown
        google.maps.event.trigger(MAP, 'resize');
        MAP.setCenter(PIANETA);
    });
    
       
    /*************** Scroll to Shown Panel **************/
    // When accordion content finishes being shown, the <body>
    //      is scrolled to its heading and anchor(#) added to url
    $('.panel-collapse').on('shown.bs.collapse', function(){
        var heading = $('#'+$(this).attr('aria-labelledby'));
        if (heading) {
            $('body').animate({
                scrollTop: (heading.offset().top-50)
            }, 250, function(){
                // Add hash (#) to URL when done scrolling (default click behavior)
                var link = heading.find('a');
                if (link) {
                    var parent = link.data('parent').substring(1);
                    window.location.hash = parent;
                }
            });
        }
    });
    
    /*************** Collapse open elements when body clicked **************/
    $('body').click(function(){
        $('.collapse').collapse('hide');
    });
    
    /*************** Lazyload high quality images **************/
    $('.lazyload').each(function(index,element){
        lazyload(element);
    });
})();


/** 
 * Creates the javascript that load the Google Maps API V3 - Called at the end of document.ready
 *      - Calls the function googleMapsInitialize() when the API has finished Loading
 */
function googleMapsLoadScript() {
      var mapScript = document.createElement('script');
      mapScript.type = 'text/javascript';
      mapScript.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDZz_GJgjOp-1oLQDTi1P-7cegsDblkh4U&v=3.exp&callback=googleMapsInitialize';
      document.body.appendChild(mapScript);
}

/*
 * Initialises the Google Map and attached internal Panoramic Street View
 */
function googleMapsInitialize() {

    PIANETA = new google.maps.LatLng(-33.732502, 150.980910); // Location
 
    /*************** Map *************/
    var mapOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: PIANETA,
        panControl: false,
        scaleControl: false,
        mapTypeControl: false,
        zoomControl: false,
        streetViewControl: false
    };
    MAP = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    var icon = {
        url: '../desktop/_/img/mapMarker.png', 
        size: new google.maps.Size(30, 64), // Size of image (width, Height)
        origin: new google.maps.Point(0,0),
        anchor: new google.maps.Point(16, 62) // The anchor for this image is the base of the swish.
    };
    MARKER = new google.maps.Marker({
        map: MAP,
        draggable: false,
        position: PIANETA,
        icon: icon,
        title: "Pianeta Hair Design"
    });
    MARKER.setAnimation(google.maps.Animation.BOUNCE);

    /*************** Inside View *************/
    var panoramaOptions = {
        zoom: 1,
        panControl: false,
        scaleControl: false,
        mapTypeControl: false,
        zoomControl: false,
        addressControl: false
    };
    PANORAMA = MAP.getStreetView();
    PANORAMA.setPosition(PIANETA);
    PANORAMA.setEnableCloseButton(false);
    PANORAMA.setPov({
        heading: 70,
        pitch:0
    });
    PANORAMA.setOptions(panoramaOptions); 
    PANORAMA.setVisible(false);
    MAP.setStreetView(PANORAMA);
}

/*
 * Toggles between displaying the Google Map and Google Panorama
 */
function toggleMap() {
    if ($('#changeMap').text() == MAP_MAPVIEW_PROMPT) {
        streetMap();
    } else {
        insideView();
    }

}

/*
 * Shows the Google Map View 
 */
function streetMap() {
    // Make the panorama view Invisible
    PANORAMA.setVisible(false);
    $("#map_canvas > .gm-style:nth-of-type(2)").addClass('hiddenElement');
    // Turn the marker on
    MARKER.setVisible(true);
    MARKER.setAnimation(google.maps.Animation.BOUNCE);
    // Change the button prompt
    $('#changeMap').text(MAP_INSIDEVIEW_PROMPT);
}

/*
 * Shows the Internal Google Street View
 */
function insideView() {
    // Make the panorama visible
    PANORAMA.setVisible(true);
    $("#map_canvas > .gm-style:nth-of-type(2)").removeClass('hiddenElement');
    // Hide the marker
    MARKER.setVisible(false);
    // Change the button Prompt  
    $('#changeMap').text(MAP_MAPVIEW_PROMPT);
}
                
function lazyload(element) {
    $(element).attr("src", $(element).data('src'));
}