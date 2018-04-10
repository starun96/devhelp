<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// header('Location: member.php');
//$_SESSION['count'] = 100;
// $count = $_SESSION['postid'];
// echo $count;
$postid = $_GET['key'];

$title = $subtitle = $price = $maincontent = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bowensDB2";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// "Connected successfully";

$sql = "SELECT title, subtitle, price, content FROM DevhelpPosts WHERE id = '$postid'";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $title = $row["title"];
        $subtitle = $row["subtitle"];
        $price = $row["price"];
        $content = $row["content"];
    }
}

?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DevHelp: Post</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Javascript -->
    <script type="text/javascript" src="/js/script.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>






    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <img class="mb-4" src="DevHelplogo.png" alt="" width="200" height="35">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
    <header class="masthead" style="background-image: url('img/post-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1>
                <?php
                  print $title
                 ?>
              </h1>
              <h2 class="subheading">
                <?php
                  print $subtitle
                 ?>
              </h2>

            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <?php
              print $content;
              print $price;
             ?>
          </div>
        </div>
      </div>
    </article>
<hr>

    <?php
    if ($price == 1){
      echo '<div style="text-align:center"><form action="https://test.bitpay.com/checkout" method="post" >
  <input type="hidden" name="action" value="checkout" />
  <input type="hidden" name="posData" value="" />
  <input type="hidden" name="data" value="7/f26+/YTFW63Wx80y4/F8QSOpxlYNCQpHVS8p64ZBO0ll3Ev+LJWl/Akh7qOvLPm7c4zskJ/ep7zGB+anWl1OFQ+wViMermY3FkNtpbIUjcofdPAL1J5KkjKL7k1OQrbs+5zO5w3xOuIeaLXZl5Jz+oGCDU8fBZCo96dRX+ue15yvLb86naPFKY1WnNgqkC" />
  <input type="image" src="https://test.bitpay.com/img/button-large.png" border="0" name="submit" alt="BitPay, the easy way to pay with bitcoins." >
</form></div>';
}else if($price == 2){
  echo '<div style="text-align:center">
  <form action="https://test.bitpay.com/checkout" method="post" >
<input type="hidden" name="action" value="checkout" />
<input type="hidden" name="posData" value="" />
<input type="hidden" name="data" value="7/f26+/YTFW63Wx80y4/F8QSOpxlYNCQpHVS8p64ZBO0ll3Ev+LJWl/Akh7qOvLPqsuZxMoP7ZwVW3pYUDDalAczKZDJSUTA4bylyxwy5hHJyZhOkUUKpzzdJhbTqghhHxzOXd9igMDdbKAhBmbn9cXHtI3wiEOq0oGuyfseONWdW1dArEr12ANPnTUx7c/h" />
<input type="image" src="https://test.bitpay.com/img/button-large.png" border="0" name="submit" alt="BitPay, the easy way to pay with bitcoins." >
</form>
  </div>';
}else {
  echo '<div style="text-align:center">
  <form action="https://test.bitpay.com/checkout" method="post" >
  <input type="hidden" name="action" value="checkout" />
  <input type="hidden" name="posData" value="" />
  <input type="hidden" name="data" value="7/f26+/YTFW63Wx80y4/F8QSOpxlYNCQpHVS8p64ZBO0ll3Ev+LJWl/Akh7qOvLPQyCIN7hRrpZLe3WjTF8eLa+vxG4CGAVY/WN+rMw1Mmf1MOpN6ezzk/bA8ntHKcj8IbFD09AC3NrxTMwfL5Ahdwag+LO4dBCho5HvwgJNG0WF4R0+RXPwwhCYOzq7dciZ" />
  <input type="image" src="https://test.bitpay.com/img/button-large.png" border="0" name="submit" alt="BitPay, the easy way to pay with bitcoins." >
</form>
  </div>';
}
     ?>

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
            <p class="copyright text-muted">Copyright &copy; Your Website 2018</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>
