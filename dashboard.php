<?php 
include 'connection.php';

session_start();
if (isset($_SESSION['username'])) {
  //loging out
if (isset($_GET['out'])) {
  session_destroy();
  header("Location:index.php");
}

//importing event

if (isset($_POST['send'])) {

    $name=$_POST['name'];
    $time=$_POST['time'];
    $location=$_POST['location'];
    $tickets=$_POST['tickets'];


    $send=mysqli_query($con,"insert into `events` values('','$name','$time','$location','$tickets')");

    if ($send == true) {
       
       ?>
           <script type="text/javascript">
             alert('Event Recorded');
           </script>
       <?php
    }else{

      ?>
          <script type="text/javascript">
             alert('Not Recorded');
           </script>
      <?php
    }
}




 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>EMS :: Event Management System</title>
  <!-- Font Awesome -->
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="#"><strong class="blue-text">EMS----<?php echo $_SESSION['userType'];?> PANEL</strong>
        </a>


       

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link waves-effect" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="#" class="nav-link waves-effect">
                <?php echo strtoupper($_SESSION['username']); ?>
              </a>
            </li>
            <li class="nav-item">
              <a href="dashboard.php?out=1" class="btn-danger nav-link border border-light rounded waves-effect color-white">
                Log out
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

      <a class="logo-wrapper waves-effect">
        <img src="img/logo.png" class="img-fluid" alt="">
      </a>

      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item active waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="?page=action/changePassword" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-money-bill-alt mr-3"></i>Change pasword</a>
      </div>

    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

<!-- panel for trainer -->
<?php  
if ($_SESSION['userType'] == 'Admin') {
  ?>
        <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
 
     
          <form class="d-flex justify-content-center" action="" method="post" enctype="multipart/form-data">
          
            <input type="text" class="form-control file w-100" name="name" placeholder="Please Enter Event Name"required>
            <input type="datetime-local" class="form-control file w-100" name="time" placeholder="Please Event Time"required>
            <input type="text" class="form-control file w-100" name="location" placeholder="Please Event Location"required>
            <input style="width:20rem;" type="text" class="form-control file" name="tickets" placeholder="No Of Available Tickets"required>
            <button class="btn btn-primary btn-sm my-0 p" type="submit" name="send">
              <i class="fas fa-upload"></i>
            </button>

          </form>
      
          <?php 
         }

         ?>
        </div>

      </div>


      <!-- main panel -->
      <?php 
      if(isset($_GET['page'])){
        include $_GET['page'].'.php';
      }else{
include 'action/uploadedAttendance.php';
        // echo "no thing to view";
      }
       ?>
      <!-- end of main panel -->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <!-- <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">
    <div class="footer-copyright py-3">
 2021 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
    </div>
  </footer> -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>
<?php 
} else{
  header("Location:index.php");
}
?>