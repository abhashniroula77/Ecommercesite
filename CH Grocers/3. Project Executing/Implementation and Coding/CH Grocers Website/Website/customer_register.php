<?php 
    
    $active='Account';
    include("includes/header.php");

?>
   
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Register
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
   
   <?php 
    
    include("includes/sidebar.php");
    
    ?>
               
           </div><!-- col-md-3 Finish -->
           
           <div class="col-md-9"><!-- col-md-9 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <div class="box-header"><!-- box-header Begin -->
                       
                       <center><!-- center Begin -->
                           
                           <h2> Register as a Customer</h2>
                           
                       </center><!-- center Finish -->
                       
                       <form action="customer_register.php" method="post" enctype="multipart/form-data"><!-- form Begin -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Name</label>
                               
                               <input type="text" class="form-control" name="c_name" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Email</label>
                               
                               <input type="text" class="form-control" name="c_email" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Password</label>
                               
                               <input type="password" class="form-control" name="c_pass" required>
                               
                           </div><!-- form-group Finish -->
                           
                         
                           
                           
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Mobile No.</label>
                               
                               <input type="text" class="form-control" name="c_number" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Address</label>
                               
                               <input type="text" class="form-control" name="c_address" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Profile Picture</label>
                               
                               <input type="file" class="form-control form-height-custom" name="c_image" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="text-center"><!-- text-center Begin -->
                               
                               <button type="submit" name="register" class="btn btn-primary">
                               
                               <i class="fa fa-user-md"></i> Register
                               
                               </button>
                               
                           </div><!-- text-center Finish -->
                           
                       </form><!-- form Finish -->
                       
                   </div><!-- box-header Finish -->
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-9 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    
    
</body>
</html>


<?php 




if(isset($_POST['register'])){
    
    $c_name = $_POST['c_name'];
    
    $c_email = $_POST['c_email'];
    
    $c_pass = $_POST['c_pass'];
    
    $c_number = $_POST['c_number'];
    
    $c_address = $_POST['c_address'];
    
    $c_image = $_FILES['c_image']['name'];
    
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    $c_ip = getRealIpUser();
    
    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
    
    $insert_customer = "insert into customer (CUSTOMER_NAME,CUSTOMER_EMAIL,CUSTOMER_PASSWORD,CUSTOMER_NUMBER,CUSTOMER_ADDRESS,CUSTOMER_IMAGE,CUSTOMER_IP) values ('$c_name','$c_email','$c_pass','$c_number','$c_address','$c_image','$c_ip')";
    
    $run_customer = oci_parse($con,$insert_customer);

    $g = oci_execute($run_customer);

    if($g)
    {
      $to  = $c_email;
      $subject = "Confirmation";
      $message = 'Thank You 


      <a href="http://localhost/mainproject/verify.php?key=$to"></a>
        ';

        $head='from: chgrocers123@gmail.com';
        $z=mail($to,$subject,$message,$head);



    }
    
    $sel_cart = "select * from cart where IP_ADD='$c_ip'";
    
    $run_cart = oci_parse($con,$sel_cart);

    oci_execute($run_cart);
    
    $check_cart = oci_fetch($run_cart);
    
    if($check_cart>0){
        
        /// If register have items in cart ///
        
        $_SESSION['CUSTOMER_EMAIL']=$c_email;
        
        echo "<script>alert('Please check your email and open the verification link.')</script>";
        
        echo "<script>window.open('checkout.php','_self')</script>";
        
    }else{
        
        /// If register without items in cart ///
        
        $_SESSION['CUSTOMER_EMAIL']=$c_email;
        
        echo "<script>alert('Please check your email and open the verification link..')</script>";
        
        echo "<script>window.open('index.php','_self')</script>";
        
    }
    
}

?>