/**
 *  Pianeta Hair Design Website
 *  JavaScript
 *
 *  @author: David Ceccato
 *  @version: 20161027
 */

/*************** JS CONSTANTS **************/
// *** Calendar ***
// sun(0) ... sat(6)
// [minHr, minMin, maxHr, maxMin]
var CALENDAR_TIMES = [
	[0,0,0,0],
	[9,0,17,0],
	[9,0,17,0],
	[9,0,17,0],
	[9,0,20,0],
	[9,0,17,0],
	[9,0,16,30]
];
var BOOKING_SAT_KIDS_START_HOUR = 13;

// The first day of the week can be set to either Sunday or Monday. Anything truth-y sets it as Monday and anything false-y as Sunday:
var FIRST_DAY = 1; // Monday=1 ..... Sunday=7
// var CLOSED_DAYS = [correctDayNumber(0),correctDayNumber(1),{from: [2018,11,25], to: [2019,0,1]}]; // Closed Sundays & Mondays + Easter Period (NB: Months start at 0)
var CLOSED_DAYS = [correctDayNumber(0)]; // Closed Sundays
// var CLOSED_DAYS = [];
var BOOKING_OFFSET_MIN = 2; // Minimum number of DAYS a booking must be from "today" 
var BOOKING_OFFSET_MAX = 3*30; // Maximum number of DAYS a booking can be from "today"
// *** Google Maps ***
var MAP_INSIDEVIEW_PROMPT = "View Inside";
var MAP_MAPVIEW_PROMPT = "View Map";
var MAP = null; // Google Map Object
var PANORAMA = null; // Google Inside Street View Object
var MARKER = null; // Google Map animated location marker
var PIANETA; // Google Maps location of salon
// *** Form Constants ***
var FORM_MIN_NAME = 2;
var FORM_MIN_PHONE = 8;
var FORM_MIN_EMAIL = 5;
var FORM_MIN_ENQUIRY = 2;
var FORM_ID_CONTACT = 'contact';
var FORM_ID_BOOKING = 'booking';
var FORM_ID_SUBSCRIBE = 'subscribe';
var FORM_CLASS_IDENTIFIER_NAME = "name";
var FORM_CLASS_IDENTIFIER_PHONE = "phone";
var FORM_CLASS_IDENTIFIER_EMAIL = "email";
var FORM_CLASS_IDENTIFIER_ENQUIRY = "enquiry";
var FORM_CLASS_IDENTIFIER_DATE = "date";
var FORM_CLASS_IDENTIFIER_TIME = "time";
var FORM_CLASS_IDENTIFIER_SERVICES = "services";
var FORM_CLASS_IDENTIFIER_FIRSTNAME = "fname";
var FORM_CLASS_IDENTIFIER_LASTNAME = "lname";
var FORM_MAX_NUMBER_ORDERS = 99;
// *** Cookie Constants ***
// NB: Cookie constants are declared in index.php using PHP contants as per define.php

/**************** JS GLOBALS *******************/
var currentScrollTop = 0; // Variable to store current scroll position when show/hide #BOOKING

/************ Declare function variables *****************/

/**
 * Enable/Disable time fields based on validity of date selected
 * 
 * @param {datePicker Object} context
 * 
 */
var dateSet = function(context){
    var now = new Date().getTime();
    if ( (context.select !== null) && (context.select > now) && $('#bookingDate').val() !== ''){
        
        // Valid Date selected - Enable time field
        var currentTimes = [
            ($('#bookingTime').pickatime().pickatime('picker').get('select', 'H:i')).split(':'),
            ($('#bookingTime2').pickatime().pickatime('picker').get('select', 'H:i')).split(':'),
            ($('#bookingTime3').pickatime().pickatime('picker').get('select', 'H:i')).split(':')
        ];
            
        $('#bookingTime, #bookingTime2, #bookingTime3').prop('value','').prop("disabled", false);
        var selectedDate = new Date(context.select);
        writeCookie(COOKIE_DATE, selectedDate.getFullYear()+"-"+(selectedDate.getMonth()+1)+"-"+selectedDate.getDate());

        // Set hidden Date field 
        $('#hiddenDate').prop('value', selectedDate.getDate()+'/'+(selectedDate.getMonth()+1)+'/'+selectedDate.getFullYear());
        
        // Setvalid times for the day
        var day = selectedDate.getDay(); // sun=0, sat=6
        if ((day >= 0) && (day <= 6)) {
            var minHour = CALENDAR_TIMES[day][0];
            var minMinutes = CALENDAR_TIMES[day][1];
            var maxHour = CALENDAR_TIMES[day][2];
            var maxMinutes = CALENDAR_TIMES[day][3];            
            // Set valid hours
            $('#bookingTime').pickatime().pickatime('picker').set({
                min: [minHour, minMinutes],
                max: [maxHour, maxMinutes],
                select: null
            });
            var firstPreferenceTimeDefault = getDefaultTime(currentTimes[0], CALENDAR_TIMES[day]);
            if (firstPreferenceTimeDefault !== null) {            
                $('#bookingTime').pickatime().pickatime('picker').set('select', firstPreferenceTimeDefault);
            }
            $('#bookingTime2').pickatime().pickatime('picker').set({
                min: [minHour, minMinutes],
                max: [maxHour, maxMinutes],
                select: null
            });
            var secondPreferenceTimeDefault = getDefaultTime(currentTimes[1], CALENDAR_TIMES[day]);
            if (secondPreferenceTimeDefault !== null && firstPreferenceTimeDefault !== null) {
                $('#bookingTime2').pickatime().pickatime('picker').set('select', secondPreferenceTimeDefault);
            }
            $('#bookingTime3').pickatime().pickatime('picker').set({
                min: [minHour, minMinutes],
                max: [maxHour, maxMinutes],
                select: null
            });
            if (firstPreferenceTimeDefault !== null && secondPreferenceTimeDefault !== null) {
                $('#bookingTime3').pickatime().pickatime('picker').set('select', getDefaultTime(currentTimes[2], CALENDAR_TIMES[day]));
            }
        }
        setFormFieldValidity(FORM_ID_BOOKING, FORM_CLASS_IDENTIFIER_DATE, true, true);        
    } else {
        // INValid Date selected - DISable time field
        $('#bookingTime, #bookingTime2, #bookingTime3').prop('value', '').prop('disabled', true);	
        $('#bookingDate').prop('value', '');
        setFormFieldValidity(FORM_ID_BOOKING, FORM_CLASS_IDENTIFIER_DATE, false, true);
    }
};

/**
 * Check selected time with min/max for the new selected date
 * 
 * @param {[H,i]} currentTimeDefault - An array for the currently selected time
 * @param {[H,i]} timeLimitesForSelectedDay - - An array for the min/max Hours in 24hr format (H) and minutes (i) for the selected day
 * @returns {String} returnTime - The valid default time as total minutes since 00:00 or null if default time not valid
 */
function getDefaultTime(currentTimeDefault, timeLimitesForSelectedDay ) {
    returnTime = null;
    if (typeof currentTimeDefault !== "undefined" && currentTimeDefault.length === 2) {
        var totalMinutes = (60*currentTimeDefault[0]) + (1*currentTimeDefault[1]);
        if (  (totalMinutes >= ((timeLimitesForSelectedDay[0]*60)+(timeLimitesForSelectedDay[1]*1))) && 
              (totalMinutes <= ((timeLimitesForSelectedDay[2]*60)+(timeLimitesForSelectedDay[3]*1))) 
        ) {
                returnTime = totalMinutes;
        }
    }
    return returnTime;
}


/**
 * Enable/Disable 2nd and 3rd Time preferences based On Validity of 1st Time Preference Field
 * 
 * @param {type} context
 */
var timeSet1 = function(context) {
    if (typeof context.select!=='undefined' && context.select !== null && context.select !=='' && $('#bookingTime').val()!=='') {
        var selectedTime = parseInt(context.select);
        if (!isNaN(selectedTime)){ 
            writeCookie(COOKIE_TIME, selectedTime);
        }
        $('#bookingTime2').prop('disabled', false);
        setFormFieldValidity(FORM_ID_BOOKING, FORM_CLASS_IDENTIFIER_TIME, true, true);
    } else {
        $('#bookingTime, #bookingTime2, #bookingTime3').prop('value', '');
        $('#bookingTime2, #bookingTime3').prop('disabled', true);
        setFormFieldValidity(FORM_ID_BOOKING, FORM_CLASS_IDENTIFIER_TIME, null, true); // null indicated do NOT show success or error
    }
};

/**
 * Enable/Disable 3rd Time preferences based On Validity of 2nd Time Preference Field
 * 
 * @param {type} context
 */
