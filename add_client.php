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
	                <div class="content">
		                <section class="content">
      <div class="row">
        <!-- left column -->

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter clients' details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

<?php 
//this enters members data for registration into the system
 if (isset($_POST['submit']))
 {   include 'partials/connection.php';
    

    $id        = mysqli_real_escape_string($conn,$_POST['id']); 
    $name      = mysqli_real_escape_string($conn,$_POST['name']);
    $phone     = mysqli_real_escape_string($conn,$_POST['phone']);
    $email     = mysqli_real_escape_string($conn,$_POST['email']);
    $estate    = mysqli_real_escape_string($conn,$_POST['estate']);
    $spouse    = mysqli_real_escape_string($conn,$_POST['spouse']);
    $work      = mysqli_real_escape_string($conn,$_POST['work']);
    $occupation= mysqli_real_escape_string($conn,$_POST['occupation']);
    $message = '';
    
    //Error handlers
    //Check for empty fields..
    if (empty($id)|| 
        empty($name) ||
        empty($phone)|| 
        empty($email)|| 
        empty($spouse) ||
        empty($work) ||
        empty($estate)|| 
        empty($occupation) 
        ) 
    {
        
        $message = 'You have submitted an empty field!';
    }

    else {   
        
        $exist = "SELECT * FROM members WHERE nat_id = $id ";
        $result = mysqli_query($conn,$exist) or die (mysqli_connect_error());
        $results = mysqli_num_rows($result);
           if ($results < 1) 
           {
                $sql = "INSERT INTO members (nat_id, name, phone, email, estate, spouse, employer, occupation)
                 VALUES ('$id', '$name','$phone', '$email', '$estate', '$spouse', '$work','$occupation') ";
                        if (mysqli_query($conn,$sql)) 
                                {
                                   $message = 'Client added successfully!';
                                } 
                        else {
                             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                             }
              
           }  
           
           else {
              
                $message = 'The entered details are already in use by another client!';
               
                }
    }   
   
  } 
?>    
                          <form  method="POST">
                                <?php if (!empty($message)): ?>        
                                  <div class="callout callout-success">
                                      <h4>Alert!</h4>
                                      <p><?php echo $message ?> .</p>
                                  </div>       
                                <?php endif ;?>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ID">National ID</label>
                                    <input type="number" class="form-control" name="id" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" name="phone" required="required">
                                </div> 
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required="required">
                                </div>
                                
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estate">Residential estate</label>
                                    <input type="text" class="form-control" name="estate" required="required" >
                                </div>   
                                <div class="form-group">
                                    <label for="spouse">Spouse Name</label>
                                    <input type="text" class="form-control" name="spouse" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="work">Place of work</label>
                                    <input type="text" class="form-control" name="work" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" name="occupation" required="required">
                                </div>  
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
 
 