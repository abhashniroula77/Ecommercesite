<?php
    $active='Cart';
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
                       Cart
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->

           <div id="cart" class="col-md-9"><!-- col-md-9 Begin -->

               <div class="box"><!-- box Begin -->

                   <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                       <h1>Shopping Cart</h1>

                       <?php

                       $ip_add = getRealIpUser();

                       $select_cart = "select * from cart where IP_add='$ip_add'";

                       $run_cart = oci_parse($con,$select_cart);

                       oci_execute($run_cart);

                        $li = oci_parse($con, "SELECT count(*) FROM CART");
                        oci_execute($li);
                        $row=oci_fetch_array($li);
                        $count=$row[0];





                       ?>
                       <p class="text-muted">You currently have <?php echo $count; ?> item(s) in your cart</p>



                       <div class="table-responsive"><!-- table-responsive Begin -->

                           <table class="table"><!-- table Begin -->

                               <thead><!-- thead Begin -->

                                   <tr><!-- tr Begin -->

                                       <th colspan="2">Product</th>
                                       <th>Quantity</th>
                                       <th>Unit Price</th>

                                       <th colspan="1">Delete</th>
                                       <th colspan="2">Sub-Total</th>

                                   </tr><!-- tr Finish -->

                               </thead><!-- thead Finish -->

                               <tbody><!-- tbody Begin -->

                                  <?php

                                   $total = 0;

                                   while($row_cart = oci_fetch_array($run_cart)){

                                     $pro_id = $row_cart['CART_ID'];



                                     $pro_qty = $row_cart['CART_QUANTITY'];

                                       $get_products = "select * from product where PRODUCT_ID='$pro_id'";

                                       $run_products = oci_parse($con,$get_products);

                                       oci_execute($run_products);

                                       while($row_products = oci_fetch_array($run_products)){

                                           $product_title = $row_products['PRODUCT_TITLE'];

                                           $product_img1 = $row_products['PRODUCT_IMG1'];

                                           $only_price = $row_products['PRODUCT_PRICE'];

                                           $sub_total = $row_products['PRODUCT_PRICE']*$pro_qty;

                                           $total += $sub_total;

                                   ?>

                                   <tr><!-- tr Begin -->

                                       <td>

                                           <img class="img-responsive" src="Trader/product_images/<?php echo $product_img1; ?>" alt="Product 3a">

                                       </td>

                                       <td>

                                           <a href="details.php?pro_id=<?php echo $pro_id; ?>"> <?php echo $product_title; ?> </a>

                                       </td>

                                       <td>

                                           <?php echo $pro_qty; ?>

                                       </td>

                                       <td>

                                           <?php echo $only_price; ?>

                                       </td>



                                       <td>

                                           <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">

                                       </td>

                                       <td>

                                           $<?php echo $sub_total; ?>

                                       </td>

                                   </tr><!-- tr Finish -->

                                   <?php } } ?>

                               </tbody><!-- tbody Finish -->

                               <tfoot><!-- tfoot Begin -->

                                   <tr><!-- tr Begin -->

                                       <th colspan="5">Total</th>
                                       <th colspan="2">$<?php echo $total; ?></th>

                                   </tr><!-- tr Finish -->

                               </tfoot><!-- tfoot Finish -->

                           </table><!-- table Finish -->

                       </div><!-- table-responsive Finish -->

                       <div class="box-footer"><!-- box-footer Begin -->

                           <div class="pull-left"><!-- pull-left Begin -->

                               <a href="index.php" class="btn btn-default"><!-- btn btn-default Begin -->

                                   <i class="fa fa-chevron-left"></i> Continue Shopping

                               </a><!-- btn btn-default Finish -->

                           </div><!-- pull-left Finish -->

                           <div class="pull-right"><!-- pull-right Begin -->

                               <button type="submit" name="update" value="Update Cart" class="btn btn-default"><!-- btn btn-default Begin -->

                                   <i class="fa fa-refresh"></i> Update Cart

                               </button><!-- btn btn-default Finish -->


                               <a href="checkout.php" class="btn btn-primary">

                                   Proceed Checkout <i class="fa fa-chevron-right"></i>

                               </a>




                           </div><!-- pull-right Finish -->

                       </div><!-- box-footer Finish -->

                   </form><!-- form Finish -->



               </div><!-- box Finish -->




               <?php

                function update_cart(){

                    global $con;

                    if(isset($_POST['update'])){

                        foreach($_POST['remove'] as $remove_id){

                            $delete_product = "delete from cart where CART_ID='$remove_id'";

                            $run_delete = oci_parse($con,$delete_product);
                            oci_execute($run_delete);

                            if($run_delete){

                                echo "<script>window.open('cart.php','_self')</script>";

                            }

                        }

                    }

                }

               echo @$up_cart = update_cart();

               ?>

               <div id="row same-heigh-row"><!-- #row same-heigh-row Begin -->
                   <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
                       <div class="box same-height headline"><!-- box same-height headline Begin -->
                           <h3 class="text-center">Products You May Like</h3>
                       </div><!-- box same-height headline Finish -->
                   </div><!-- col-md-3 col-sm-6 Finish -->

                   <?php

                   $get_products = "select * from product where rownum <=6 order by 1 DESC";

                   $run_products = oci_parse($con,$get_products);

                   oci_execute($run_products);

                   while($row_products=oci_fetch_array($run_products)){

                       $pro_id = $row_products['PRODUCT_ID'];

                       $pro_title = $row_products['PRODUCT_TITLE'];

                       $pro_price = $row_products['PRODUCT_PRICE'];

                       $pro_img1 = $row_products['PRODUCT_IMG1'];

                       echo "

                    <div class='col-md-3 col-sm-6 center-responsive'><!-- col-md-3 col-sm-6 center-responsive Begin -->
                       <div class='product same-height'><!-- product same-height Begin -->
                           <a href='details.php?pro_id=$pro_id'>
                               <img class='img-responsive' src='Trader/product_images/$pro_img1' alt='Product 6'>
                            </a>

                            <div class='text'><!-- text Begin -->
                                <h3><a href='details.php?pro_id=$pro_id'> $pro_title </a></h3>

                                <p class='price'>$$pro_price</p>

                            </div><!-- text Finish -->

                        </div><!-- product same-height Finish -->
                   </div><!-- col-md-3 col-sm-6 center-responsive Finish -->

                       ";

                   }

                   ?>

               </div><!-- #row same-heigh-row Finish -->

           </div><!-- col-md-9 Finish -->

           <div class="col-md-3"><!-- col-md-3 Begin -->

               <div id="order-summary" class="box"><!-- box Begin -->

                   <div class="box-header"><!-- box-header Begin -->

                       <h3>Order Summary</h3>

                   </div><!-- box-header Finish -->

                   <p class="text-muted"><!-- text-muted Begin -->

                       Shipping and additional costs are calculated based on the value you have entered.

                   </p><!-- text-muted Finish -->

                   <div class="table-responsive"><!-- table-responsive Begin -->

                       <table class="table"><!-- table Begin -->

                           <tbody><!-- tbody Begin -->

                               <tr><!-- tr Begin -->

                                   <td> Order All Sub-Total </td>
                                   <th> $<?php echo $total; ?> </th>

                               </tr><!-- tr Finish -->

                               <tr><!-- tr Begin -->

                                   <td> Shipping and Handling </td>
                                   <td> $0 </td>

                               </tr><!-- tr Finish -->

                               <tr><!-- tr Begin -->

                                   <td> Tax </td>
                                   <th> $0 </th>

                               </tr><!-- tr Finish -->

                               <tr class="total"><!-- tr Begin -->

                                   <td> Total </td>
                                   <th> $<?php echo $total; ?> </th>

                               </tr><!-- tr Finish -->

                           </tbody><!-- tbody Finish -->

                       </table><!-- table Finish -->

                   </div><!-- table-responsive Finish -->

               </div><!-- box Finish -->

           </div><!-- col-md-3 Finish -->

       </div><!-- container Finish -->
   </div><!-- #content Finish -->



   <?php

    include("includes/footer.php");

    ?>

    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>


</body>
</html>