var timeSet2 = function(context) {
    if (typeof context.select !== 'undefined'  && context.select !== null && context.select !=='' && $('#bookingTime2').val()!=='') {
        $('#bookingTime3').prop('disabled', false);
        var selectedTime = parseInt(context.select);
        if (!isNaN(selectedTime)){ 
            writeCookie(COOKIE_TIME_2, selectedTime);
        }
    } else {
        $('#bookingTime2, #bookingTime3').prop('value', '');
        $('#bookingTime3').prop('disabled', true);
    }
};

var timeSet3 = function(context) {
    if (typeof context.select !== 'undefined' && context.select !== null && context.select !=='' && $('#bookingTime3').val()!=='') {
        $('#bookingTime3').prop('disabled', false);
        var selectedTime = parseInt(context.select);
        if (!isNaN(selectedTime)){ 
            writeCookie(COOKIE_TIME_3, selectedTime);
        }
    } else {
        $('#bookingTime3').prop('disabled', true);
    }
};

/******************************************************************************
 ************************ $(document).ready ***********************************
 ******************************************************************************/

(function(){
    
    // ************* Trigger CSS3 Transforms when object on Screen *************/    
    triggerAnimations(); // Initial Trigger
    $(window).on('scroll resize', function(){
        triggerAnimations();
    });

    /*************** Load Google Map ******************/
    googleMapsLoadScript();
    
    /*************** Toggle Between Map and Inside View *************/
    /*
    $('#changeMap').click(function(){
        toggleMap();
    });
    */
    
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
    
    /******************* Contact Us Form Functions ******************/
    $('#contactName, #contactPhone, #contactEmail, #contactEnquiry').keyup(function(event) {
        formValidateFromEvent(FORM_ID_CONTACT,event);
    });
    $('#contactName, #contactPhone, #contactEmail, #contactEnquiry').blur(function(event) {
        formValidateFromEvent(FORM_ID_CONTACT,event);
    });
    // Load previously enterd values for the contact-us form from cookies
    loadContactUsFormValues();
    
    /*************** Scroll to Shown Panel **************/
    // When accordion content finishes being shown, the <body>
    //      is scrolled to its heading and anchor(#) added to url
    $('.panel-collapse').on('shown.bs.collapse', function(){
        var headingID = $(this).attr('aria-labelledby');
        var heading = $('#'+headingID);
        // incrementJsonCookieValue(COOKIE_TRACK_PANEL_CLICKS, headingID);
        if (heading) {
            // Add hash (#) to URL (anchor)
            var hash = '';
            var link = heading.find('a');
            if (link) {
                hash = link.data('parent');
            }
            // Scroll panel to top
            scrollToElement(heading,hash,50);
        }
    });
    $('.panel-collapse').on('show.bs.collapse', function(){
        $('#'+$(this).attr('aria-labelledby')+' img').animate({height: 75, width: 75}, 300);
        $('#'+$(this).attr('aria-labelledby')+' span.ghost').animate({"padding-top": "28px"}, 100);
    });
    $('.panel-collapse').on('hide.bs.collapse', function(){
        $('#'+$(this).attr('aria-labelledby')+' img').animate({height: 25, width: 25}, 250);
        $('#'+$(this).attr('aria-labelledby')+' span.ghost').animate({"padding-top": "3px"}, 100);
    });
    
    
    /*************** Collapse open elements when body clicked **************/
    $('body').click(function(){
        $('.collapse').collapse('hide');
    });
    
    /*************** Lazyload high quality images **************/
    $('.lazyload').each(function(index,element){
        setTimeout(function() { 
            lazyload(element);
        }, 1000);
    });
    
 
    /*************** Execute Parallax Effect on Window Scroll/Resize ****************
     * *** REMOVED ******************************************************************
    // NO Parallax on Mobiles
     *
    if(!(   (/Mobi/.test(navigator.userAgent)) || 
            (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)) || 
            (/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) 
    )) {
        // Don't think is a mobile - OK to enable parallax
        $(window).scroll(function(){
            parallax();
        });
        $(window).resize(function(){
            parallax();
        });
        parallax(); // Run parallax on load
    }
    */
    // NO Parallax on Mobiles
    if((    (/Mobi/.test(navigator.userAgent)) || 
            (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)) || 
            (/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) 
    )) {
        $('.parallax').css({'background-attachment': 'scroll'});
    }
        
    /*************** Animate Phone Number (4247/HAIR) ****************/
    $('.phone').hover(function(event) {
        // Mouse Enters
        var animationDuration = 200;
        $(event.currentTarget).find('.animatePhone').stop().fadeOut(animationDuration, function(){
            // FadeOut Complete
            $(event.currentTarget).find('.animatePhone').html('<strong>HAIR</strong>').fadeIn(animationDuration);				
        });
     }, function(event) {
        // Mouse Leaves
        var animationDuration = 200;
        $(event.currentTarget).find('.animatePhone').stop().fadeOut(animationDuration, function(){
            // FadeOut Complete
            $(event.currentTarget).find('.animatePhone').text('4247').fadeIn(animationDuration);
        });
     });

    /******************* Booking Request Form Functions ******************/
    $('#bookingName, #bookingPhone, #bookingEmail').keyup(function(event) {
            formValidateFromEvent(FORM_ID_BOOKING,event);
            // NB: Date and Time1 are validated in dateSet() and timeSet1() 
    });
    $('#bookingName, #bookingPhone, #bookingEmail').blur(function(event) {
            formValidateFromEvent(FORM_ID_BOOKING,event);
            // NB: Date and Time1 are validated in dateSet() and timeSet1() 
    });


    // *********************** Date/Time Picker **********************
    // http://amsul.ca/pickadate.js/index.htm
    // http://amsul.ca/pickadate.js/
    $('#bookingDate').pickadate({
        today: '', // Can't select today
        clear: '', // Must enter a date
        format: 'dddd dd/mm/yyyy',
        editable: false,
        firstDay: FIRST_DAY, // Monday
        disable: CLOSED_DAYS, // Disable Mon & Sun
        min: getMinMaxDate(BOOKING_OFFSET_MIN), // At least +1 days from today, 
        max: getMinMaxDate(BOOKING_OFFSET_MAX), // At most +3 months from today
        onSet: dateSet
    });

    $('#bookingTime').pickatime({
        clear: '', // Must enter at least 1 time preference
        format: 'hh:i a',
        editable: false,
        interval: 30,
        min: [9,00],	
        max: [17,0], 
        onSet: timeSet1
    });
    $('#bookingTime2').pickatime({
        format: 'hh:i a',
        editable: false,
        interval: 30,
        min: [9,00],	
        max: [17,0],
        onSet: timeSet2
    });
    $('#bookingTime3').pickatime({
        format: 'hh:i a',
        editable: false,
        interval: 30,
        min: [9,00],	
        max: [17,0],
        onSet: timeSet3
    });

    // ****************** Populate Selected Services Modal on Show *******************
    $('#servicesModal').on('show.bs.modal', function(){
        showChosenServicesInModal();
    });
    
    // ****************** Scroll to #ANCHOR on page Load ********************
    var loadHash = window.location.hash;
    if (loadHash === "#BOOKING") {
        showBooking();
    }// else {
        // scrollToElement(null,loadHash,0);
        // Removed - Too jerky as browser resets to remembered location AFTER we scroll
    //  }
    // Also toggle booking for back/prev browser button event
    $(window).on('hashchange', function() {
        var newHash = window.location.hash;
        if (newHash === "#BOOKING") {
            showBooking();
        } else {
            hideBooking(false);
        }
    });

    // ****** Use bootstrap Scrollspy to remove Hash as user scrolls ******
    /*
    $(".navbar").on("activate.bs.scrollspy", function () {
        var hash = $(".nav li.active > a").prop('href');
        writeHash('');
    });
    */
   
    // ************ Load Available Services for Online Booking **********
    // getCurrentlyAvailableServices(); // REMOVED - Now generated by PHP at start
    
    // Show latest specials alert if required
    if ($('#specialsModal').length>0) {
        setTimeout(function() { 
            showSpecialsAlert();
        }, 2000);
    }
    
    /******************* MailChimp Subscribe Form Functions ******************/
    $('#mce-FNAME, #mce-LNAME, #mce-EMAIL').keyup(function(event) {
        formValidateFromEvent(FORM_ID_SUBSCRIBE, event);
    });
    $('#mce-FNAME, #mce-LNAME, #mce-EMAIL').blur(function(event) {
        formValidateFromEvent(FORM_ID_SUBSCRIBE, event);
    });

    // ************** Special Term and Conditions *********************
    $('.special-contitions-apply').click(function(){
        $(this).find(".special-terms-and-conditions").toggle(500);
    });
    
    // *********** Send Tracking Data ***************
    /* No Longer using Tracking *** DC *** 
    setTimeout(function() { 
        sendTracking();
    }, 15000);
   */
    
})();


/******************************************************************************
 ******************************************************************************
 ******************************************************************************/

