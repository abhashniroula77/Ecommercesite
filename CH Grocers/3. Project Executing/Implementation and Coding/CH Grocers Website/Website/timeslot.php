<link rel="stylesheet" type="text/css" href="styles/style.css">


<?php
include("includes/header.php");
?>
<?php
include("includes/db.php");



?>


<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript" src="js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/settime_style.css">


</head>
<style>



</style>

<body>





<div class="col-md-3" id="cart">
	<div class="box">
		<form action="" method="post" enctype="multipart-form-data">
			<h1>Collection Time Slot</h1>
  <?php
  $ip_add=getRealIpUser();
  $select_cart ="SELECT * FROM CART WHERE IP_ADD ='$ip_add'";
  $run_cart =oci_parse($con, $select_cart);
  oci_execute($run_cart);
  $count =oci_fetch_all($run_cart, $output);


  ?>

				<div class="table-responsive">
				<table class="table">


               <tbody>
            <?php

              $select_cart ="SELECT * FROM CART WHERE IP_ADD ='$ip_add'";
  $run_cart =oci_parse($con, $select_cart);
  oci_execute($run_cart);
              $total=0;


              while($row_cart=oci_fetch_array($run_cart)){
                $pro_id =$row_cart['CART_ID'];

                $pro_qty =$row_cart['CART_QUANTITY'];

                $get_products ="SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$pro_id'";
                $run_products =oci_parse($con, $get_products);
                oci_execute($run_products);

                while ($row_products=oci_fetch_array($run_products)) {
                    $product_title=$row_products['PRODUCT_TITLE'];
                    $product_img1 =$row_products['PRODUCT_IMG1'];

                    $only_price =$row_products['PRODUCT_PRICE'];
                    $sub_total =$row_products['PRODUCT_PRICE']*$pro_qty;
                    $total+=$sub_total;
                  }

                ?>

          <?php
}

          ?>
                 </tbody>

                 <tfoot>
<tr>
                                        <td><label>Delivery Day: </label><span class="pull-right">

                                            <?php
                                            date_default_timezone_set('Asia/Kathmandu');
                                              $datenow = date("l");
                                                          if ($datenow = 'Sunday' || $datenow = 'Monday' || $datenow = 'Tuesday'){
                                                             ?>
                                                            <select name="timeslot" class="btn btn-md">
                                                              <option value="Wednesday">Wednesday</option>
                                                              <option value="Thursday">Thursday</option>
                                                              <option value="Friday">Friday</option>
                                                            </select>
                                                            <?php
                                                          } elseif($datenow = 'Wednesday'){
                                                            ?>
                                                            <select name="timeslot" class="btn btn-md">
                                                              <option value="Thursday">Thursday</option>
                                                              <option value="Friday">Friday</option>
                                                            </select>
                                                            <?php
                                                          } elseif($datenow = 'Thursday'){
                                                            ?>
                                                            <select name="timeslot" class="btn btn-md">
                                                              <option value="Friday">Friday</option>
                                                              <option value="Wednesday">Wednesday</option>
                                                            </select>
                                                            <?php


                                                          } elseif($datenow = 'Friday' || $datenow = 'Saturday'){
                                                            ?>
                                                            <select name="timeslot" class="btn btn-md">
                                                              <option value="Wednesday">Wednesday</option>
                                                              <option value="Thursday">Thursday</option>
                                                            </select>
                                                            <?php
                                                          } ?>


                                        </span></td>
                                    </tr>



 <tr>
                                        <td><label>Delivery Time: </label><span class="pull-right">

                                            <?php
                                            date_default_timezone_set('Asia/Kathmandu');
                                              $time = date('h');
                                                          if ($time > 16 || $time < 10){
                                                             ?>
                                                            <select name="time" class="btn btn-md">
                                                              <option value="10-13">10 AM - 1 PM</option>
                                                              <option value="13-16">1 PM - 4 PM</option>
                                                              <option value="16-19">4 PM - 7 PM</option>
                                                            </select>
                                                            <?php
                                                          }elseif($time < 13){
                                                            ?>
                                                            <select name="time" class="btn btn-md">
                                                              <option value="13-16">1 PM - 4 PM</option>
                                                              <option value="16-19">4 PM - 7 PM</option>
                                                            </select>
                                                            <?php
                                                          }elseif($time < 16){
                                                            ?>
                                                            <select name="time" class="btn btn-md">
                                                              <option value="16-19">4 PM - 7 PM</option>
                                                            </select>
                                                            <?php


                                                          }
                                                            ?>




                                        </span></td>
                                    </tr>
                                    <tr>
                                      <td>
                                      <button class="btn btn-info" name="submit">
                                        Submit
                                      </button>
                                    </td>
                                    </tr>




               </tfoot>

				</table>



			</div>

		</form>

    <?php
if (isset($_POST['submit'])){
  $day =$_POST['timeslot'];
  $time =$_POST['time'];
  $timeid=mt_rand(10,9999);
  if (isset($_SESSION['CUSTOMER_EMAIL'])) {
  $c_email=$_SESSION['CUSTOMER_EMAIL'];
  $get_id ="SELECT * FROM CUSTOMER WHERE CUSTOMER_EMAIL ='$c_email'";
  $run_id =oci_parse($con, $get_id);
  oci_execute($run_id);
  $row_id =oci_fetch_array($run_id);
  $c_id =$row_id['CUSTOMER_ID'];

  }

  $get_times="INSERT INTO TIMESLOT(C_DAY,C_TIME,C_CREATED, CUSTOMER_ID) VALUES('$day','$time',sysdate,'$c_id')";
    $run_times =oci_parse($con, $get_times);
  oci_execute($run_times);



  echo "<script>window.open('checkout.php','_self')</script>";


}
    ?>

	</div>



<hr>
<hr>



</div>

<div class="col-md-9">
<div class="box" id="order-summery">
	<div class="box-header">
<h3>Order Summery</h3>
	</div>
	<p class="text-muted">
		shipping and additional costs .
	</p>
	<div class="table-responsive">
		<table class="table">
		  <tbody>
		  	<tr>
		  		<td>order subtotal</td>
		  		<th><?php echo $total; ?></th>
		  	</tr>
		  	<tr>
		  		<td>Shipping and handling</td>
		  		<td>$0.00</td>
		  	</tr>
		  	<tr>
		  		<td>Tax</td>
		  		<th>$0.00</th>
		  	</tr>
        <tr>
          <td><strong>Total</strong></td>
          <th><strong>$ <?php echo $total; ?></strong></th>
        </tr>


		  </tbody>

		</table>
	</div>
</div>
</div>
</div>
</div>

<?php

include("includes/footer.php");

?>

</body>
</html>
