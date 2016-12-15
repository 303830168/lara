@extends('layouts.wap.index')
@section('content')

    <div class="content">

        <div class="container no-bottom">
            <h4>无穷大分享平台 ！</h4>
            <p>
                分享你的精彩
            </p>
        </div>

        <div class="decoration"></div>




        <div class="decoration"></div>

        <div class="one-half-responsive">
            <h4>快来分享 赢红包吧！！！</h4>
            <p>{!! $content->content !!}Use the form to send us a message, it's AJAX and PHP powered and it's easy to use!</p>
            <div class="container no-bottom">
                <div class="contact-form no-bottom">
                    <div class="formSuccessMessageWrap" id="formSuccessMessageWrap">
                        <div class="big-notification green-notification">
                            <h3 class="uppercase">Message Sent </h3>
                            <a href="#" class="close-big-notification">x</a>
                            <p>Your message has been successfuly sent. Please allow up to 48 hours for a reply! Thank you!</p>
                        </div>
                    </div>

                    <form action="php/contact.php" method="post" class="contactForm" id="contactForm">
                        <fieldset>
                            <div class="formValidationError" id="contactNameFieldError">
                                <div class="static-notification-red tap-dismiss-notification">
                                    <p class="center-text uppercase">Name is required!</p>
                                </div>
                            </div>
                            <div class="formValidationError" id="contactEmailFieldError">
                                <div class="static-notification-red tap-dismiss-notification">
                                    <p class="center-text uppercase">Mail address required!</p>
                                </div>
                            </div>
                            <div class="formValidationError" id="contactEmailFieldError2">
                                <div class="static-notification-red tap-dismiss-notification">
                                    <p class="center-text uppercase">Mail address must be valid!</p>
                                </div>
                            </div>
                            <div class="formValidationError" id="contactMessageTextareaError">
                                <div class="static-notification-red tap-dismiss-notification">
                                    <p class="center-text uppercase">Message field is empty!</p>
                                </div>
                            </div>
                            <div class="formFieldWrap">
                                <label class="field-title contactNameField" for="contactNameField">Name:<span>(required)</span></label>
                                <input type="text" name="contactNameField" value="" class="contactField requiredField" id="contactNameField"/>
                            </div>
                            <div class="formFieldWrap">
                                <label class="field-title contactEmailField" for="contactEmailField">Email: <span>(required)</span></label>
                                <input type="text" name="contactEmailField" value="" class="contactField requiredField requiredEmailField" id="contactEmailField"/>
                            </div>
                            <div class="formTextareaWrap">
                                <label class="field-title contactMessageTextarea" for="contactMessageTextarea">Message: <span>(required)</span></label>
                                <textarea name="contactMessageTextarea" class="contactTextarea requiredField" id="contactMessageTextarea"></textarea>
                            </div>
                            <div class="formSubmitButtonErrorsWrap">
                                <input type="submit" class="buttonWrap button button-green contactSubmitButton" id="contactSubmitButton" value="SUBMIT" data-formId="contactForm"/>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="decoration hide-if-responsive"></div>
        <div class="one-half-responsive last-column">
            <div class="container no-bottom">
                <h4>Contact Information</h4>
                <p>
                    <strong>Postal Information</strong><br>
                    PO Box 16122 Collins Street West<br>
                    Victoria 8007 Australia
                </p>
                <p>
                    <strong>Envato Headquarters</strong><br>
                    121 King Street, Melbourne <br>
                    Victoria 3000 Australia
                </p>
                <p>
                    <strong>Envato Pty Ltd</strong><br>
                    ABN 11 119 159 741
                </p>
                <p>
                    <strong>Contact Information:</strong><br>
                    <a href="#" class="contact-call">Phone: + 123 456 7890</a>
                    <a href="#" class="contact-text">Message: + 123 456 7890</a>
                    <a href="#" class="contact-mail">Email: mail@doamin.com</a>
                    <a href="#" class="contact-facebook">Fanpage: enabled.labs</a>
                    <a href="#" class="contact-twitter">Twitter: @iEnabled</a>
                </p>
            </div>
        </div>


        <div class="decoration"></div>
        <div class="footer">
            <div class="socials">
                <a href="#" class="twitter-icon"></a>
                <a href="#" class="google-icon"></a>
                <a href="#" class="facebook-icon"></a>
            </div>
            <div class="clear"></div>
            <p class="copyright">
                COPYRIGHT 2015.<br>
                ALL RIGHTS RESERVED
            </p>
        </div>

    </div>

@stop