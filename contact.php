<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DevHelp: Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/sign-up-style.css">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>
<?php
$success = false;
$validation_message_field = "";
$validation_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 0;
//Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'devhelptest@gmail.com';
//Password to use for SMTP authentication
    $mail->Password = "KZQ4Klh6crEk";
//Set who the message is to be sent from
    try {
        $mail->setFrom('devhelptest@gmail.com', "$name");
    } catch (Exception $e) {
        die("The \"from\" address could not be determined.");
    }
//Set who the message is to be sent to
    $mail->addAddress('devhelptest@gmail.com');
//Set the subject line
    $mail->Subject = 'Contact Message';

    $mail->Body = "$message <br /> <br /> Phone Number: $phone_number <br />Email: $email";
//Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
//Attach an image file

    try {
        $mail->send();
        $success = true;
        $validation_message = "Message successfully sent!";
    } catch (Exception $e) {
        $success = false;
        $validation_message = "Message not sent. " . $mail->ErrorInfo;
    }
    $field_color = $success ? "green" : "red";
    $validation_message_field = "<h4 style=\"color: $field_color; text-align:center;\">$validation_message</h4>";
} ?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <img class="mb-4" src="DevHelplogo.png" alt="" width="200" height="35">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="work.php">Work</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign-up.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="log-in.php">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="member.php">Member</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Contact Us</h1>
                    <span class="subheading">Have questions? We have answers.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->

<form id="sign-up-form"
      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
      method="post">
    <h1>Contact Us</h1>
    <fieldset>
        <!--        <legend><span class="number">1</span>Please enter the following information.</legend>-->
        <label for="name">Name</label>
        <input id="name" type="text"
               name="name" pattern="^[a-zA-Z-][a-zA-Z -]*$"
               oninvalid="setCustomValidity('Please enter only letters')"
               onchange="try{setCustomValidity('')}catch(e){}"
               required>


        <label for="email">Email Address</label>
        <input type="email" class="form-control"
               name="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"
               oninvalid="setCustomValidity('Please enter a valid email address.')"
               onchange="try{setCustomValidity('')}catch(e){}"
               id="email" required>


        <label for="phone_number">Phone Number</label>
        <input type="tel" id="phone_number"
               pattern="^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$"
               oninvalid="setCustomValidity('Please enter a valid phone number.')"
               onchange="try{setCustomValidity('')}catch(e){}"
               name="phone_number"
               required
        >

        <label for="message">Message</label>
        <textarea rows="5" id="message"
                  name="message"
                  required></textarea>


        <button type="submit">Send</button>

    </fieldset>
    <?php echo $validation_message_field; ?>
</form>


<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright &copy; DevHelp 2018</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>

</body>

</html>
