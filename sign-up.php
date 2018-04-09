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

    <title>DevHelp: Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--page specific -->
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

<!-- Some JavaScript Form Handling -->
<script type="text/javascript">
    window.onload = function () {
        var form = document.getElementById('sign_up_form');
        form.button.onclick = function () {
            for (var i = 0; i < form.elements.length; i++) {
                if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
                    alert('There are some required fields!');
                    return false;
                }
            }
            form.submit();
        };
    };
</script>
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
            </ul>
        </div>
    </div>
</nav>


<!-- Page Header -->
<header class="masthead" style="background-image: url('img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Join DevHelp</h1>
                </div>
            </div>
        </div>

    </div>
</header>


<?php
$name = $email = $userpassword = $address = $city = $state = $zip = "";
$success = false;
$validation_message_field = "";
$validation_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["user_name"];
    $email = $_POST["user_email"];
    $userpassword = $_POST["user_password"];
    $address = $_POST["address"];
    $city = $_POST["user_city"];
    $state = $_POST["state"];
    $zip = $_POST["user_zip"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bowensDB2";

// Create connection
    $conn = new mysqli($servername, $username, $password);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// "Connected successfully";

//Create database, only need to be done once.
    $sql = "CREATE DATABASE bowensDB2";
    if ($conn->query($sql) === TRUE) {
        //echo "Database created successfully";
    } else {
        // echo "Error creating database: " . $conn->error;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

// sql to create table
    $sql = "CREATE TABLE DevhelpUsers (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL,
        address VARCHAR(100) NOT NULL,
        city VARCHAR(50) NOT NULL,
        state VARCHAR(50) NOT NULL,
        zipcode VARCHAR(50) NOT NULL
        )";

    if ($conn->query($sql) === TRUE) {
        // echo "Table MyGuests created successfully";
    } else {
        // echo "Error creating table: " . $conn->error;
    }

//insert into table.

    //First, fetch to see if email already exist in bowensDB.

    $emails_result = $conn->query("SELECT email FROM DevhelpUsers WHERE email='$email'");
    if ($emails_result->num_rows != 0) {
        /*echo '<div style="text-align:center;">Email already exists!<div>';*/
        $success = false;
        $validation_message = "Email already exists!";
    } else {
        $success = true;
        $validation_message = "Successfully signed up!";
        $hashed_pw = password_hash($userpassword, PASSWORD_DEFAULT);
        $sql = "INSERT INTO DevhelpUsers (username, email, password, address, city, state, zipcode)
            VALUES ('$name', '$email', '$hashed_pw', '$address', '$city', '$state', '$zip')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // send email

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
            $mail->setFrom('devhelptest@gmail.com', "DevHelp");
        } catch (Exception $e) {
            die("The \"from\" address could not be determined.");
        }
//Set who the message is to be sent to
        $mail->addAddress($email);
//Set the subject line
        $mail->Subject = 'DevHelp Account Successfully Created!';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
        $mail->Body = "Welcome to DevHelp!";
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';


        try {
            $mail->send();
            session_start();
            $_SESSION['user'] = $conn->insert_id;
            header('Location: member.php');
        } catch (Exception $e) {
            $success = false;
            $validation_message = $validation_message . " However, the confirmation email could not be sent.";
        }

    }
    $field_color = $success ? "green" : "red";
    $validation_message_field = "<h4 style=\"color: $field_color; text-align:center;\">$validation_message</h4>";


}


?>

<form id="sign-up-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
      method="post">

    <h1>Sign Up</h1>

    <fieldset>
        <!--<legend><span class="number">1</span> Enter the following information</legend>-->
        <label for="name">Name:</label>
        <input type="text" id="name" name="user_name" pattern="^[a-zA-Z-][a-zA-Z -]*$"
               oninvalid="setCustomValidity('Letters only please')"
               onchange="try{setCustomValidity('')}catch(e){}" required/>

        <label for="mail">Email:</label>
        <input type="text" id="mail" name="user_email"
               pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"
               oninvalid="setCustomValidity('Enter a Valid Email')"
               onchange="try{setCustomValidity('')}catch(e){}" required>

        <label for="password">Password:</label>
        <input type="password" pattern="^.{8,}$" id="password"
               oninvalid="setCustomValidity('The password must be at least 8 characters long.')"
               onchange="try{setCustomValidity('')}catch(e){}" name="user_password" required>

        <label for="password">Confirm Password:</label>
        <input type="password" id="confirm_password" onChange="return Validate()" required>

        <script type="text/javascript">
            function Validate() {
                var password = document.getElementById("password").value;
                var confirmPassword = document.getElementById("confirm_password").value;
                if (password != confirmPassword) {
                    alert("Passwords do not match.");
                    return false;
                }
                return true;
            }
        </script>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" pattern="^[#.0-9a-zA-Z\s,-]+$"
               oninvalid="setCustomValidity('Letters and numbers only please')"
               onchange="try{setCustomValidity('')}catch(e){}" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="user_city" pattern="^[a-zA-Z-][a-zA-Z -]*$"
               oninvalid="setCustomValidity('Letters only please')"
               onchange="try{setCustomValidity('')}catch(e){}" required>

        <label for="state">State:</label>
        <select name="state" id="state" required>
            <option value="" selected="selected">Select a state:</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>


        <label for="zip">Zip Code:</label>
        <input type="text" id="zip" name="user_zip" pattern="^[0-9]{5}$" title="Five numbers only"
               required>
        <button type="submit">Sign Up</button>
        <!-- <label>Age:</label>
        <input type="radio" id="under_13" value="under_13" name="user_age"><label for="under_13" class="light">Under 13</label><br>
        <input type="radio" id="over_13" value="over_13" name="user_age"><label for="over_13" class="light">13 or older</label> -->
    </fieldset>

    <!-- <fieldset>
      <legend><span class="number">2</span>Your profile</legend>
      <label for="bio">Biography:</label>
      <textarea id="bio" name="user_bio"></textarea>
    </fieldset>
    <fieldset>
    <label for="job">Job Role:</label>
    <select id="job" name="user_job">
      <optgroup label="Web">
        <option value="frontend_developer">Front-End Developer</option>
        <option value="php_developor">PHP Developer</option>
        <option value="python_developer">Python Developer</option>
        <option value="rails_developer"> Rails Developer</option>
        <option value="web_designer">Web Designer</option>
        <option value="WordPress_developer">WordPress Developer</option>
      </optgroup>
      <optgroup label="Mobile">
        <option value="Android_developer">Androild Developer</option>
        <option value="iOS_developer">iOS Developer</option>
        <option value="mobile_designer">Mobile Designer</option>
      </optgroup>
      <optgroup label="Business">
        <option value="business_owner">Business Owner</option>
        <option value="freelancer">Freelancer</option>
      </optgroup>
      <optgroup label="Other">
        <option value="secretary">Secretary</option>
        <option value="maintenance">Maintenance</option>
      </optgroup>
    </select>

      <label>Interests:</label>
      <input type="checkbox" id="development" value="interest_development" name="user_interest"><label class="light" for="development">Development</label><br>
        <input type="checkbox" id="design" value="interest_design" name="user_interest"><label class="light" for="design">Design</label><br>
      <input type="checkbox" id="business" value="interest_business" name="user_interest"><label class="light" for="business">Business</label>

    </fieldset> -->
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

</body>

</html>
