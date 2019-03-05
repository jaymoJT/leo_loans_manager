<?php 
include 'partials/head.php';

?>

<body class="hold-transition login-page" style="height: 100%; margin-bottom: -5px;background-color: #000; ">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>My</b>manager</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to proceed</p>
    <?php
if (isset($_POST['submit'])) {
  include 'partials/connection.php';

  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $pwd   = mysqli_real_escape_string($conn,$_POST['password']);
  $message = '';

  //Error handlers
  //Check for empty fields
  if (empty($email) || empty($pwd)) {

    $message = 'You have submitted an empty field!';

  }else{
    $sql = "SELECT * FROM users WHERE email ='$email' ";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
      
                $message = 'The email address is not registered!';

    } else{
      if ($row = mysqli_fetch_assoc($result)) {

        //dehashing the password
        $hashedpwdCheck = password_verify($pwd,$row['password']);

        //declaring the entered password to be false
        if ($hashedpwdCheck == false) {
          $message = 'You have entered a wrong password!';

        //if the entered password is true         
        }elseif ($hashedpwdCheck == true ) {
          //Logging the user here 
          $_SESSION['s_email'] = $row['email'];
          $_SESSION['s_pwd']   = $row['password'];
          $id = $row['u_id'];
          $name = $row['f_name'];

          echo "<script>
                          location.href='index.php?server=$id'
                </script>";
          
        }
        
      }
    }
  }
  
}

?>
    <form  method="post">
      <?php if (!empty($message)): ?>
        
        <div class="callout callout-success">
                <h4>Alert!</h4>
                <p><?php echo $message ?> .</p>
        </div>
        
      <?php endif ;?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">I forgot my password</a><br>
    <a href="register.php" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>

<?php 
include 'partials/scripts.php';
?>