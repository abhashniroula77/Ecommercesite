<?php 

$customer_session = $_SESSION['CUSTOMER_EMAIL'];

$get_customer = "select * from customer where CUSTOMER_EMAIL='$customer_session'";

$run_customer = oci_parse($con,$get_customer);

oci_execute($run_customer);

$row_customer = oci_fetch_array($run_customer);

$customer_id = $row_customer['CUSTOMER_ID'];

$customer_name = $row_customer['CUSTOMER_NAME'];

$customer_email = $row_customer['CUSTOMER_EMAIL'];

$customer_address = $row_customer['CUSTOMER_ADDRESS'];

$customer_contact = $row_customer['CUSTOMER_NUMBER'];

$customer_image = $row_customer['CUSTOMER_IMAGE'];

?>

<h1 align="center"> Edit Your Account </h1>

<form action="" method="post" enctype="multipart/form-data"><!-- form Begin -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Customer Name: </label>
        
        <input type="text" name="c_name" class="form-control" value="<?php echo $customer_name; ?>" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Customer Email: </label>
        
        <input type="text" name="c_email" class="form-control" value="<?php echo $customer_email; ?>" required>
        
    </div><!-- form-group Finish -->
    
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Customer Contact: </label>
        
        <input type="text" name="c_contact" class="form-control" value="<?php echo $customer_contact; ?>" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Customer Address: </label>
        
        <input type="text" name="c_address" class="form-control" value="<?php echo $customer_address; ?>" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Customer Image: </label>
        
        <input type="file" name="c_image" class="form-control form-height-custom">
        
        <img class="img-responsive" src="customer_images/<?php echo $customer_image; ?>" alt="Customer Image">
        
    </div><!-- form-group Finish -->
    
    <div class="text-center"><!-- text-center Begin -->
        
        <button name="update" class="btn btn-primary"><!-- btn btn-primary Begin -->
            
            <i class="fa fa-user-md"></i> Update Now
            
        </button><!-- btn btn-primary inish -->
        
    </div><!-- text-center Finish -->
    
</form><!-- form Finish -->

<?php 

if(isset($_POST['update'])){
    
    $update_id = $customer_id;
    
    $c_name = $_POST['c_name'];
    
    $c_email = $_POST['c_email'];
    
    $c_address = $_POST['c_address'];
    
    $c_contact = $_POST['c_contact'];
    
    $c_image = $_FILES['c_image']['name'];
    
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    move_uploaded_file ($c_image_tmp,"customer_images/$c_image");
    
    $update_customer = "update customer set CUSTOMER_NAME='$c_name',CUSTOMER_EMAIL='$c_email',CUSTOMER_ADDRESS='$c_address',CUSTOMER_NUMBER='$c_contact',CUSTOMER_IMAGE='$c_image' where CUSTOMER_ID='$update_id' ";
    
    $run_customer = oci_parse($con,$update_customer);

    oci_execute($run_customer);
    
    if($run_customer){
        
        echo "<script>alert('Your account has been updated successfully. Please login again.')</script>";
        
        echo "<script>window.open('logout.php','_self')</script>";
        
    }
    
}

?>