<?php

    session_start();
    include("includes/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CH Grocers Trader Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

   <div class="container"><!-- container begin -->
       <form action="" class="form-login" method="post"><!-- form-login begin -->
           <h2 class="form-login-heading"> Trader Login </h2>

           <input type="text" class="form-control" placeholder="Email Address" name="admin_email" required>

           <input type="password" class="form-control" placeholder="Your Password" name="admin_pass" required>

           <button type="submit" class="btn btn-lg btn-primary btn-block" name="trader_login"><!-- btn btn-lg btn-primary btn-block begin -->

               Login

           </button><!-- btn btn-lg btn-primary btn-block finish -->

       </form><!-- form-login finish -->
   </div><!-- container finish -->

</body>
</html>


<?php

    if(isset($_POST['trader_login'])){

        $admin_email = $_POST['admin_email'];

        $admin_pass = $_POST['admin_pass'];

        $get_admin = "select * from trader where TRADER_EMAIL='$admin_email' AND TRADER_PASSWORD='$admin_pass'";

        $run_admin = oci_parse($con,$get_admin);

        oci_execute($run_admin);

      $count = oci_fetch($run_admin);

      $get= "SELECT * FROM trader where TRADER_EMAIL='$admin_email' AND TRADER_PASSWORD='$admin_pass' ";
      $run=oci_parse($con, $get);
      oci_execute($run);
    while(  $row1= oci_fetch_array($run)){
      $role=$row1['STATUST'];
}


        if($count==1 AND $role=='1'){

            $_SESSION['admin_email']=$admin_email;

            echo "<script>alert('Welcome Back! You have been logged in.')</script>";

            echo "<script>window.open('index.php?dashboard','_self')</script>";

        }else{

            echo "<script>alert('Email or Password is Wrong !')</script>";

        }

    }


?>
