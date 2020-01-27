
<?php
$active='Home';
include("includes/header.php");

?>


   <div class="container" id="slider"><!-- container Begin -->

       <div class="col-md-12"><!-- col-md-12 Begin -->

           <div class="carousel slide" id="myCarousel" data-ride="carousel"><!-- carousel slide Begin -->

               <ol class="carousel-indicators"><!-- carousel-indicators Begin -->

                   <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
                   <li data-target="#myCarousel" data-slide-to="1"></li>
                   <li data-target="#myCarousel" data-slide-to="2"></li>
                   

               </ol><!-- carousel-indicators Finish -->

               <div class="carousel-inner"><!-- carousel-inner Begin -->

                  <?php

                   $get_slides = "SELECT * from SLIDER WHERE SLIDER_ID<=1";

                  $run_slides = oci_parse($con, $get_slides);

                  oci_execute($run_slides);

                   while($row_slides=oci_fetch_array($run_slides)){

                       $slide_name = $row_slides['SLIDER_NAME'];
                       $slide_image = $row_slides['SLIDER_IMAGE'];

                       echo "

                       <div class='item active'>

                       <img src='images/$slide_image'>

                       </div>

                       ";

                   }

                   $get_slides = "SELECT * from SLIDER WHERE SLIDER_ID>1";

                   $run_slides = oci_parse($con, $get_slides);
                   oci_execute($run_slides);

                   while($row_slides=oci_fetch_array($run_slides)){

                       $slide_name = $row_slides['SLIDER_NAME'];
                       $slide_image = $row_slides['SLIDER_IMAGE'];

                       echo "

                       <div class='item'>

                       <img src='images/$slide_image'>

                       </div>

                       ";

                   }

                   ?>


               </div><!-- carousel-inner Finish -->
               <a href="#myCarousel" class="left carousel-control" data-slide="prev"><!-- left carousel-control Begin -->

                   <span class="glyphicon glyphicon-chevron-left"></span>
                   <span class="sr-only">Previous</span>

               </a><!-- left carousel-control Finish -->
               <a href="#myCarousel" class="right carousel-control" data-slide="next"><!-- Right carousel-control Begin -->

                   <span class="glyphicon glyphicon-chevron-right"></span>
                   <span class="sr-only">Next</span>

               </a><!-- Right carousel-control Finish -->



             </div><!-- carousel-slide Finish -->

           </div><!-- col finish Finish -->

</div><!--container finish-->

<div id="advantages"><!-- #advantages Begin -->

       <div class="container"><!-- container Begin -->

           <div class="same-height-row"><!-- same-height-row Begin -->

               <div class="col-sm-4"><!-- col-sm-4 Begin -->

                   <div class="box same-height"><!-- box same-height Begin -->

                       <div class="icon"><!-- icon Begin -->

                           <i class="fa fa-heart"></i>

                       </div><!-- icon Finish -->

                       <h3><a href="#">Best Offer</a></h3>

                       <p> We provide the best offers on our variety of products. </p>

                   </div><!-- box same-height Finish -->

               </div><!-- col-sm-4 Finish -->

               <div class="col-sm-4"><!-- col-sm-4 Begin -->

                   <div class="box same-height"><!-- box same-height Begin -->

                       <div class="icon"><!-- icon Begin -->

                           <i class="fa fa-tag"></i>

                       </div><!-- icon Finish -->

                       <h3><a href="#">Best Prices</a></h3>

                       <p> We offer the most reasonable prices on our products.</p>

                   </div><!-- box same-height Finish -->

               </div><!-- col-sm-4 Finish -->

               <div class="col-sm-4"><!-- col-sm-4 Begin -->

                   <div class="box same-height"><!-- box same-height Begin -->

                       <div class="icon"><!-- icon Begin -->

                           <i class="fa fa-thumbs-up"></i>

                       </div><!-- icon Finish -->

                       <h3><a href="#">100% Fresh</a></h3>

                       <p> We provide only fresh products brought to you directly from the shop.</p>

                   </div><!-- box same-height Finish -->

               </div><!-- col-sm-4 Finish -->

           </div><!-- same-height-row Finish -->

       </div><!-- container Finish -->

   </div><!-- #advantages Finish -->
    <div id="hot"><!-- #hot Begin -->

       <div class="box"><!-- box Begin -->

           <div class="container"><!-- container Begin -->

               <div class="col-md-12"><!-- col-md-12 Begin -->

                   <h2>
                       Our Latest Products
                   </h2>

               </div><!-- col-md-12 Finish -->

           </div><!-- container Finish -->

       </div><!-- box Finish -->

   </div><!-- #hot Finish -->

   <div id="content" class="container"><!-- container Begin -->

       <div class="row"><!-- row Begin -->
         <?php

         getPro();

         ?>
          
       </div><!-- row Finish -->

   </div><!-- container Finish -->

   <?php

    include("includes/footer.php");

    ?>
 <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
</body>
</html>
               