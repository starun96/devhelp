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
                    <h1>Tell us what you can do!</h1>
                </div>
            </div>
        </div>
    </div>
</header>


<body>
<?php
session_start();
if (isset($_SESSION['user'])){
  $user = $_SESSION['user'];
}


$title = $subtitle = $price = $maincontent = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["post_title"];
    $subtitle = $_POST["post_subtitle"];
    $price = $_POST["post_price"];
    $maincontent = $_POST["user_content"];
}

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
$sql = "CREATE DATABASE bowensDB";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    // echo "Error creating database: " . $conn->error;
}

$conn = new mysqli($servername, $username, $password, $dbname);

// sql to create table
$sql = "CREATE TABLE DevhelpPosts (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(3000) NOT NULL,
        subtitle VARCHAR(30000) NOT NULL,
        price VARCHAR(1000) NOT NULL,
        content VARCHAR(10000) NOT NULL,
        uid INT(6) NOT NULL
        )";

if ($conn->query($sql) === TRUE) {
    //echo "Table MyGuests created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}


//insert into table.
if ($title != "") {
    $sql = "INSERT INTO DevhelpPosts (title, subtitle, price, content, uid)
          VALUES ('$title', '$subtitle', '$price', '$maincontent', '$user')";

    if ($conn->query($sql) === TRUE) {
        //echo "New Post created successfully";
        //redirect to work.php.
        echo '<meta http-equiv="refresh"
             content="0; url=work.php">';
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>

<form id="post-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
      href="index.php">

    <h1>New Post</h1>

    <fieldset>
        <legend><span class="number">1</span>Basic Info</legend>
        <label for="name">Post Title:</label>
        <input type="text" id="name" name="post_title"/>

        <label>Subtitle:</label>
        <input type="text" name="post_subtitle">

        <label for="mail">Price Tier:</label>
        <!-- <input type="text" id="mail" name="post_price" pattern="^[0-9]*$"
               oninvalid="setCustomValidity('Enter a Valid Number')"
               onchange="try{setCustomValidity('')}catch(e){}" required> -->
               <select name="post_price" id="price" required>
                   <option value="" selected="selected">Select BitCoin PriceTier:</option>
                   <option value=1>1 BitCoin</option>
                   <option value=2>2 BitCoin</option>
                   <option value=3>3 BitCoin</option>
               </select>

        <legend><span class="number">2</span>Main Content</legend>
        <label for="bio">Description of Service you could provide:</label>
        <textarea id="bio" name="user_content" rows="20"></textarea>
        <button type="submit">Create Post</button>
    </fieldset>

</form>

</body>
</html>

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
