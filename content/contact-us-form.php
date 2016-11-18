<?php

/** 
 * Contact Us Form for Pianeta Mobile Website
 * 
 * @author David Ceccato
 * @version 20161111
 * 
 */

?>

<form id="formContactUs" action="/" method="post">
    <table class="contact-us">
        <tr>            
            <td><span class="glyphicon glyphicon-user" aria-hidden="true"></span><label for="contactName">Name</label></td>
            <td><input id="contactName" name="contactName" maxlength="100" size="20" value="" type="text" placeholder="Your name ..."/></td>
        </tr>
    </table>
    <ul>
    <li>
            <label for="contactPhone"><img src="_/img/icon-phone.png" alt="phone"/>Phone</label>
            <input id="contactPhone" name="contactPhone" size="20" maxlength="20" value="" type="text" tabindex="52" placeholder="Phone number ...">
        </li>
        <li>
            <label for="contactEmail"><img src="_/img/icon-email.png" alt="email"/>Email</label>
            <input id="contactEmail" name="contactEmail" type="text" size="20" maxlength="100" value="" tabindex="53" placeholder="Email address ..."/> 
        </li>
        <li>
            <label for="contactComments" class="labelHeading"><img src="_/img/icon-text.png" alt="comments"/>Comments...</label>
            <textarea id="contactComments" name="contactComments" rows="3" maxlength="250" tabindex="54" placeholder="How can we help you ?"></textarea> <!-- cols="40" -->
        </li>
        <li>
            <button id="contactUsSubmit" type="submit" name="submit" value="Submit Your Enquiry" tabindex="55">Submit Your Enquiry</button>	
        </li> 
    </ul>
    <div id="contactFormError" class="bookingPageErrors">
            <p>All fields must be completed.</p>
    </div>
</form>
