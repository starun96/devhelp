<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>Work</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

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
              <h1>Developer Pool</h1>
              <span class="subheading">Find the right person for the right job!</span>
            </div>
          </div>
        </div>
      </div>
    </header>


    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="clearfix">
                <a class="btn btn-primary " href="makepost.php">Post Yourself</a>
            </div>
          <div class="post-preview">
            <a href="bowenpost.php">

              <h2 class="post-title">
                Bowen Sun
              </h2>
              <h3 class="post-subtitle">
                I will build your iOS app for you.
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="#">Bowen</a>
              on March 17, 2018</p>
          </div>
              <hr>

          <div class="post-preview">
            <a href="tarunpost.php">

              <h2 class="post-title">
                Tarun - experienced Android Developer
              </h2>
              <h3 class="post-subtitle">
                Asking 1 bitcoin for each project, including one month support after launch.
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="#">Bowen</a>
              on March 17, 2018</p>
          </div>
              <hr>
          <?php
          $title = $subtitle = $price = $maincontent = "";
          $servername="localhost";
          $username="root";
          $password="";
          $dbname="bowensDB2";

          $conn=new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          // "Connected successfully";
          $sql = "SELECT title, subtitle, price, content FROM DevhelpPosts";
          $results = $conn->query($sql);
          if ($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              $title = $row["title"];
              $subtitle = $row["subtitle"];
              //echo "title:" .$row["title"]. "subtitle:" .$row["subtitle"]. "<br>";
              //echo ('<a href="user_account.php?id=' . $title . '">' . $subtitle . '</a>');
              echo '<div class="post-preview">
                <a href="post.php">

                  <h2 class="post-title">
                    '. $title .'
                  </h2>
                  <h3 class="post-subtitle">
                    '. $subtitle .'
                  </h3>
                </a>
                <p class="post-meta">Posted by
                  <a href="#">Bowen</a>
                  on March 17, 2018</p>
              </div>
                  <hr>';
            }
          }
          ?>







        </div>
      </div>
    </div>



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
