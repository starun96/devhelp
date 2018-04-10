

<?php

session_start();
if (isset($_SESSION['user'])){
  $user = $_SESSION['user'];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bowensDB2";

  $conn = new mysqli($servername, $username, $password);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $conn = new mysqli($servername, $username, $password, $dbname);
  $result = $conn->query("SELECT username FROM DevhelpUsers WHERE id='$user'");

  if ($result->num_rows > 0)
  {
      $row = $result->fetch_assoc();
      $user_name = $row['username'];
  }
}else{
  header('Location: log-in.php');
}




// header('Location: member.php');

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
$posttitlearray = array();
$postsubtitlearray = array();
$postidarray = array();
$sql = "SELECT title, subtitle, id FROM DevhelpPosts WHERE uid = '$user'";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $title = $row["title"];
        $subtitle = $row["subtitle"];
        $id = $row["id"];
        array_push($posttitlearray, $title);
        array_push($postsubtitlearray, $subtitle);
        array_push($postidarray, $id);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DevHelp: Help for Developers</title>

    <!--page specific -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/sign-up-style.css">
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>This is DevHelp!</h1>
                    <span class="subheading">Want your game-changing app idea to become a reality? Or do you just need coding help? Browse through thousands of student developers to find the perfect match for your development needs.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <?php

        echo "<h1 style='text-align:center; color: gray'>$user_name</h1>";

    ?>

    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div style='text-align:center; '>My Posts</div>

       <?php foreach($postidarray as $key => $value){ ?>
         <div class="post-preview" action="<?php $_SESSION['postid'] = $value; ?>">
             <a href="post.php?key=<?php echo $value?>" method="post">
               <h2 class="post-title">
                 <?php
                    print $posttitlearray[$key];
                  ?>
               </h2>
               <h3 class="post-subtitle">
                 <?php
                    print $postsubtitlearray[$key];
                    print $user_name;
                  ?>
               </h3>
             </a>

                 <?php
                    echo "<p class='post-meta'>Posted by
                        <a >
                          $user_name
                        </a>
                        </p>";
                 ?>

         </div>
         <hr>


    <?php } ?>





        </div>
    </div>

    <form action="log-out.php" style="text-align:center">
      <button type="submit" class="btn btn-primary" id="sendMessageButton" >Log Out!</button>
    </form>
</div>







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

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>

</body>

</html>
