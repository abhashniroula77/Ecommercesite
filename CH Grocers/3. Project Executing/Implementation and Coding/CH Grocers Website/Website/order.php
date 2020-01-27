<?php

include("includes/db.php");
include("functions/functions.php");


?>

<?php
if (isset($_GET['c_id'])) {
$customer_id =$_GET['c_id'];

}

$ip_add =getRealIpUser();
$status ="Complete";
$invoice_no =mt_rand();

$get_time_id="SELECT max(C_CREATED) FROM TIMESLOT";
$run_time_id =oci_parse($con, $get_time_id);
oci_execute($run_time_id);
$row =oci_fetch_assoc($run_time_id);
foreach ($row as $key) {
 $get= "SELECT * FROM TIMESLOT WHERE C_CREATED='$key'";
 $run=oci_parse($con, $get);
 oci_execute($run);
 $row1= oci_fetch_array($run);
 $time_id=$row1['T_ID'];
 $update="UPDATE TIMESLOT SET ORDER_INVOICE='$invoice_no' WHERE T_ID='$time_id'";
 $run_update=oci_parse($con, $update);
 oci_execute($run_update);
}




$date=date('d/M/Y');
// echo $date;
$select_cart ="SELECT * FROM CART WHERE IP_ADD='$ip_add'";
$run_cart =oci_parse($con, $select_cart);
oci_execute($run_cart);

while($row_cart =oci_fetch_array($run_cart)){
  $pro_id =$row_cart['CART_ID'];

    $pro_qty =$row_cart['CART_QUANTITY'];
   $decrease_qty="SELECT * FROM PRODUCT WHERE PRODUCT_ID='$pro_id'";
  $run_qty=oci_parse($con, $decrease_qty);
  oci_execute($run_qty);
  $row_qty=oci_fetch_array($run_qty);
  $f_qty=$row_qty['PRODUCT_QUANTITY'];
    $final_qty=$f_qty-$pro_qty;



    $update_product_qty="UPDATE PRODUCT SET PRODUCT_QUANTITY = '$final_qty' Where PRODUCT_ID='$pro_id' ";
    $run_product_qty=oci_parse($con, $update_product_qty);
    oci_execute($run_product_qty);




  $get_products ="SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$pro_id'";
  $run_products =oci_parse($con, $get_products);
  oci_execute($run_products);

  while ($row_products =oci_fetch_array($run_products)) {

    $sub_total =$row_products['PRODUCT_PRICE']*$pro_qty;

    $insert_customer_order ="INSERT INTO CUSTOMER_ORDER(ORDER_AMOUNT,ORDER_INVOICE,ORDER_DATE,ORDER_STATUS,CUSTOMER_ID,PRODUCT_ID,QTY) VALUES('$sub_total', '$invoice_no', '$date','$status','$customer_id','$pro_id','$pro_qty')";
        $run_customer_order =oci_parse($con,$insert_customer_order);
    oci_execute($run_customer_order);



    $delete_cart ="DELETE FROM CART WHERE IP_ADD ='$ip_add'";
    $run_delete =oci_parse($con, $delete_cart);
    oci_execute($run_delete);
    echo "<script>alert('Your order has been submitted. Thank you for shopping with us.')</script>";
    echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

  }
}


?>
