<?php

    $active='Account';
    include("includes/db.php");
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

                           <h2> Register as a Trader</h2>

                       </center><!-- center Finish -->

                       <form action="trader_register.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Trader Name</label>

                               <input type="text" class="form-control" name="c_name" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Trader Email</label>

                               <input type="text" class="form-control" name="c_email" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Trader Password</label>

                               <input type="password" class="form-control" name="c_pass" required>

                           </div><!-- form-group Finish -->





                           <div class="form-group"><!-- form-group Begin -->

                               <label>Trader Mobile No.</label>

                               <input type="text" class="form-control" name="c_number" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Trader Address</label>

                               <input type="text" class="form-control" name="c_address" required>

                           </div><!-- form-group Finish -->



                           <div class="form-group"><!-- form-group Begin -->

                               <label>Profile Picture</label>

                               <input type="file" class="form-control form-height-custom" name="c_image" required>

                           </div><!-- form-group Finish -->

<div class="form-group"><!-- form-group Begin -->
  <label>Trader Category</label>
                           <select name="shop" class="form-control" required><option value="">Select Category</option>
                            <?php getPCatsd(); ?>

                           </select>
                         </div>



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

    $shop=$_POST['shop'];

    move_uploaded_file($c_image_tmp,"trader/trader_images/$c_image");

    $insert_customer = "insert into trader (TRADER_NAME,TRADER_EMAIL,TRADER_PASSWORD,TRADER_NUMBER,TRADER_ADDRESS,TRADER_IMAGE,CATEGORY_ID) values ('$c_name','$c_email','$c_pass','$c_number','$c_address','$c_image','$shop')";

    $run_customer = oci_parse($con,$insert_customer);

  $k =  oci_execute($run_customer);


        if($k)
        {
          $to  = $c_email;
          $subject = "Confirmation";
          $message = 'Thank u for being part of our website


          <a href="http://localhost/mainproject/verifytrader.php?key=$tok"></a>
            ';

            $head='from: chgrocers123@gmail.com';
            $z=mail($to,$subject,$message,$head);



        }

     $_SESSION['TRADER_EMAIL']=$c_email;

        echo "<script>alert('Please check your email to verify your registration.')</script>";
         echo "<script>window.open('index.php','_self')</script>";

    /*$sel_cart = "select * from cart where IP_ADD='$c_ip'";

    $run_cart = oci_parse($con,$sel_cart);

    oci_execute($run_cart);

    $check_cart = oci_fetch($run_cart);*/



}

?>
