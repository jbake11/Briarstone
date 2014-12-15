<div class="row">
    <div class="col-lg-6">
        <h2>Services</h2>
        <ul>
            <li>Home plan design</li>
            <li>New homes</li>
            <li>Remodeling</li>
            <li>Additions</li>
            <li>Bathrooms</li>
            <li>Kitchens</li>
            <li>Finished basements</li>
            <li>Walkout egress steps and windows</li>
            <li>Exterior water infiltration (brick, wood shingles and flashing)</li>
            <li>Insurance work (non emergency)</li>
        </ul>
    </div>
    <div class="col-lg-6">
        Whether it is a new house, kitchen, basement, bathroom, or insurance repair.  Briarstone Building is able to handle all of your remodeling and new construction needs. From design phase to completion – Briarstone Building offers Turn Key construction. We are licensed and insured to handle any project. Briarstone Building will take your simple or complicated construction project and complete it in a fast, friendly, and competive manner. Our quality of construction and eye for detail always shows through when completed.
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        We also offer realty services to find the home that fits your lifestyle. Briarstone Realty, Inc. is a full service real estate company. We are able to find you a house or lot as a Buyer's Agent or sell your current home as a Seller's Agent.
    </div>
</div>







<?php include("head.php"); ?>
<div class='underNavElse clearfix hidden-lg hidden-md hidden-sm'>
    <br /><br />
</div>

<div class='container'>
    <div class="row">
        <div class="col-lg-12">
            <h1>Contact Us</h1>
            We will be glad to meet with you to discuss building
            options and advantages. From design to finished product,
            you will have the peace of mind knowing your new home or
            remodel project will be completed to your satisfaction.
            <br /> Give us a call or email today!
        </div>
    </div>
</div>

<?php
if (isset($_POST['send'])) {

// Some data for the message
    $mailTo = "drew@briarstonebuilding.com";
    $mailFrom = $_POST['email'];
    $mailFromName = $_POST['name'];
    $mailSubject = "IMDOrtho.com Contact Page";

    $mailMessage = $_POST['name'] . "\n";
    $mailMessage .= $_POST['email'] . "\n";
    $mailMessage .= $_POST['address'] . "\n";
    $mailMessage .= $_POST['citystate'] . "\n";
    $mailMessage .= $_POST['zip'] . "\n\n";
    if (!empty($_POST['brochure']) == "YES") {
        $mailMessage .= "SEND ME A BROCHURE!\n\n";
    }
    $mailMessage .= $_POST['message'];

// Send mail
    mail($mailTo, $mailSubject, $mailMessage, "From: $mailFromName <$mailFrom>\r\n");
//mail("cbake@livemercial.com, sjgraphics@kconline.com", $mailSubject, $mailMessage, "From: $mailFromName <$mailFrom>\r\n") or die("couldn't mail");

    echo "<br /><br /><b>Thanks for contacting us. We'll get in touch with you as soon as possible.</b>";
} else {
    ?>
<br />



<script type='text/javascript'>
    function validate()
    {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var city = document.getElementById('city').value;
        var zip = document.getElementById('zip').value;
        var address = document.getElementById('address').value;
        if (name == '' || name == "undefined") {
            alert("Please Enter Your Name.");
            return false;
        }
        if (email == '' || email == "undefined") {
            alert("Please Enter Your Email.");
            return false;
        }
        if (city == '' || city == "undefined") {
            alert("Please Enter Your City.");
            return false;
        }
        if (zip == '' || zip == "undefined") {
            alert("Please Enter Your ZipCode.");
            return false;
        }
        if (address == '' || address == "undefined") {
            alert("Please Enter Your Address.");
            return false;
        }
    }
</script>

<div class='container'>
    <div class='row'>
        <div class='col-lg-6 col-md-6 address'>
            <h3>Briarstone Building, Inc.</h3>
            <p>46709 Merion Circle
                <br /> Northville, Michigan 48167
                <br /> Phone: 248.535.3838
            </p>
        </div>


        <div class='col-lg-6 col-md-6'>
            <form action="contact.php" method='POST' class='form'>
                <fieldset>
                    <legend>Email Us For More Information</legend>

                    <div class="form-group">
                        <label>Name</label>
                        <input name='name' type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>@Email</label>
                        <input name='email' type="text" class="form-control" placeholder="address@domain.com">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Address</label>
                        <input name='address' type="text" class="form-control" placeholder="Your Address">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>City, State</label>
                        <input name='citystate' type="text" class="form-control" placeholder="City, State">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Zipcode</label>
                        <input name='zip' type="text" class="form-control" placeholder="xxxxx">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class='form-control' name='message' rows='15' cols='40'>

                        </textarea>
                    </div>
                    <div class='col-sm-6'>
                        <button name='send' type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>