function triggerAnimations() {
    var windowHeight = $(window).height();
    var windowTop = $(window).scrollTop();
    var windowBottom = (windowTop + windowHeight);
    $.each($('.animate'), function() {
        var element = $(this);
        var elementHeight = element.outerHeight();
        var elementTop = element.offset().top;
        var elementBottom = (elementTop + elementHeight);

        //check to see if this current container is within viewport
        if ((elementBottom >= windowTop) && (elementTop <= windowBottom)) {
          element.addClass('inView');
          element.prev('.ghost').addClass('inView');
        } else {
          element.removeClass('inView');
          element.prev('.ghost').removeClass('inView');
        }
    });
}



function showSpecialsAlert() {
    $('#specialsModal li.default').addClass('active');
    $('#specialAlert').animate({
        "bottom": "2em", 
        "opacity": 1
    },2000);
}

function hideSpecialsAlert(e) {
    $('#specialAlert span.alert-text-extra, #specialAlert button').fadeOut(500);
    $('#specialAlert').css({top: ($('#specialAlert').position().top)+'px'}).animate({
        top: ($('.navbar-fixed-top').height()+10)+'px',
        right: ($('#specialButton').css('right')), 
        width: "1em",
        height: "1em",
        opacity: 0
    }, 500, function(){
        // Animation complete - Delete specials alert 
        $('#specialAlert').detach();
    });
    // Fade in Fixed Special Button
    $('#specialButton').fadeTo(1500,0.5);

    /*
    $('#specialAlert').animate({"bottom": "-5em", "opacity": 0}, 2000, function(){
        // Animation complete - Delete alert
        $('#specialAlert').detach();
    });
    */
    if (typeof e !== "undefined" && e !== null) {
        e.preventDefault();
        e.stopPropagation();
    }
    return false;
}

/** 
 * Show the specials modal
 * 
 */
function showSpecialsModal() {
    $('#servicesModal').modal('hide'); // Ensure booking Modal is hidden
    if ($('#specialAlert').length>0) {
        hideSpecialsAlert();
    }
    $('#specialsModal').modal('show'); // Show the specials modal
}

/**
 * Helper function to parse the target form element and data from the event object 
 * and pass this data onto main formValidate function
 * 
 * @param {string} formId - Name of the form 
 * @param {js event} event - Event that triggered the Validation Check
 */
function formValidateFromEvent(formId, event) {
    if (event!==null) {
        var target = event.target;
        if (target != null) {
            formValidate(formId, target, event.type);
        }
    }
}

/**
 * Checks basic validity of the current form field and sets if "submit" button 
 * is disabled based on the status of all the form fields.
 * 
 * @param {string} formId - Name of the form 
 * @param {DOM element} target - The form filed DOM element that is being checked for validity
 * @param {string} eventType - The type of event - If event tpe is "blur" we don't check all fields (as will do on keyup event)
 * 
 */
function formValidate(formId, target, eventType) {
        
    var fieldName = null;
    var success = false;
    var targetId = target.id.toLowerCase();
    var data = target.value;
    var dataLength = data.length;
    
    // Find which form field triggered the event & see if it is valid
    if (targetId.indexOf(FORM_CLASS_IDENTIFIER_FIRSTNAME.toLowerCase())>-1) {
        // FNAME  Field
        fieldName = FORM_CLASS_IDENTIFIER_FIRSTNAME;        
        if (dataLength>=FORM_MIN_NAME) {
            success = true;
        }
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_LASTNAME.toLowerCase())>-1) {
        // LNAME  Field
        fieldName = FORM_CLASS_IDENTIFIER_LASTNAME;        
        if (dataLength>=FORM_MIN_NAME) {
            success = true;
        }
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_NAME.toLowerCase())>-1) {
        // Name field
        fieldName = FORM_CLASS_IDENTIFIER_NAME;
        if (dataLength>=FORM_MIN_NAME) {
            success = true;
            writeCookie(COOKIE_NAME, data);
        }
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_PHONE.toLowerCase())>-1) {
        // Phone Field
        fieldName = FORM_CLASS_IDENTIFIER_PHONE;        
        if (data.replace(/[^0-9]/g,"").length>=FORM_MIN_PHONE) {
            success = true;
            writeCookie(COOKIE_PHONE, data);
        }        
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_EMAIL.toLowerCase())>-1) {
        // Email Field
        fieldName = FORM_CLASS_IDENTIFIER_EMAIL;
        var emailRegex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
	if (dataLength>=FORM_MIN_EMAIL && emailRegex.test(data)) {
            success = true;
            writeCookie(COOKIE_EMAIL, data);
        }        
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_ENQUIRY.toLowerCase())>-1) {
        // Enquiry field
        fieldName = FORM_CLASS_IDENTIFIER_ENQUIRY;
        if (dataLength>=FORM_MIN_ENQUIRY) {
            success = true;
            writeCookie(COOKIE_ENQUIRY, data);
        }
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_DATE.toLowerCase())>-1) {
        // Date field
        fieldName = FORM_CLASS_IDENTIFIER_DATE;
        var dateValue = $('#'+event.target.id).val();
        if (dateValue !== '') {
            success = true;
        }
    } else if (targetId.indexOf(FORM_CLASS_IDENTIFIER_TIME.toLowerCase())>-1) {
        // Time field
        fieldName = FORM_CLASS_IDENTIFIER_TIME;
        if ($('#'+event.target.id).val() !== '') {
            success = true;
        }
    }
    
    // Show success or error feedback as required
    if (fieldName!==null) {
        var checkAllFields = true;
        // Set overall form status (submit button etc) if event is 'blur' (No need to do it as it would have done for keyup already)
        if (eventType==='blur') {
            var checkAllFields = false;
        }
        if (success) {
            setFormFieldValidity(formId,fieldName,true,checkAllFields);
        } else {
            if ( (event.type==='blur' && dataLength>0) || ($('#'+formId+'-'+fieldName+'-form-group').hasClass('has-success')) ) {
                // Only show error if event is a 'blur' and there is data in the field 
                // OR
                // the field has previously been set as .success
                setFormFieldValidity(formId,fieldName,false,checkAllFields);
            }
        }
    }     
}


/**
 * Make required changed to form element classes in order to set the 
 * supplied form field as sucess/error as indicated
 * 
 * @param {string} formId - The 'name' of the form: Either FORM_ID_CONTACT or FORM_ID_BOOKING
 * @param {string} fieldIdentifier - The identifier of the form field being set (eg: 'name','phone' etc)
 * @param {boolean} success - True if set field as success, false to set as error
 * @param {boolean} checkAll - If True, checks if all required fields are valid and sets "submit" button status accordingly
 *  
 */
function setFormFieldValidity(formId, fieldIdentifier, success, checkAll) {
    
    // *** Special case for child bookings before 1pm on Sat ***
    if (formId==='booking' && (fieldIdentifier==='time' || fieldIdentifier==='date' || fieldIdentifier==='services') && invalidChildBooking()) {
        $('.booking-services-kids-error').removeClass('hidden');
        $('#booking-kids-form-group').addClass('has-error').removeClass('has-success');
    } else {
        $('.booking-services-kids-error').addClass('hidden');
        $('#booking-kids-form-group').addClass('has-success').removeClass('has-error');
    }

    // *** Special case for booking being made for Special after expiry ***
    if (formId==='booking' && (fieldIdentifier==='date' || fieldIdentifier==='services')) {
        expiryDate = invalidSpecialsBooking();
        if (expiryDate !== false) {
            $('.booking-services-specials-error').removeClass('hidden');
            $('#booking-specials-form-group').addClass('has-error').removeClass('has-success');
            $('.special_expiry_date').text("on the "+expiryDate);
        } else {
            $('.booking-services-specials-error').addClass('hidden');
            $('#booking-specials-form-group').addClass('has-success').removeClass('has-error');
            $('.special_expiry_date').text("before the booking date");
        }
    }
    
    // Remove existing success/falure classes
    $('#'+formId+'-'+fieldIdentifier+'-form-group').removeClass('has-success has-error');
    $('span.'+formId+'-'+fieldIdentifier+'-success').addClass('hidden');
    $('span.'+formId+'-'+fieldIdentifier+'-error').addClass('hidden');
    $('span.'+formId+'-'+fieldIdentifier+'-success.sr-only-hidden').addClass('sr-only-hidden');
    $('span.'+formId+'-'+fieldIdentifier+'-error.sr-only').addClass('sr-only-hidden');
    
    if (success!==null) {
        var status = 'error';
        var notStatus = 'success';
        if (success) {
            status = 'success';
            notStatus = 'error';
        }
        // Toggle .has-success/.has-error on #<formId>-<fieldIdentifier>-form-group
        $('#'+formId+'-'+fieldIdentifier+'-form-group').addClass('has-'+status).removeClass('has-'+notStatus);
        // Toggle .hidden on span.<formId>-<fieldIdentifier>-success and from span.<formId>-<fieldIdentifier>-error
        $('span.'+formId+'-'+fieldIdentifier+'-'+status).removeClass('hidden');
        $('span.'+formId+'-'+fieldIdentifier+'-'+notStatus).addClass('hidden');
        // For screen readers ...
        // Add .sr-only span.<formId>-<fieldIdentifier>-success.sr-only-hidden & remove sr-only-hidden 
        // Add .sr-only-hidden to span.<formId>-<fieldIdentifier>-error.sr-only & remove .sr-only
        $('span.'+formId+'-'+fieldIdentifier+'-'+status+'.sr-only-hidden').addClass('sr-only').removeClass('sr-only-hidden');
        $('span.'+formId+'-'+fieldIdentifier+'-'+notStatus+'.sr-only').addClass('sr-only-hidden').removeClass('sr-only');
    }
    if (checkAll) {
        // IFF NOT all '#form<formId> .form-group.has-feedback' have .has-success then set 'disabled' property on #<formId>Submit to TRUE, else FALSE
        var allFieldsValid = false;
        if ($('#form'+capitalFirstLetter(formId)+' .form-group.has-feedback.has-success').length === $('#form'+capitalFirstLetter(formId)+' .form-group.has-feedback').length) {
            allFieldsValid = true;
        }
        $('#'+formId+'SubmitButton').prop('disabled', (!allFieldsValid)); // Toggle disable on Submit Button
        // Set '#<formId>-form-help .alert' based on allFieldsValid
        if (allFieldsValid) { 
            $('#'+formId+'-form-help .alert').hide(500, function(){ 
                $('#'+formId+'-form-help .alert').addClass('alert-info').removeClass('alert-danger'); 
            });
        } else {
            $('#'+formId+'-form-help .alert').addClass('alert-danger').removeClass('alert-info').show(500);
        }
    }
}


