<div class="box"><!-- box Begin -->

  <div class="container" style=margin-left:220px; >




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


<br>
<br>



    </div>


    </div>
  </center>

   <?php

    $session_email = $_SESSION['CUSTOMER_EMAIL'];

    $select_customer = "select * from customer where CUSTOMER_EMAIL='$session_email'";

    $run_customer = oci_parse($con,$select_customer);

    oci_execute($run_customer);

    $row_customer = oci_fetch_array($run_customer);

    $customer_id = $row_customer['CUSTOMER_ID'];

    ?>



    <center>
    <img  width="250" height="130" src="images/paypal.png" >


    <p class="lead text-center">
        
    </p>

    <center>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="upload" value="1">
              <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="business" value="niroulaabhash787@gmail.com">


            <input type="hidden" name="currency_code" value="USD" >
          <input type="hidden" name="return" value="http://localhost/mainproject/order.php?c_id=<?php echo $customer_id;?>">
           <input type="hidden" name="cancel_return" value="http://localhost/mainproject/index.php">

           <?php
          $i=0;
          $ip_add =getRealIpUser();
          $get_cart ="SELECT * FROM CART WHERE IP_ADD='$ip_add'";
          $run_cart=oci_parse($con, $get_cart);
          oci_execute($run_cart);
           while ( $row_cart =oci_fetch_array($run_cart)) {

           $pro_id =$row_cart['CART_ID'];
           $pro_qty =$row_cart['CART_QUANTITY'];


           $get_products="SELECT * FROM PRODUCT WHERE PRODUCT_ID='$pro_id'";
           $run_products=oci_parse($con, $get_products);
           oci_execute($run_products);
           $row_products =oci_fetch_array($run_products);

           $product_title =$row_products['PRODUCT_TITLE'];
           $pro_price=$row_products['PRODUCT_PRICE'];

           $i++;
           ?>

           <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $product_title; ?>">

               <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $i;?>">


               <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $pro_price;?>">


               <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $pro_qty; ?>">

<?php

}
?>
<input type="image" name="submit" width="250" height="80" src="images/submit.png">


        </form>

    </center>



</div>