<?php 

include("includes/db.php");
include("functions/functions.php");

?>
<?php 

if(isset($_GET['c_id'])){
    
    $customer_id = $_GET['c_id'];
    
}

$ip_add = getRealIpUser();

$status = "pending";

$invoice_no = mt_rand();

$select_cart = "select * from cart where IP_add='$ip_add'";

$run_cart = oci_parse($con,$select_cart);

oci_execute($run_cart);

while($row_cart = oci_fetch_array($run_cart)){
    
    $pro_id = $row_cart['CART_ID'];
    
   
    
    
    
    $get_products = "select * from product where PRODUCT_id='$pro_id'";
    
    $run_products = oci_parse($con,$get_products);

    oci_execute($run_products);
    
    while($row_products = oci_fetch_array($run_products)){
        
        $sub_total = $row_products['PRODUCT_PRICE']*$pro_qty;
        
        $insert_customer_order = "insert into customer_order (CUSTOMER_ID,ORDER_AMOUNT,ORDER_INVOICE,ORDER_DATE,ORDER_STATUS,CART_ID) values ('$customer_id','$sub_total','$invoice_no',NOW(),'$status',$pro_id)";
        
        $run_customer_order = oci_parse($con,$insert_customer_order);

        oci_execute();
        
        $insert_pending_order = "insert into pending_orders (CUSTOMER_ID,CART_ID,PRODUCT_ID) values ('$customer_id','$pro_id','$pro_id')";
        
        $run_pending_order = oci_parse($con,$insert_pending_order);

        oci_execute();
        
        $delete_cart = "delete from cart where IP_ADD='$ip_add'";
        
        $run_delete = oci_parse($con,$delete_cart);

        oci_execute($run_delete);
        
        echo "<script>alert('Your orders has been submitted, Thanks')</script>";
        
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
        
    }
    
}

?>