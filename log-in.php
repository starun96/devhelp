<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DevHelp: Log in</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--page specific-->
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
$display_error = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bowensDB2";

    $conn = new mysqli($servername, $username, $password);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $conn = new mysqli($servername, $username, $password, $dbname);

    $hashed_pw = hash('sha256', $user_password);

    $sql = "SELECT id FROM DevhelpUsers WHERE email='$user_email' AND password='$hashed_pw'";
    $matched_credentials = $conn->query($sql);
    if ($matched_credentials->num_rows == 1) {
        $_SESSION['user'] = $matched_credentials->fetch_assoc()['id'];
        header("Location: member.php");
    } else {
        $display_error = true;
    }
}
?>

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
                    <a class="nav-link" href="member.php">Member</a>
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
                    <h1>Log In to DevHelp</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <h1>Log In</h1>

    <fieldset>
        <!--<legend><span class="number">1</span> Enter Login Information</legend>-->
        <?php
        if ($display_error)
            echo "<div style=\"color:red;\">Invalid email or password.</div>";

        ?>
        <label for="mail">Email:</label>
        <input type="email" id="mail" name="user_email">

        <label for="password">Password:</label>
        <input type="password" id="password" name="user_password">

        <input type="checkbox" id="development" value="remember-me" name="user_interest"><label
                class="light" for="development">Remember me</label>

        <br><br>
        <button type="submit">Log In</button>
    </fieldset>

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
