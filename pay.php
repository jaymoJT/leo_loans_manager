<?php 
include 'partials/head.php';
if (!isset($_SESSION['s_email'])) {
  echo "<script>location.href='login.php'</script>";
} 
?>



<?php 
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
	                <section class="content-header">
                    <h1> Record payment</h1>
                        <ol class="breadcrumb">
                          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                          <li><a href="#">Forms</a></li>
                          <li class="active">General Elements</li>
                        </ol>
                  </section>
	                <div class="content">
		                <section class="content">
                        <div class="row">
                               <!-- left column -->

                            <div class="col-md-12">
                              <!-- general form elements -->
                              <div class="box box-primary">
           
                            <?php

                                if(isset($_POST['submit'])) {
                                    include 'partials/connection.php';
    
                                    $id = mysqli_real_escape_string($conn, $_POST['id']);
                                    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
                                    $pay_date = mysqli_real_escape_string($conn, $_POST['pay_date']);
                                    $message = '';
    
                                      //checking for any submitted empty field
                                     if (empty($id)||
                                        empty($amount)||
                                        empty($pay_date)
                                          )
                                        {
                                            $message ='You have submitted an empty field!';    
                                        } 
                                        else {
              
                                            $sql="INSERT INTO payments (nat_id, amount, pay_date) VALUES ('$id', '$amount', '$pay_date') ";
                                            if(mysqli_query($conn, $sql)) {
                                                  $message = 'Payment records entered successfully';
                                                } 
                                              else {
                                                   echo "Error:" . $sql . "<br>". mysqli_error($conn) ;
                                                   }
                
                                                   }
                                                  mysqli_close($conn);
                
                                                   } 
                            ?>

                              <form  method="POST">
                                <?php if (!empty($message)): ?>        
                                  <div class="callout callout-success">
                                      <h4>Alert!</h4>
                                      <p><?php echo $message ?> .</p>
                                  </div>       
                                <?php endif ;?>                                
                                <div class="form-group">
                                    <label for="ID">National ID</label>
                                    <input type="number" class="form-control" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Amount</label>
                                    <input type="number" class="form-control" name="amount">
                                </div>
                                <div class="form-group" id='datetimepicker2'>
                                        <label>Date </label>
                                        <input name="pay_date" type="date" class="form-control">
                                </div>                                  
                                <div class="form-group tm-yellow-gradient-bg text-center">
                                    <button type="submit" name="submit" value="send" class="btn btn-primary">Submit </button>
                                </div>                                  
                              </form>
            
                     </div>
          <!-- /.box -->
	                </div>
                </div>
            </div>
       <?php }?>

 <?php 
include 'partials/scripts.php';
  ?>           
 
 