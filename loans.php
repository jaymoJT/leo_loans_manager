<?php 
include 'partials/head.php';
if (!isset($_SESSION['s_email'])) {
  echo "<script>location.href='login.php'</script>";
} 

include 'partials/connection.php';
   
   //generating session details to be used in the rest of the page
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
	                

	                <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">All dirbursed loans</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>National ID</th>
                                                    <th>Amount given</th>
                                                    <th>Disbursement date</th>
                                                    <th>Due date</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                	                    <?php
        				             
        				                    //Collecting all clients' details from the clients' table
        				                    $sql = "SELECT * FROM disbursements ORDER BY dis_no DESC";
        				                    $client = mysqli_query($conn, $sql) or die(mysqli_connect_error());
        				
        				                    while ($row = mysqli_fetch_array($client, MYSQLI_ASSOC)) {
        					                //fetch based on id
 				                            $id = $row['nat_id'];
                                        ?>
                
                                        <tr>
                                            <td><a href="accounts.php<?php echo '?id='.$row['nat_id']; ?>"><?php echo $row['nat_id'];?></a></td>
                                            <td><?php echo $row['amount'];?></td>
                                            <td><?php echo $row['dis_date'];?></td>
                                            <td><?php echo $row['due_date'];?></td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                        </table>
                                    </div>
                                <!-- /.box-body -->
                                </div>
                               <!-- /.box -->
                            </div>
                        </div>



<?php }?>
<?php 
include 'partials/scripts.php';
include 'partials/footer.php'; 
?>