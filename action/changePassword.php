 <?php 
if (isset($_POST['change'])) {
  $currentPassword=mysqli_real_escape_string($con,$_POST['currentPassword']);
  $newPassword=mysqli_real_escape_string($con,$_POST['newPassword']);
  $confPassword=mysqli_real_escape_string($con,$_POST['confPassword']);
  $newHashedPassword=password_hash($newPassword, PASSWORD_DEFAULT);
  $username=$_SESSION['username'];
  // if ($_SESSION['userType']=='Trainer') {
    if ($getUser=$con->query("SELECT * FROM users where userId='".$_SESSION['userId']."' ")->fetch_object()) {  
        if (password_verify($currentPassword, $getUser->password)) {
          if ($newPassword==$confPassword) {
            if ($con->query("UPDATE users set password='$newHashedPassword' where username='$username'")) {
              echo "<script>alert('Password changed successfully')</script>";
              echo "<script>window.location.href='dashboard.php?out=1'</script>";
            }
          }
        }else{
          echo "<script>alert('Wrong current password')</script>";
        }
    }
  // }
}
  ?>
 <div class="card">
            <div class="card-header text-center">
             CHANGE PASSWORD
            </div>
            <!--Card content-->
            <form method="post" action="#">
              <div class="card-body">
              <label for="password"> Current Password</label>
            <input type="text" id="password" class="form-control" name="currentPassword" required>
            <label>New password</label>
            <input type="password" class="form-control" name="newPassword">
            <label>Confirm password</label>
            <input type="password" class="form-control" name="confPassword">

            <input type="submit" value="Change Password" class="btn btn-success" name="change">
            </div>
            </form>

          </div>