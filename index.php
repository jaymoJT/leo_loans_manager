<?php
include 'partials/head.php';
if (!isset($_SESSION['s_email'])) {
  echo "<script>location.href='login.php'</script>";
} 
//This is to get session details and use them in the rest of the index page
   include 'partials/connection.php';
   $user = $_SESSION['s_email'];

   $get_user = "SELECT * FROM  users WHERE email='$user' ";
   $right_user = mysqli_query($conn,$get_user) or die (mysqli_connect_error());
        while ($row = mysqli_fetch_array($right_user, MYSQLI_ASSOC)) {


            
            include 'partials/header.php';
            include 'partials/sidebar.php';
        ?>
         
         <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">
                <div class="content-wrapper">
	                <?php include 'partials/breadcrumb.php';?>
	                <div class="content">
		                <?php  include 'partials/new.php'; ?>
	                </div>
                </div>
            </div>
       <?php }?>
 

<?php 
include 'partials/scripts.php';
include 'partials/footer.php'; ?>