function invalidChildBooking() {    
    var invalidBooking = false;
    if ($('#bookingDate').val().toUpperCase().indexOf('SATURDAY')>=0) {
        // Booking for Saturday
        var hour = $('#bookingTime').pickatime().pickatime('picker').get('select');
        if ( hour===null || hour.hour < BOOKING_SAT_KIDS_START_HOUR) {
            // Booking before 1pm
            if (availableServicesJson!==null) {
                $.each(availableServicesJson, function(name,data){
                    if (CHILD_SERVICE_ARRAY!==null && CHILD_SERVICE_ARRAY.length>0) {
                        $.each(CHILD_SERVICE_ARRAY, function (index, childStr) {
                            if (name.toUpperCase().indexOf($.trim(childStr).toUpperCase()) >= 0) {
                                if (data.hasOwnProperty('selectCount') && data.selectCount>0) {
                                    // Client trying to book on Sat before 1pm for a kids service
                                    invalidBooking = true;
                                }
                            }
                        });
                    }
                });
    
            }
        }
    }

   return invalidBooking;
}

function invalidSpecialsBooking() {
    var invalidBooking = false;
    if ($(".specialService span.badge.added").length > 0) {
        // Special has been selected - Check Date
        var bookingDateStr = $('#hiddenDate').val();
        if (bookingDateStr) {
            var bookingDateElements = bookingDateStr.split('/');
            if (bookingDateElements.length===3 && bookingDateElements[2].length===4) {
                var expiryDateStr = $(".specialService").data("expiry");
                if (expiryDateStr) {
                    var expiryDateElements =  expiryDateStr.split("/");
                    if (expiryDateElements.length===3 && expiryDateElements[2].length===4) {
                        // Compare Dates
                        var bookingDate = Date.parse(bookingDateElements[2]+'-'+bookingDateElements[1]+'-'+bookingDateElements[0]);
                        var expiryDate = Date.parse(expiryDateElements[2]+'-'+expiryDateElements[1]+'-'+expiryDateElements[0]);
                        if (bookingDate > expiryDate) {
                            invalidBooking = expiryDateStr;        
                        }
                    }
                }
            }
        }
    }

   return invalidBooking;
}

function loadContactUsFormValues() {
    var name = readCookie(COOKIE_NAME);
    var phone = readCookie(COOKIE_PHONE);
    var email = readCookie(COOKIE_EMAIL);
    var enquiry = readCookie(COOKIE_ENQUIRY);
    var field;
    if (name!==null) {
        field = document.getElementById('contactName');
        field.value = name;
        formValidate(FORM_ID_CONTACT, field);
    }
    if (phone!==null) {
        field = document.getElementById("contactPhone");
        field.value = phone;
        formValidate(FORM_ID_CONTACT, field);
    }
    if (email!==null) {
        field = document.getElementById("contactEmail");
        field.value = email;
        formValidate(FORM_ID_CONTACT, field);
    }
    if (enquiry!==null) {
        field = document.getElementById("contactEnquiry");
        field.value = enquiry;
        formValidate(FORM_ID_CONTACT, field);
    }
    
}

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

/**
 * Initialises the Google Map and attached internal Panoramic Street View
 */
