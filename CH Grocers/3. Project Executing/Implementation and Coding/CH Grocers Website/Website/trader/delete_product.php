<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<?php

    if(isset($_GET['delete_product'])){

        $delete_id = $_GET['delete_product'];

        $delete_pro = "delete from product where PRODUCT_ID ='$delete_id'";

        $run_delete = oci_parse($con,$delete_pro);

        oci_execute($run_delete);

        if($run_delete){

            echo "<script>alert('Your product has been deleted.')</script>";

            echo "<script>window.open('index.php?view_products','_self')</script>";

        }

    }

?>

<?php } ?>
