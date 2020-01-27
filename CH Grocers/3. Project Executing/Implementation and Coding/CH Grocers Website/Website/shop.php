<?php
    $active='Shop';
    include("includes/header.php");
    include("includes/db.php");



    ?>





     <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Shop

             </li>




               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->


 <div class="col-md-3"><!-- col-md-3 Begin -->

   <?php

    include("includes/sidebar.php");

    ?>


           </div><!-- col-md-3 Finish -->

           <div class="col-md-9"><!--md 9 begin-->

            <?php

                if(!isset($_GET['p_cat'])){

             echo "

              <div class='box'><!-- box Begin -->
                  <h1>Shop</h1>
                  <p>
                     Buy from a variety of products in our shop where you can get the freshest and the highest quality grocery items.
                  </p>
               </div><!-- box finish-->
               ";}
                ?>


               <div class="row"><!-- row Begin -->
                
                <?php

                    if(!isset($_GET['p_cat'])){

                      $per_page=6;
                      if(isset($_GET['page']))

                      {

                         $page=$_GET['page'];
                      }


                      else
                      {
                        $page=1;

                      $start_from=($page-1) * $per_page;
                      $get_products = " select *  from product where rownum <=8 order by 1 DESC ";
                      $run_products=oci_parse($con,$get_products);
                      oci_execute($run_products);
                      while($row_products=oci_fetch_array($run_products))

                      {
                          $pro_id = $row_products['PRODUCT_ID'];

                          $pro_title = $row_products['PRODUCT_TITLE'];

                          $pro_price = $row_products['PRODUCT_PRICE'];

                          $pro_img1 = $row_products['PRODUCT_IMG1'];

                          echo "

                                    <div class='col-md-4 col-sm-6 center-responsive'>

                                        <div class='product'>

                                            <a href='details.php?pro_id=$pro_id'>

                                                <img class='img-responsive' src='Trader/product_images/$pro_img1'>

                                            </a>

                                            <div class='text'>

                                                <h3>

                                                    <a href='details.php?pro_id=$pro_id'> $pro_title </a>

                                                </h3>

                                                <p class='price'>

                                                    $$pro_price

                                                </p>

                                                <p class='buttons'>

                                                    <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                                                        View Details

                                                    </a>

                                                    <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                                                        <i class='fa fa-shopping-cart'></i> Add To Cart

                                                    </a>

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                ";

                      }
                       }
                     }

                    ?>

               </div><!-- row Finish -->

              <div class="row">
                 <?php
                   getcatpro();
                 ?>

              </div>

           </div><!--md 9 end-->


</div><!-- container Finish -->
       </div><!-- #content finish -->




       <?php

       include("includes/footer.php");
       ?>

       <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
</body>
</html>
