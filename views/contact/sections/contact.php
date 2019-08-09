
<!--==========================
Contact Section
============================-->
<section id="contact">
    <div class="container wow fadeInUp">
        <div class="row">
            <h1 class="contact-title">Contact us</h1>
            <div class="col-sm-3 col-sm-push-2">
                <div class="info">
                    <div>
                        <h4>KEEP IN TOUCH!</h4>
                        <p>We enjoy keeping in contact with our customers and partners. Feel free to contact our friendly customer support staff via phone, or by using the form below.</p>
                    </div>

                    <div>
                        <h4>DETAILS</h4>
                        <p>support@closettocleaners.com</p>
                    </div>

                    <div>
                        <h4>OFFICE HOURS</h4>
                        <p><b>Monday – Friday</b> <br>
                            9:00am – 5:00pm EST</p>
                        <p><b>Saturday</b><br>
                            10:00am – 1:00pm EST</p>
                        <p><b>Sunday</b><br>
                            Closed</p>
                    </div>

                </div>
            </div>

            <div class="col-sm-5 col-sm-push-2">
                <div class="form">
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="form-group">
                            <label for="type">Select you role</label>
                            <select name="type" id="type" data-rule="required" data-msg="Please specify the role">
                                <option value="">Select One</option>
                                <option value="tenant">I’m a Tenant.</option>
                                <option value="manager">I’m a Property Manager.</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Enter name</label>
                            <input type="text" name="name" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Enter email address</label>
                            <input type="email" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Enter phone number</label>
                            <input type="text" name="phone" id="phone" placeholder="Your Phone" data-rule="phone" data-msg="Please enter a valid phone number" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">Enter subject</label>
                            <input type="text" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="message">Enter message</label>
                            <textarea name="message" id="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                        </div>

                        <div id="sendmessage">Your message has been sent. Thank you!</div>
                        <div id="errormessage"></div>

                        <div class="text-center"><button type="submit" id="btn-submit" style="width: 100%;">Send Message</button></div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
