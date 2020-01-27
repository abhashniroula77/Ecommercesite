<center><!--  center Begin  -->

    <h1> My Orders </h1>

    <p class="lead"> Your orders on one place</p>

    <p class="text-muted">

        If you have any questions, do not hesitate to <a href="../contact.php">Contact Us</a>.

    </p>

</center><!--  center Finish  -->


<hr>


<div class="table-responsive"><!--  table-responsive Begin  -->

    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->

        <thead><!--  thead Begin  -->

            <tr><!--  tr Begin  -->

                <th> Order No </th>
                <th> Product Price</th>
                <th> Invoice No</th>
                <th> Quantity </th>
                <th> Order Date</th>
                <th> Status </th>
                <th> Product ID </th>
                <th> View Invoice </th>
                <th> Send Invoice </th>


            </tr><!--  tr Finish  -->

        </thead><!--  thead Finish  -->

        <tbody><!--  tbody Begin  -->



           <?php

            $customer_session = $_SESSION['CUSTOMER_EMAIL'];

            $get_customer = "select * from CUSTOMER where CUSTOMER_EMAIL='$customer_session'";


            $run_customer = oci_parse($con,$get_customer);

            oci_execute($run_customer);

            $row_customer = oci_fetch_array($run_customer);

            $customer_id = $row_customer['CUSTOMER_ID'];

            $get_orders = "select * from CUSTOMER_ORDER where CUSTOMER_ID=$customer_id";


            $run_orders = oci_parse($con,$get_orders);

            oci_execute($run_orders);






            $i = 1;

             while ($row_all =oci_fetch_array($run_orders)){


                $order_id = $row_all['ORDER_ID'];
                $order_date = $row_all['ORDER_DATE'];
                $order_status = $row_all['ORDER_STATUS'];
                $order_invoice = $row_all['ORDER_INVOICE'];
                $order_amount = $row_all['ORDER_AMOUNT'];
                $order_quantity = $row_all['QTY'];
                $orderi = $row_all['PRODUCT_ID'];




                ?>



            <tr><!--  tr Begin  -->

                <td> <?php echo $i++; ?> </td>
                <td> <?php echo $order_amount; ?> </td>
                <td> <?php echo $order_invoice; ?> </td>
                <td> <?php echo $order_quantity; ?> </td>
                <td> <?php echo $order_date; ?> </td>
                <td> <?php echo $order_status; ?> </td>
                 <td> <?php echo $orderi; ?> </td>
                 <td><a href="invoice.php?invoice_no=<?php echo $order_invoice;?>" class="btn btn-info btn-md" target="_blank">View Invoice</a>
                 </td>

                 <td><a href="sendmail.php?invoice_no=<?php echo $order_invoice;?>" class="btn btn-info btn-md">Mail Invoice</a>
                 </td>





                </tr><!--  tr Finish  -->

 <?php
                        }

            ?>




        </tbody><!--  tbody Finish  -->

    </table><!--  table table-bordered table-hover Finish  -->


</div><!--  table-responsive Finish  -->