function googleMapsInitialize() {

    PIANETA = new google.maps.LatLng(-33.7333859,150.9625141); // Location
    
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
        url: '../_/img/mapMarker.png', 
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
 /*
function toggleMap() {
    if ($('#changeMap').text() == MAP_MAPVIEW_PROMPT) {
        streetMap();
    } else {
        insideView();
    }

}
*/

/**
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
    // $('#changeMap').text(MAP_INSIDEVIEW_PROMPT);
}

/**
 * Shows the Internal Google Street View
 */
/*
function insideView() {
    // Make the panorama visible
    PANORAMA.setVisible(true);
    $("#map_canvas > .gm-style:nth-of-type(2)").removeClass('hiddenElement');
    // Hide the marker
    MARKER.setVisible(false);
    // Change the button Prompt  
    $('#changeMap').text(MAP_MAPVIEW_PROMPT);
}
*/

/**
 * Lazy loads the passed image element.
 * The image element would have a low-res src set that displays instantly (named in the form *.small.jpg), 
 * while the high-res image name is set in an attribute named data-src (named in the form *.large.jpg).
 * So, after the page loads, the high-res image is side-loaded where the low-res image is shown.
 * 
 * @param {DOM element} element - The element to lazyLoad the image into
 */
function lazyload(element) {
    // If the element is an <img> (ie has src attribute), we change the src attribute
    var attr = $(element).attr('src');
    if (typeof attr !== typeof undefined && attr !== false) {
        $(element).attr("src", $(element).data('src'));
    } else {
        // element is a div with background image to be lazy loaded
        $(element).css('background-image','url('+$(element).data('src')+')');
    }
}

/**
 * Scrolls to the passed element (minus offset) and sets the URL #hash 
 * 
 * @param {jQuery Element} element - jQuery element to scroll the page to.  If null passed, element with id of hash is used.
 * @param {#string} hash - The hash to add to the url. If NULL is passed, hash is set to element.id (If # character is not first character, will be added automatically)
 * @param {integer} offset - The offset from the elements offset.top  ie: element.offset().top-offset
 */
function scrollToElement(element,hash,offset) {
    // Hide booking overlay if showing (false = do not scroll to last position)
    hideBooking(false);
    if (hash!==null && hash!=='') {
        // Add # as first character if it is not found
        hash = hash.trim();
        if (hash[0]!=='#') {
            hash = '#'+hash;
        }
        // If no element passed, generate it from the hash if one was passed
        if (element===null) {
            element = $(hash);
        }
    } else {
        // Generate the hash from the element passed if element was passed
        if (element!==null) {
            hash = element.id;
        } else {
            hash = null;
        }
    }
    /*
    // Not required - Refer activate.bs.scrollspy
    if (hash !== null) {
        writeHash(hash);
    }
    */
   
    // Wait until no animations are queued for #BOOKING (IE - Has finished being hidden if it was showing)
    if (element!==null) {
        $('#BOOKING').promise().done(function() {
            // Scroll to desired location
            var scrollValue = element.offset().top-offset;
            
            $('html,body').animate({
                scrollTop: (scrollValue)
            }, {
                duration: 500,
                queue: false // Animate asynchronously
            });        
        });
    }
}    


/**
 * Writes anchor hash to browser url/history
 * 
 * @param {string} hash - Anchor #hash to be written 
 */
function writeHash(hash) {
    if (hash!==window.location.hash) {
        var hashIndex = hash.indexOf('#');
        var fullHash = window.location.href.split('#')[0];
        // If hashIndex == 0, hash in the form "#HASH"
        // If hashIndex == -1, hash == '' OR hash == 'http://...'
        // If hashIndex > 0, hash == 'http://.../#HASH'
        if (hashIndex===0) {
            fullHash = fullHash+hash;
        } else if (hashIndex===-1) {
            hash = '';
        } else {
            fullHash = hash;
            hash = hash.split('#')[1];
        }
        // window.location.hash = hash;
        if(history.pushState) {
            history.pushState(null, null, fullHash);
        } else {
            window.location.hash = hash;
        }
    }
}


/**
 * Function to display Parallax effect on all elements with .parallax class
 * DO NOT USE ON MOBILE
 * 
 */
/*
function parallax(){
    var scrollTop = $(window).scrollTop();
    var windowHeight = $(window).height();
    $('.parallax-image').each(function(index, element){
        var parallaxTop = $(element).position().top;
        var parallaxHeight = $(element).height();
        if ( ((scrollTop+windowHeight)>(parallaxTop)) && (scrollTop<(parallaxTop+parallaxHeight)) ) {
            // Parallax element is on screen - do parallax
            var parallaxBackgroundPositionPercentage = ((parallaxTop+parallaxHeight-scrollTop)/(parallaxHeight+windowHeight))-0.5;
            $(element).css('background-position-y',Math.round(windowHeight*parallaxBackgroundPositionPercentage)+'px');
            // $(element).finish().animate({'background-position-y': Math.round(windowHeight*parallaxBackgroundPositionPercentage)+'px'},100);
        }
    });    
}
*/

/**
 * Animates height/width/both to 'auto' with fade effect
 * 
 * @param {string} prop - property to animate ('height','width', or 'both')
 * @param {integer} speed - speed of animation (ms)
 * @param {function} callback - function to get called when animation is complete
 * 
 * @returns {jQuery.each}
 * 
 * @see https://css-tricks.com/snippets/jquery/animate-heightwidth-to-auto/
 */
$.fn.animateAuto = function(prop, speed, callback){
    var elem, height, width;
    return this.each(function(i, el){
        el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("body");
        height = elem.css("height"),
        width = elem.css("width"),
        elem.remove();
        
        if(prop === "height")
            el.animate({"height":height, 'opacity':1}, speed, callback);
        else if(prop === "width")
            el.animate({"width":width, 'opacity':1}, speed, callback);  
        else if(prop === "both")
            el.animate({"width":width,"height":height, 'opacity':1}, speed, callback);
    });  
};

/**
 * Function that toggles the display of #BOOKING. 
 */
function toggleBooking() {
    if ($('#BOOKING').css('opacity')>0) {
        hideBooking();
    } else {
        showBooking();
    }
}

/**
 * Shows #BOOKING and Hides #CONTENT so that customer may create a booking Request
 */
function showBooking() {
    // Facebook Pixel Event Trigger
    if (fbq!==null) {fbq('track', 'ViewContent');};
    // Turn off scrollspy;
    $('nav.navbar').removeClass('active');
    // Hide Bootstrap scrollSpy (Make all top menu items not active)
    $('.nav li.active').removeClass('active');
    // Animate showing Booking form ...
    currentScrollTop = $(document).scrollTop();
    $('#CONTENT').fadeOut(500, function() {
        // Fade in #Booking
        $('#BOOKING').css({opacity: 0, display: 'block'}).animate(
            {opacity: 1, top: 0},
            {   queue: false,
                duration: 500,
                complete: function() {
                    // Correct Booking Hadh
                    writeHash('#BOOKING');
                    startTooltips();
                    insertPreviousBookingData();
                    // incrementJsonCookieValue(COOKIE_TRACK_PANEL_CLICKS, 'booking');
                }
            }
        );
    });
}


/**
 * Hides #BOOKING and re-displays #CONTENT
 * 
 * @param {boolean} scrollToPrevious If false, does not scroll. If true, undefined (not supplied) or null, scrolls to previous position (currentScrollTop).
 */
function hideBooking(scrollToPrevious) {
    if ((typeof scrollToPrevious !== 'boolean') || (scrollToPrevious === null)) { 
        scrollToPrevious = true;
    }
    $('#servicesModal').modal('hide'); // Ensure booking Modal is hidden
    if ($('#CONTENT:hidden').length>0) {
        $('#BOOKING').animate(
            {opacity: 0, top: '-100%'},
            {   queue: false,
                duration: 500,
                complete: function(){
                    $('#BOOKING').css('display','none');
                    writeHash('');
                    $('#CONTENT').fadeIn(500);
                    if (scrollToPrevious) {
                        $(document).scrollTop(currentScrollTop);
                    }
                    // Turn on & Refresh bootstrap scroll-spy
                    $('nav.navbar').addClass('active');
                    $('[data-spy="scroll"]').each(function () {
                        $(this).scrollspy('refresh');
                    });
                }
            }
        );
    }
}


/**
 * Inserts previously recorded booking form field data (from cookie)
 * 
 */
function insertPreviousBookingData() {
    var name = readCookie(COOKIE_NAME);
    var phone = readCookie(COOKIE_PHONE);
    var email = readCookie(COOKIE_EMAIL);
    var date = readCookie(COOKIE_DATE);
    var time = readCookie(COOKIE_TIME);
    var time2 = readCookie(COOKIE_TIME_2);
    var time3 = readCookie(COOKIE_TIME_3);
    var services = readCookie(COOKIE_SERVICES);
    var field;
    if (name!==null) {
        field = document.getElementById('bookingName');
        field.value = name;
        formValidate(FORM_ID_BOOKING, field);
    }
    if (phone!==null) {
        field = document.getElementById('bookingPhone');
        field.value = phone;
        formValidate(FORM_ID_BOOKING, field);
    }
    if (email!==null) {
        field = document.getElementById('bookingEmail');
        field.value = email;
        formValidate(FORM_ID_BOOKING, field);
    }
    var selectedDate = null;
    var day = null;
    if (date!==null) {
        var dateArray = date.split("-");
        if (dateArray.length===3) {
            selectedDate = new Date(dateArray[0], (dateArray[1]-1), dateArray[2]);
            day = selectedDate.getDay(); // sun=0, sat=6            
            $('#bookingDate').pickadate('picker').set('select', selectedDate);
        }
    }
    
    var calendarTimes = null;
    if (selectedDate !== null && day !== null) {
        calendarTimes = CALENDAR_TIMES[day];
    }
    
    // Time - First Preference
    if (time !== null && time > 0) {
        var timeArray = getHoursMinutesArrayFromTotalMinutes(time);
        // If date is set, check time is valid for the date set
        if (calendarTimes !== null && timeArray !== null) {
            var time = getDefaultTime(timeArray, calendarTimes);
        }
        $('#bookingTime').pickatime('picker').set('select', time);
    }
    // Time - Second Preference
    if (time !== null && time > 0 && time2 !== null && time2 > 0) {
        var timeArray = getHoursMinutesArrayFromTotalMinutes(time2);
        // If date is set, check time is valid for the date set
        if (calendarTimes !== null && timeArray !== null) {
            var time2 = getDefaultTime(timeArray, calendarTimes);
        }
        $('#bookingTime2').pickatime('picker').set('select', time2);
    }
    // Time - Third Preference
    if (time !== null && time > 0 && time2 !== null && time2 > 0 && time3 !== null && time3 > 0) {
        var timeArray = getHoursMinutesArrayFromTotalMinutes(time3);
        // If date is set, check time is valid for the date set
        if (calendarTimes !== null && timeArray !== null) {
            var time3 = getDefaultTime(timeArray, calendarTimes);
        }
        $('#bookingTime3').pickatime('picker').set('select', time3);
    }
    
    // Set Default Services
    if (services!==null) {
        try {
            var servicesJson = JSON.parse(services);
            $.each(servicesJson, function(key, value) {
                if (availableServicesJson.hasOwnProperty(key) && value>0) {
                    availableServicesJson[key].selectCount = value;
                    updateChosenServiceButtons($('#service-'+availableServicesJson[key].id), key);
                }
            });
            
        } catch(e) {
            console.error('ERROR: Cookie Services JSON Parse Error ... '+e);
        }
    }
}

/**
 * Calculates hours & minutes from total minutes since midnight
 * 
 * @param {int} totalMinutes - Minutes since midnight
 * @returns {Array} - In the form [hours,minutes]
 */
function getHoursMinutesArrayFromTotalMinutes(totalMinutes) {
    var returnArray = null;
    if (totalMinutes !== null && totalMinutes > 0) {
        returnArray = [Math.floor(totalMinutes/60), totalMinutes%60];
    }
    return returnArray;
}

/* 
 * Checks that the daysFromNow parameter passed does NOT fall on a 
 * disabled day (ie: A CLOSED_DAY).  If it does, the daysFromNow is incremented until
 * a valid working day is found.
 */
function getMinMaxDate(daysFromNow) {
    var currentDate = new Date();
    while ( CLOSED_DAYS.indexOf(correctDayNumber(addDays(currentDate, daysFromNow).getDay())) != -1 ) {
        daysFromNow = daysFromNow + 1;
    }
    return daysFromNow;
}

/*
 * Adds the passed number of days to passed date.
 * The date returned is a new date object, theDate is not changed
 */
function addDays(theDate, daysToAdd) {
    var newDate = new Date();
    newDate.setDate(theDate.getDate() + daysToAdd);
    return newDate;
}

/*
 * Corrects the number of the day of the week based on the set first day
 * The first day of the week can be set to either Sunday or Monday. Anything truth-y sets it as Monday and anything false-y as Sunday:
 * eg) 	System:	sun=0 ...... Sat=6
 * 	Corrected: Mon=1 ...... Sun=7 (if ....  FIRST_DAY = 1 (true)) 
 */
function correctDayNumber(dayNumber) {
    if (FIRST_DAY === true) {
        // Mon=1 ...... Sun=7
        if (dayNumber === 0) {
            dayNumber = 7;
        }
    }
    return dayNumber;
}
/**
 * Adds OO method to strings to capitilize first letter 
 * Usage: stringVariable.capitalizeFirstLetter();
 * @see http://stackoverflow.com/questions/1026069/how-do-i-make-the-first-letter-of-a-string-uppercase-in-javascript
 * 
 * @returns {String} - Returns string with first letter capitalized
 */
String.prototype.capitalizeFirstLetter = function() {
    var str = this.toLowerCase();
    return str.charAt(0).toUpperCase() + str.slice(1);
};

/**
 * Function to capitilize first letter of a string
 * 
 * @returns {String} - Returns string with first letter capitalized (rest lowercase)
 */
function capitalFirstLetter(str) {
    var rtnStr = str.toLowerCase();
    return rtnStr.charAt(0).toUpperCase() + rtnStr.slice(1);    
}

/**
 * Function that initializes all html elements with data-toggle="tooltip" to show bootstrap tooltips 
 * (trigger option sets that tooltip shows on hover, not on focus as is the default)
 */
function startTooltips() {
    $('[data-toggle="tooltip"]').tooltip({trigger : 'hover'});
}

/**
 * Sends form data via ajax with responsive ajax status alerts.
 * 
 * The name of the php file that processes the form data (without the '.php') 
 * must be included in the <form> element with the data name "data-target".
 * 
 * eg) <form .... data-target="ajax/ajax-contact-us" ... >
 * 
 * If scrolling is desired, include the id of the element to scroll to 
 * in a data element named "data-scroll" in the <form> element. (Do NOT include the #)
 * 
 * eg) <form .... data-scroll="contact-us-heading-form" ... >
 * 
 * @param {string} formId The id of the form to be submitted via ajax (Do NOT include the #)
 * @param {string} successHtml HTML to display in alert-text-extra area. If not supplied or NULL, defaults to "We will endeavour to action your request as soon as possible"
 * 
 */
function ajaxSubmitForm(formId, successHtml) {

    if ((typeof successHtml !== 'string') || (successHtml === null)) { 
        successHtml = 'We will endeavour to action your request as soon as possible.<button type="button" class="close" data-dismiss="alert">Close</button>';
    }

    var animationDuration = 500;
    var form = $('#'+formId);
    var formHeight = form.outerHeight();
    var alert = $('<div/>', {
        'class':    'form-alert',
        'html':     '<div class="alert alert-info alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '<span class="alert-text"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><strong >Please Wait</strong> sending data ...</span>' +
                    '</div>'
    });

    // Add invisible alert to DOM ready for fadein and calculate Alert 'auto' height
    form.after(alert);
    var alertOuterHeight = alert.find(':first-child').outerHeight(true);

    // Fade out the form (inc shrink size) - ANIMATION NOT QUEUED
    form.animate({
        'height': 0, 
        'opacity': 0
    }, {
        duration: animationDuration, 
        queue: false, 
        complete: function() {        
            // Mark form as remove via display: none
            form.css({
                'display': 'none'
            });
        }
    });
    
    // Fade in the alert - ANIMATION NOT QUEUED
    alert.animate({
        'height': alertOuterHeight,
        'opacity': 1
    }, {
        duration: animationDuration,
        queue: false
    });
   
    // Get the element to scroll to if it exists
    var scrollId = form.data('scroll');
    if ((typeof scrollId === 'string') && (scrollId !== null) && (scrollId !== 'undefined')) { 
        // Scroll to top of supplied element
        scrollToElement($('#'+scrollId),form.parents('section')[0].id,50); // 50 accounts for fixed header
    }
    
    // Get the data by serializing form
    var ajaxData = $('#'+formId).serialize();
    
    // Add selected services if required
    if (formId.toLowerCase().indexOf('book')>=0) {
        var services = "&bookingServices=";
        firstService = true;
        $.each(availableServicesJson, function(name, data) {
            if (availableServicesJson[name].hasOwnProperty('selectCount') && availableServicesJson[name].selectCount>0) {
                if (firstService) {
                    services += name.trim();
                    firstService = false;
                } else {
                    services += ","+name.trim();
                }
            }
        });
        ajaxData += services;
    }
    
    // Get the URL of the target data attribute 
    var ajaxURL = window.location.href.slice(0,window.location.href.lastIndexOf("/"))+'/'+form.data('target')+'.php';

    // Send Ajax Data
    var posting = $.post(ajaxURL, ajaxData);

    // On form alert close, re-display form
    alert.find('button').click(function() {
        closeFormAlert(form, formHeight, alert);
    });
    

    // On ajax success fade out info alert, and fade in success alert.  
    // Add success alert at bottom of hidden form with date/time of successful submit
    posting.done(function(data) {
        // *** Ajax SUCCESS ***
        if (data==='OK') {
            alert.find('span.alert-text').html('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><strong>Thankyou</strong><br><br><small class="alert-text-extra">'+successHtml+'</small>');
            alert.find('div').addClass('alert-success').removeClass('alert-info');
        } else {
            alert.find('span.alert-text').html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>ERROR</strong> sending data<br><br><small class="alert-text-extra">There has been a problem when we tried to send your request.<br>You can close this alert and try again, alternatively call us on (02) 9894 4247 for further assistance.<br><br><button type="button" class="btn btn-default btn-sm" data-dismiss="alert">Close</button></small>');
            alert.find('div').addClass('alert-danger').removeClass('alert-info');
        }
        alert.animate({'height': alert.find(':first-child').outerHeight(true)},animationDuration,function() {
            // Set height to auto (for if/when user changes window size)
            alert.css('height', 'auto');
        });
        // On success/error alert close, re-display form
        // NB: Added here so that "Close" button added dynamically will have click detected
        alert.find('button').click(function() {
            closeFormAlert(form, formHeight, alert);
        });
    });

    
    // On ajax error, fade out info alert, and fade in error alert
    posting.fail(function(data) {
        // *** Ajax FAIL ***
        alert.find('span.alert-text').html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>ERROR</strong> completing data<br><br><small class="alert-text-extra">There has been a problem when we tried to complete your request.<br>You can close this alert and try again, alternatively call us on (02) 9894 4247 for further assistance.<br><br><button type="button" class="btn btn-default btn-sm" data-dismiss="alert">Close</button></small>');
        alert.find('div').addClass('alert-danger').removeClass('alert-info');
        alert.animate({'height': alert.find(':first-child').outerHeight(true)},animationDuration,function() {
            // Set height to auto (for if/when user changes window size)
            alert.css('height', 'auto');
        });
        // On error alert close, re-display form
        alert.find('button').click(function() {
            closeFormAlert(form, formHeight, alert);
        });
    });
}

/**
 * Hides the form alert, and redisplays the form
 * 
 * @param {jQuery Element} formElement - The form to re-display
 * @param {integer} formHeight - The original height of the form that needs to be animated to
 * @param {jQuery Element} alertElement - The alert that need to be hidden
 */
function closeFormAlert(formElement, formHeight, alertElement) {    
    // Close button clicked on a form alert - Delete alert and show form
    var animationDuration = 500;

    formElement.css({
        'display': 'block'
    }).animate({
        'height': formHeight, 
        'opacity': 1
    }, {
        duration: animationDuration, 
        queue: false
    });
    alertElement.animate({
        'height': 0,
        'opacity': 0
    }, {
        duration: animationDuration,
        queue: false,
        complete: function() {
            // Remove generated alert
            alertElement.remove();
        }
    });

}

/****************************************************************************************
 ********************************* BOOKING FUNCTIONS ************************************
 ****************************************************************************************/

/** REMOVED - Now loaded at start by PHP - refer define.php & booking-form.php
 * Loads available services via ajax. 
 * 
 * @returns {json Object} - The read service (refer /ajax/ajax-services.php).  Null on error.
 */
/*
function getCurrentlyAvailableServices() {
    
    var ajaxURL = window.location.href.slice(0,window.location.href.lastIndexOf("/"))+'/ajax/ajax-services.php';
    // Send Ajax Data
    var posting = $.post(ajaxURL);

    posting.done(function(data) {
        // *** Ajax SUCCESS ***
        if (data!==null && data!=="" && data.toUpperCase()!=='NULL') {
            try {
                availableServicesJson = JSON.parse(data);
                populateServices();
            } catch(e) {
                console.error('ERROR: Available Services JSON Parse Error ... '+e);
            }
        } else {
            console.error('ERROR: Services JSON string == Null');
        }
    });
    
    // On ajax error, fade out info alert, and fade in error alert
    posting.fail(function(data) {
        // *** Ajax FAIL ***
        console.error("ERROR: AJAX could Not load services ... "+data);
    });
}
*/

/** REMOVED - Now loaded at start by PHP - refer define.php & booking-form.php
 * Populates booking form with available services.
 * Generates services available for selection when making an online booking. 
 * Services are generated as a bootstrap button with number badge indicating the number of that service selected. 
 * eg ... 
 *      <button class="btn btn-sm" type="button">Style Cut <small>(Women)</small><span class="badge pull-right zero">0</span></button>
 *      <button class="btn btn-sm" type="button">Tint <small>(Full Head)</small><span class="badge pull-right added">1</span></button>
 *      
 */
/*
function populateServices() {
    if (availableServicesJson!==null) {
        var htmlData = '';
        var serviceNumber = 0;
        $.each(availableServicesJson, function(name, data){
            availableServicesJson[name].id = serviceNumber;
            htmlData = htmlData + '<div id="service-'+serviceNumber+'" class="service';
            if (name.indexOf('special')>=0) {
                // Highlight the service if it is a "special"
                htmlData = htmlData + ' specialService" data-toggle="tooltip" data-placement="top" title="SPECIAL">';
            } else {
                 htmlData = htmlData + '">';
            }
            htmlData = htmlData  +   '<button type="button" class="btn btn-sm" onclick="modifySelectedServicePill(this, true);">'
                                        +'<span class="pill-text pull-left">'
                                            +'<span class="pill-modify glyphicon glyphicon-plus"></span>'
                                            + name
                                        +'</span>'
                                    +'</button>'
                                    +'<span class="badge zero" onclick="modifySelectedServicePill(this, false);">'
                                        +'<span class="pill-count">0</span>'
                                        +'<span class="pill-modify glyphicon glyphicon-minus"></span>'
                                    +'</span></div>';
            serviceNumber++;
        });                    
        $('#bookingServicePills').html(htmlData);
    } else {
        console.error('ERROR: populateServices availableServicesJson == NULL');
    }
}
*/

/**
 * Add or remove a service pill. 
 * Modifies selectCount for the service in the array, and then triggers pill animation 
 * which when finished, triggers the pill/button to be updated and form validated
 * 
 * @param {DOM element} element - The service pill that has been clicked 
 * @param {boolean} adding - If true, service is incremented, else service is decremented
 * 
 */
function modifySelectedServicePill(element, adding) {
    // Read the service text (not the badge)
    var target;
    if (adding) {
        target = $(element).parent('div.service');
    } else {
        target = $(element).parents('div.service');
    }
    var contents = target.find('.pill-text');
    // var service = contents.html().replace('<span class="pill-modify glyphicon glyphicon-plus"></span>', '');
    var service = contents.html().replace('<span class="pill-modify glyphicon glyphicon-plus"></span>', '').split('<small> + </small>').join(' and ');
    var currentSelectionCount = 0;

    if (availableServicesJson.hasOwnProperty(service)) {
    
        // Get current service count
        if (availableServicesJson[service].hasOwnProperty("selectCount")){
            currentSelectionCount = availableServicesJson[service].selectCount;
        }
        if (!adding && currentSelectionCount===0) {
            // user clicked remove, but service count=0, so add instead
            adding=true;
        }
        
        // Modify count as required
        if (adding) {
            if (currentSelectionCount<FORM_MAX_NUMBER_ORDERS) {
                currentSelectionCount++;
            }
        } else {
            currentSelectionCount--;            
        }
        availableServicesJson[service].selectCount = currentSelectionCount;

        // Animate service flying to/from "#chosenServices" button
        animatePill(target, service, adding);
    }
}

/**
 * Animates a partially transparent Service Pill being added or removed from #selectedServices-modal-button.
 * 
 * @param {jQuery element} servicePill - The servicePill button to be animated
 * @param {string} service - The name of the service being added/removed
 * @param {boolean} adding - If true, pill animates TO the #selectedServices-modal-button, else pill animates AWAY from it.
 */
function animatePill(servicePill, service, adding) {
    var dummyService = servicePill.clone();
    var chosenButton = $('#selectedServices-modal-button');
    var startTop = servicePill.offset().top+$('#BOOKING').scrollTop();
    var startLeft = servicePill.offset().left;
    var finishTop = chosenButton.offset().top+$('#BOOKING').scrollTop();
    var finishLeft = chosenButton.offset().left;
    
    if (!adding) {
        // Removing service, so swap animation start/finish values
        var tempTop = startTop;
        var tempLeft = startLeft;
        startTop = finishTop;
        startLeft = finishLeft;
        finishTop = tempTop;
        finishLeft = tempLeft;
    }
    dummyService.css({
        'position': 'absolute', 
        'top':      startTop+'px',
        'left':     startLeft+'px',
        'margin':   0,
        'z-index':  9
    }).appendTo('#BOOKING').animate({
        'top':      finishTop+'px',
        'left':     finishLeft+'px',
        'opacity':  0.2
    },500,function(){
        // Delete dummy element from DOM
        dummyService.remove();
        servicePill.find('.badge').find('.pill-count').text(availableServicesJson[service].selectCount);
        // Now update the count and visual display of the pills/buttons as required
        updateChosenServiceButtons(servicePill, service);
    });
}

/**
 * Show the services that have been chosen as a table in the popup #servicesModal. 
 * Includes a 'remove' button next to each service for easy removal.
 * 
 */
function showChosenServicesInModal(){
    var serviceOutput;
    var totalServiceCount = 0;
    if (availableServicesJson!==null) {
        serviceOutput = '<table><tbody>';
        $.each(availableServicesJson, function(name, data) {
            if (availableServicesJson[name].hasOwnProperty('selectCount') && availableServicesJson[name].selectCount>0) {
                serviceOutput = serviceOutput + '<tr>'
                                                    +'<td>'+availableServicesJson[name].selectCount+'x</td>'
                                                    +'<td class="service">'+name+'</td>'
                                                    +'<td><button class="btn btn-primary btn-xs" onclick="removeChosenServiceFromModal(this,'+availableServicesJson[name].id+');">Remove</button></td></tr>';
                totalServiceCount++;
            }
        });
    } else {
        console.error("ERROR: showChosenServicesInModal availableServicesJson == NULL");
    }

    if (totalServiceCount===0) {
        serviceOutput = "No Services Selected";
    }
    $('#modal-selected-services').html(serviceOutput);
}

/**
 * Removes a chosen service when "remove" button is clicked from within the '#modal-selected-services' popup. 
 * IE: Decrements selectCount for that service in the array, updates the display of selected services in the popup, 
 * and  Calls for an update to the buttons in the main booking form.
 * 
 * @param {DOM clicked button element} removeButton - The 'remove' button that was clicked (Used to find the service to remove)
 * @param {int} serviceID - The service ID number (Used to easily relate the service written in the modal, to the service pill in the main booking form)
 */
function removeChosenServiceFromModal(removeButton, serviceID) {
    // Get the service name using the passed removeButton
    var serviceName = $(removeButton).parents('tr').find('td.service').html();
    // Get the service pill in the main booking form using the passed serviceID
    var servicePill = $('#bookingServicePills #service-'+serviceID);
    // Decrement the service in the array. Update modal and booking form.
    if (availableServicesJson.hasOwnProperty(serviceName) && servicePill.length===1) {
        if (availableServicesJson[serviceName].selectCount > 0) {
            availableServicesJson[serviceName].selectCount--;
            // If selectCount for the service == 0, fade the service from the modal before updating displays
            if (availableServicesJson[serviceName].selectCount===0) {
                $(removeButton).parents('tr').fadeOut(250, function(){
                    updateModalSelectedServices(servicePill, serviceName);
                });
            } else {
                // Update services dfisplayed in the modal and the booking form
                updateModalSelectedServices(servicePill, serviceName);
            }
        }
    }
}

/**
 * Update selected services display in the #servicesModal and the main booking form
 * 
 * @param {jQuery element} servicePill - The service pill to be updated in the main booking form
 * @param {string} serviceName - The name of the service to be updated 
 * 
 */
function updateModalSelectedServices(servicePill, serviceName) {
    showChosenServicesInModal();
    updateChosenServiceButtons(servicePill, serviceName);                        
}

/** 
 * Resets all chosen services in the array to selectCount = 0, resets all individual 
 * service buttons to 0 (and visual classes), resets #servicesModal 
 * total services selected button to 0, and initiates a BOOKING form re-validation 
 * where valid=false
 */
function removeAllServices() {
    if (availableServicesJson!==null) {
        $.each(availableServicesJson, function(name, data) {
            availableServicesJson[name].selectCount = 0;
        });
    } else {
        console.error("availableServicesJson == NULL");
    }
    // Clear ALL Booking Pills - Rather than call updateChosenServiceButtons
    //      for each service, just reset all service buttone from here
    $('#bookingServicePills span.badge').each(function(index,element){
        $(element).addClass('zero').removeClass('added');
        $(element).find('span.pill-count').text('0');
    });
    // Clear "#selectedServices-modal-button" total selected services Button
    var chosenButton = $('#selectedServices-modal-button');
    chosenButton.addClass('btn-default').removeClass('btn-primary');
    var badge = chosenButton.find('.badge');
    badge.addClass('zero').removeClass('added');
    badge.text('0');
    setFormFieldValidity(FORM_ID_BOOKING,FORM_CLASS_IDENTIFIER_SERVICES,false,true);
}

/**
 * Updates an individual service button (servicePill) with a new count 
 * and the total services selected button (#selectedServices-modal-button) 
 * with the total number of services selected, and the correct class for the visual 
 * representation.
 * This is done AFTER any pill animations have been completed, as rapid clicking can cause 
 * errors in the count due to the time it takes for animation to complete
 * 
 * @param {jQuery element} servicePill - The service button (pill) to be updated
 * @param {string} service - The name of the service to be updated
 * 
 */
function updateChosenServiceButtons(servicePill, service) {
    var buttonPrimaryClass = "btn-primary";
    var buttonDefaultClass = "btn-default";
    var badgeAddedClass = "added";
    var badgeZeroClass = "zero";
    
    // Adjust Pill appearance by modifying classes, and set value
    var zeroService = true;
    if (availableServicesJson.hasOwnProperty(service) && availableServicesJson[service].hasOwnProperty('selectCount')) {
        if (availableServicesJson[service].selectCount > 0) {
            zeroService = false;
        }
    }
    if (zeroService) {
        servicePill
            .find('.badge')
            .addClass(badgeZeroClass)
            .removeClass(badgeAddedClass)
            .find('.pill-count')
            .text('0');
    } else {
        servicePill
            .find('.badge')
            .addClass(badgeAddedClass)
            .removeClass(badgeZeroClass)
            .find('.pill-count')
            .text(availableServicesJson[service].selectCount);
    }
    
    // Adjust Total chosen services button appearance and badge value
    var totalChosenServices = getTotalChosenServicesCount();
    if (totalChosenServices===0) {
        $('#selectedServices-modal-button')
            .addClass(buttonDefaultClass)
            .removeClass(buttonPrimaryClass)
            .find('.badge')
            .addClass(badgeZeroClass)
            .removeClass(badgeAddedClass)
            .text(getTotalChosenServicesCount()
        );
        // No services selected - Need to re-validate the booking form as valid=false for the services fiels
        setFormFieldValidity(FORM_ID_BOOKING,FORM_CLASS_IDENTIFIER_SERVICES,false,true);
    } else {
        $('#selectedServices-modal-button')
            .addClass(buttonPrimaryClass)
            .removeClass(buttonDefaultClass)
            .find('.badge')
            .addClass(badgeAddedClass)
            .removeClass(badgeZeroClass)
            .text(getTotalChosenServicesCount()
        );
        // Services added - Need to re-validate the booking form as valid=true for the services field
        setFormFieldValidity(FORM_ID_BOOKING,FORM_CLASS_IDENTIFIER_SERVICES,true,true);
    }
}

/**
 * Counts the total number of services selected for a booking
 * 
 * @returns {int} - The total number of bookings selected for a booking
 */
function getTotalChosenServicesCount() {
    var total = 0;
    if (availableServicesJson!==null) {
        var selectedServices = {};
        $.each(availableServicesJson, function(name, data) {
            if (availableServicesJson[name].hasOwnProperty('selectCount') && availableServicesJson[name].selectCount>0) {
                var serviceCount = availableServicesJson[name].selectCount;
                selectedServices[name] = serviceCount;
                total = total + availableServicesJson[name].selectCount;
            }
        });
        writeCookie(COOKIE_SERVICES, JSON.stringify(selectedServices));
    }
    return total;
}

/**************************************************************** 
 ******************* Send TRACKING Info to DB *******************
 ****************************************************************/

/*  *** DC *** No longer using Tracking
function sendTracking() {
    var ajaxURL = window.location.href.slice(0,window.location.href.lastIndexOf("/"))+'/ajax/ajax-tracking.php';

    var ajaxData = {};
    var temp;
    
    temp = readCookie(COOKIE_piaID); if (temp!==null) { ajaxData.piaID=encodeURI(temp); }
    temp = readCookie(COOKIE_NAME); if (temp!==null) { ajaxData.piaName=encodeURI(temp); }
    temp = readCookie(COOKIE_PHONE); if (temp!==null) { ajaxData.piaPhone=encodeURI(temp); }
    temp = readCookie(COOKIE_EMAIL); if (temp!==null) { ajaxData.piaEmail=encodeURI(temp); }
    temp = readCookie(COOKIE_SERVICES); if (temp!==null) { ajaxData.piaServices=encodeURI(temp); }
    temp = readCookie(COOKIE_TRACK_PANEL_CLICKS); if (temp!==null) { ajaxData.piaPanelClicks=encodeURI(temp); }
    temp = TRACKING_LAST_IP; if (temp!==null && temp!=='') { ajaxData.piaLastIp=encodeURI(temp); }
    temp = TRACKING_LAST_IP_PROXY; if (temp!==null && temp!=='') { ajaxData.piaLastIpProxy=encodeURI(temp); }
    temp = TRACKING_SESSION_ID; if (temp!==null && temp!=='') { ajaxData.piaLastSessionId=encodeURI(temp); }

    // Send Ajax Data
    var posting = $.post(ajaxURL, ajaxData);    

    // On ajax success, add piaID into cookies ...
    posting.done(function(data) {
        if (isInt(data)) {
            writeCookie(COOKIE_piaID, parseInt(data));
        }
    });
}
*/


/*****************************************************************************************
 ********************************* COOKIE FUNCTIONS **************************************
 * @see http://stackoverflow.com/questions/1458724/how-do-i-set-unset-cookie-with-jquery *
 *****************************************************************************************/

/**
 * Increments an integer at the specified key stored in a json cookie with the specified name.
 * 
 * @param {string} name - Name of the cookie the json is stored In
 * @param {string} key - Name of the json attribute (key) that will have its value incremented
 * 
 */
/* No longer using Tracking ***
function incrementJsonCookieValue(name, key) {
    var currentCookie = readCookie(name);
    var currentJson = {};
    var cookieValue = 1;
    if (currentCookie!==null) {
        // Parse current Json
        try {
            currentJson = JSON.parse(currentCookie);
            if (currentJson.hasOwnProperty(key)) {
                cookieValue = currentJson[key]+1;
            }
        } catch(e) {
            console.error('ERROR: Cookie JSON Parse Error ... '+e);
        }
    }
    currentJson[key] = cookieValue;
    writeCookie(name, JSON.stringify(currentJson));
}
*/

/**
 * Increments the integer stored in a cookie with the supplied name.
 * If cookie with the supplied name Is not found or found to be a non-integer, the cookie will be created/modified to 1
 *  
 * @param {string} name - Name of the cookie to increment
 * 
 */
/*
function incrementCookie(name) {
    var currentCookie = readCookie(name);
    var cookieValue = 0;
    if (currentCookie!==null) {
        // Cookie exists
        var numberValue = parseInt(currentCookie);
        if (!isNaN(numberValue)) {
            cookieValue = numberValue;
        }
    }
    writeCookie(name, (cookieValue+1));
}
*/

/**
 * Writes a cookie to users PC
 * 
 * @param {string} name - Name of the cookie to be stored
 * @param {string} value - Value to be stored in the cookie
 * @param {int} days - Number of days before cookie expires (default = 36500 days = 100 years)
 */
function writeCookie(name, value, days) {

    if (!days) {
        days = 36500;
    }
    
    var expires;
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();

    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

/**
 * Reads a cookie and returns its value
 * 
 * @param {string} name - Name of the cookie to be retrieved
 * @returns {string} - Value of the requested cookie
 */
function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

/**
 * Erases a cookie
 * 
 * @param {string} name - Name of the cookie to be erased
 * 
 */
function eraseCookie(name) {
    createCookie(name, "", -1);
}

/*****************************************************************************
 **************************** Utility Functions ******************************
 *****************************************************************************/

/**
 * Checks if a value Is an Integer 
 * 
 * @param {Unknown Type} value - The value to be tested to see if it is an integer
 * @returns {Boolean} - True if an integer, else false
 * 
 * @see http://stackoverflow.com/questions/14636536/how-to-check-if-a-variable-is-an-integer-in-javascript
 */
function isInt(value) {
  var x;
  if (isNaN(value)) {
    return false;
  }
  x = parseFloat(value);
  return (x | 0) === x;
}