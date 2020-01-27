<?php

    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->

                <i class="fa fa-dashboard"></i> Dashboard / View Products

            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->

                   <i class="fa fa-tags"></i>  View Products

               </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->

            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->

                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> Product ID </th>
                                <th> Product Title </th>
                                <th> Product Image </th>
                                <th> Product Price </th>
                                   <th> Product Description </th>
                                <th> Product Date </th>
                                <th> Product Quantity </th>
                                </th>
                                <th> Delete Product </th>
                                <th> Edit Product </th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->

                        <tbody><!-- tbody begin -->

                            <?php

                                $trader_session = $_SESSION['admin_email'];

                                $ky = "select * from trader where TRADER_EMAIL = '$trader_session'";

                                $tk = oci_parse($con,$ky);
                                oci_execute($tk);
                                $th = oci_fetch_array($tk);
                                  $t_id = $th['TRADER_ID'];


                                $i=0;

                                $get_pro = "select * from product where TRADER_ID='$t_id'";

                                $run_pro = oci_parse($con,$get_pro);

                                oci_execute($run_pro);

                                while($row_pro=oci_fetch_array($run_pro)){

                                    $pro_id = $row_pro['PRODUCT_ID'];

                                    $pro_title = $row_pro['PRODUCT_TITLE'];

                                    $pro_img1 = $row_pro['PRODUCT_IMG1'];

                                    $pro_price = $row_pro['PRODUCT_PRICE'];

                                    $pro_keywords = $row_pro['PRODUCT_DESC'];

                                    $pro_date = $row_pro['PRODUCT_DATE'];

                                    $pro_quantity = $row_pro['PRODUCT_QUANTITY'];

                                    $i++;

                            ?>

                            <tr><!-- tr begin -->
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $pro_title; ?> </td>
                                <td> <img src="product_images/<?php echo $pro_img1; ?>" width="60" height="60"></td>
                                <td> $ <?php echo $pro_price; ?> </td>

                                <td>  <?php echo $pro_keywords; ?> </td>
                                <td> <?php echo $pro_date ?> </td>
                                <td> <?php echo $pro_quantity ?> </td>
                                <td>

                                     <a href="index.php?delete_product=<?php echo $pro_id; ?>">

                                        <i class="fa fa-trash-o"></i> Delete

                                     </a>

                                </td>
                                <td>

                                     <a href="index.php?edit_product=<?php echo $pro_id; ?>">

                                        <i class="fa fa-pencil"></i> Edit

                                     </a>

                                </td>
                            </tr><!-- tr finish -->

                            <?php } ?>

                        </tbody><!-- tbody finish -->

                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->

        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

<?php } ?>
