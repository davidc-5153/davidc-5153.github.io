<?php

/** 
 * Contact Us Form for Pianeta Mobile Website
 * 
 * @author David Ceccato
 * @version 20161111
 * 
 * To toggle success/error states ...
 *      - Toggle between .has-success & .has-error in #contact-XXXX-form-group
 *      - Toggle .hidden on span.contact-XXXX-success or span.contact-XXXX-error
 *      - Toggle between .sr-only & .sr-only-hidden for span.contact-XXXX-error.sr-only or span.contact-XXXX-success.sr-only as required
 *      * Finally, once all fields (#contact-XXXX-form-group) have .has-success, then remove #contactSubmit:disabled
 * 
 */     

?>

<form id="<?php echo PHP_FORM_CONTACT; ?>" class="form-horizontal" action="/" method="post" autocomplete="on" data-target="ajax/ajax-contact-us" data-scroll="contact-us-heading-form">
    <div id="contact-name-form-group" class="form-group has-feedback">
        <label class="col-sm-2 control-label" for="contactName">Name</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input id="contactName" class="form-control" name="contactName" maxlength="100" type="text" placeholder="Your name..."/>
            </div>
            <span class="contact-name-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-name-success sr-only-hidden hidden">(success)</span>
            <span class="contact-name-error help-block hidden">Please enter your name.</span>
            <span class="contact-name-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-name-error sr-only-hidden hidden">(error)</span>
        </div>
    </div>
    <div id="contact-phone-form-group" class="form-group has-feedback">
        <label class="col-sm-2 control-label" for="contactPhone">Phone</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></span>
                <input id="contactPhone" class="form-control" name="contactPhone" maxlength="25" type="tel" placeholder="Phone number..."/>
            </div>
            <span class="contact-phone-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-phone-success sr-only-hidden hidden">(success)</span>
            <span class="contact-phone-error help-block hidden">Please enter a valid contact phone number.</span>
            <span class="contact-phone-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-phone-error sr-only-hidden hidden">(error)</span>
        </div>
    </div>
    <div id="contact-email-form-group" class="form-group has-feedback">
        <label class="col-sm-2 control-label" for="contactEmail">Email</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                <input id="contactEmail" class="form-control" name="contactEmail" maxlength="100" type="email" placeholder="Email address..."/>
            </div>
            <span class="contact-email-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-email-success sr-only-hidden hidden">(success)</span>
            <span class="contact-email-error help-block hidden">Please enter a valid email address.</span>
            <span class="contact-email-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-emnail-error sr-only-hidden hidden">(error)</span>
        </div>
    </div>
    <div id="contact-enquiry-form-group" class="form-group has-feedback">
        <label class="col-sm-2 control-label" for="contactEnquiry">Enquiry</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span>
                <textarea id="contactEnquiry" class="form-control" name="contactEnquiry" maxlength="250" rows="3" placeholder="How can we help you?"></textarea>
            </div>
            <span class="contact-enquiry-success glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-enquiry-success sr-only-hidden hidden">(success)</span>
            <span class="contact-enquiry-error help-block hidden">What is the nature of your enquiry?</span>
            <span class="contact-enquiry-error glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
            <span class="contact-enquiry-error sr-only-hidden hidden">(error)</span>
        </div>
    </div>
    <div id="contact-form-help" class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="alert alert-info" role="alert">All fields must be completed</div>
        </div>
    </div>
    <div class="form-group">
        <div id="contactSubmit" class="col-sm-offset-2 col-sm-10">
            <button id="contactSubmitButton" type="submit" class="btn btn-primary" disabled="disabled" onclick="ajaxSubmitForm('<?php echo PHP_FORM_CONTACT; ?>','<?php echo PHP_CONTACT_US_SUCCESS; ?>');">Submit Your Enquiry</button>
        </div>
    </div>
</form>

