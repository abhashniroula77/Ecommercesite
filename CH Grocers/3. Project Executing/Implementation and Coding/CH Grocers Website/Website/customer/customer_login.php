<div class="box"><!-- box Begin -->
    
  <div class="box-header"><!-- box-header Begin -->
      
      <center><!-- center Begin -->
          
          <h1> Customer Login </h1>
          
          <p class="lead"> Register with us? </p>
          
          
          
      </center><!-- center Finish -->
      
  </div><!-- box-header Finish -->
   
  <form method="post" action="checkout.php"><!-- form Begin -->
      
      <div class="form-group"><!-- form-group Begin -->
          
          <label> Email </label>
          
          <input name="c_email" type="text" class="form-control" required>
          
      </div><!-- form-group Finish -->
      
       <div class="form-group"><!-- form-group Begin -->
          
          <label> Password </label>
          
          <input name="c_pass" type="password" class="form-control" required>
          
      </div><!-- form-group Finish -->
      
      <div class="text-center"><!-- text-center Begin -->
          
          <button name="login" value="Login" class="btn btn-primary">
              
              <i class="fa fa-sign-in"></i> Login
              
          </button>
          
      </div><!-- text-center Finish -->     
      
  </form><!-- form Finish -->
   
  <center><!-- center Begin -->
      
     <a href="customer_register.php">
         
         <h3> Don't have account? Register here as a Customer. </h3>
         
     </a> 
      
  </center><!-- center Finish -->
    
</div><!-- box Finish -->


<?php 

if(isset($_POST['login'])){
    
    $customer_email = $_POST['c_email'];
    
    $customer_pass = $_POST['c_pass'];
    
    $select_customer = "select * from customer where CUSTOMER_EMAIL='$customer_email' AND CUSTOMER_PASSWORD='$customer_pass'";
    
    $run_customer = oci_parse($con,$select_customer);

    oci_execute($run_customer);
    
    $get_ip = getRealIpUser();
    
    $check_customer = oci_fetch($run_customer);
    
    $select_cart = "select * from cart where IP_ADD='$get_ip'";
    
    $run_cart = oci_parse($con,$select_cart);

    oci_execute($run_cart);
    
    $check_cart = oci_fetch($run_cart);
    
    if($check_customer==0){
        
        echo "<script>alert('Your email or password is incorrect.')</script>";
        
        exit();
        
    }
    
    if($check_customer==1 AND $check_cart==0){
        
        $_SESSION['CUSTOMER_EMAIL']=$customer_email;
        
       echo "<script>alert('You have been logged in.')</script>";
        
       echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
        
    }else{
        
        $_SESSION['CUSTOMER_EMAIL']=$customer_email;
        
       echo "<script>alert('You have been logged in.')</script>";
        
       echo "<script>window.open('checkout.php','_self')</script>";
        
    }
    
}

?>