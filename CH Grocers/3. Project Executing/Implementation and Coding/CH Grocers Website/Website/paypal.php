<html lang="en">
<head>
    <title>PHP - Paypal Payment Gateway Integration</title>
</head>
<body style="background:#E1E1E1">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />
<style>
    
    .checkoubox{
background: #bce3da;
    margin: 0 0 30px;
    position: relative;
    left: 65%;
    border: solid 1px #e6e6e6;
    box-sizing: border-box;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, .3);

}


</style>


<div class="checkoubox">

   <?php

    $session_email =$_SESSION['customer_email'];
    $select_customer ="SELECT * FROM CUSTOMERS WHERE CUSTOMER_EMAIL ='$session_email'";
    $run_customer =oci_parse($con, $select_customer);
    oci_execute($run_customer);
    $row_customer =oci_fetch_array($run_customer);
    $customer_id =$row_customer['CUSTOMER_ID'];

   ?> 

	<h1 class="text-center">
		  Payment Option
	</h1>
	<p class="lead text-center">
		<a href="order.php?c_id=<?php echo $customer_id;?>">Pay via. Bank</a>
	</p>
	<center>
	<img  width="150" height="130" src="images/paypl.png" >
	</center>
	<p class="lead text-center">
		<a>OR</a>
	</p>
	<p class="lead text-center">
		<a href="#">Paypal</a>
	</p>

	<center>
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> 
			<input type="hidden" name="business" value="chgrocers1234@.com">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="currency_code" value="USD" >
 		   <input type="hidden" name="return" value="http://localhost/finalstopshop/paypal_order.php?c_id=<?php echo $customer_id;?>">
 		   <input type="hidden" name="cancel_return" value="http://localhost/finalstopshop/index.php">

 		   <?php
          $i=0;
          $ip_add =getRealUserIp();
          $get_cart ="SELECT * FROM CART WHERE IP_ADD='$ip_add'";
          $run_cart=oci_parse($con, $get_cart);
          oci_execute($run_cart);
 		   while ( $row_cart =oci_fetch_array($run_cart)) {

 		   $pro_id =$row_cart['P_ID'];
 		   $pro_qty =$row_cart['QTY'];
 		   $pro_price =$row_cart['P_PRICE'];
 		   $get_products="SELECT * FROM PRODUCTS WHERE PRODUCT_ID='$pro_id'";
 		   $run_products=oci_parse($con, $get_products);
 		   oci_execute($run_products);
 		   $row_products =oci_fetch_array($run_products);
 		   $product_title =$row_products['PRODUCT_TITLE'];
 		   $i++;
 		   ?>

 		   <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $product_title; ?>">

 		   	   <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $i;?>">


 		   	   <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $pro_price;?>">


 		   	   <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $pro_qty; ?>">

<?php

}
?>
<input type="image" name="submit" width="150" height="130" src="images/paypal.png">


		</form>
	
	</center>


</div>
</body>
</html>