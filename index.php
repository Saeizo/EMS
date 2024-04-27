
<?php
session_start();
include 'connection.php'; 
if (isset($_POST['login'])) {
  $username=mysqli_real_escape_string($con,$_POST['username']);
  $password=mysqli_real_escape_string($con,$_POST['password']);
  if ($getUser=$con->query("SELECT * from users where username='$username'")->fetch_object()) {
    if (password_verify($password, $getUser->password)) {
    $_SESSION['userType']=$getUser->type;
    $_SESSION['username']=$getUser->username;
    $_SESSION['userId']=$getUser->userId;
    header("Location:dashboard.php");
    }else{
      echo "<script>alert('Wrong Password')</script>";
    }
  }else{
     echo "<script>alert('Wrong Username')</script>";
  }
} 
if (isset($_POST['create'])) {
  $regNo=mysqli_real_escape_string($con,strtoupper($_POST['regno']));
  $stPass=mysqli_real_escape_string($con,$_POST['studentPassword']);
  $stPass2=mysqli_real_escape_string($con,$_POST['studentPassword2']);
  $HashedStudentPassword=password_hash($stPass, PASSWORD_DEFAULT);
  if ($stPass==$stPass2) {
     if ($con->query("INSERT INTO users VALUES ('','$regNo','$HashedStudentPassword', 'Student')")) {
     echo "<script>
     alert('Account created successfully');
     document.location.href = '';
     </script>";
   }
 }else{
     echo "<script>alert('Password Not match')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>EMS :: Event management system</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>

<body class="grey lighten-3">
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-9 mb-4">

          <!--Card-->
          <div class="card">
            <div class="card-header  text-center bg-dark">
              <br>
             <h2 class="text-light p--3"><i><b>LOGIN   ----  EMS</b></i><hr></h2>
            </div>
            <!--Card content-->
            <form method="post" action="#">
              <div class="card-body">
              <label for="username"> Username</label>
            <input type="text" id="username" class="form-control" name="username" required>
            <label>Password</label>
            <input type="password" class="form-control" name="password" required>
            <input type="submit" value="Login" class="btn btn-primary" name="login">
            </form>
            <details>
              <summary>Create account as User</summary>
              <p>
                <form method="post" action="#">
              <div class="card-body">
                <div id="response"></div>
              <label for="username"> User Name</label>
            <input onkeyup="getNumber()" id="reg" type="text" id="username" class="form-control w-50" name="regno" required>
            <label>Password</label>
            <input type="password" class="form-control w-50" name="studentPassword" required>
            <label>Confirm Password</label>
            <input type="password" class="form-control w-50" name="studentPassword2" required>
            <input id="createAccount" type="submit" value="Create" class="btn btn-primary" name="create">
            </form>
              </p>
            </details>
            </div>

          </div>
          <!--/.Card-->

        </div>


    </div>
  </main>
</body>
</html>
<script type="text/javascript">
        function getNumber(){
    var link=new XMLHttpRequest;
    var regNo=document.getElementById('reg').value;
    link.open("POST","bomber.php");
        link.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        link.onreadystatechange=function () {
            if (link.readyState==4 && link.status==200) {
                document.getElementById('response').innerHTML=link.responseText;  
            }
        }
link.send("regNo="+regNo);
}
</script>