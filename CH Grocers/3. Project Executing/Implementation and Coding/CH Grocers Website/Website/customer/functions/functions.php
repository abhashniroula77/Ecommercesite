<?php

$db = oci_connect('c7190018','9841288889','//localhost/xe');


/// begin getRealIpUser functions ///

function getRealIpUser(){

    switch(true){

            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

            default : return $_SERVER['REMOTE_ADDR'];

    }

}

/// finish getRealIpUser functions ///

/// begin add_cart functions ///


function add_cart(){

    global $db;

    if(isset($_GET['add_cart'])){

        $ip_add = getRealIpUser();

        $p_id = $_GET['add_cart'];

        $product_qty = $_POST['product_qty'];

        

        $check_product = "select * from cart where CART_ID='$p_id' and IP_ADD='$ip_add";

        $run_check = oci_parse($db,$check_product);

        oci_execute($run_check);


        if(oci_num_rows($run_check)>0){

            echo "<script>alert('This product has already added in cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        }else{

            $query = "insert into cart (CART_ID,CART_QUANTITY,IP_ADD) values ('$p_id','$product_qty','$ip_add')";

            $run_query = oci_parse($db,$query);

            oci_execute($run_query);

            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        }

    }

}
/// finish add_cart functions ///

/// begin getPro functions ///

function getPro(){

    global $db;

    $get_products = "select * from product where rownum <=8 order by 1 DESC";

    $run_products = oci_parse($db,$get_products);
     oci_execute($run_products);

    while($row_products=oci_fetch_array($run_products)){

        $pro_id = $row_products['PRODUCT_ID'];

        $pro_title = $row_products['PRODUCT_TITLE'];

        $pro_price = $row_products['PRODUCT_PRICE'];

        $pro_img1 = $row_products['PRODUCT_IMG1'];

        echo "

        <div class='col-md-4 col-sm-6 single'>

            <div class='product'>

                <a href='details.php?pro_id=$pro_id'>

                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>

                </a>

                <div class='text'>

                    <h3>

                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>

                    </h3>

                    <p class='price'>

                        $ $pro_price

                    </p>

                    <p class='button'>

                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>

                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>

                    </p>

                </div>

            </div>

        </div>

        ";

    }

}

/// finish getPro functions ///

/// begin getPCats functions ///

function getPCats(){

    global $db;

    $get_p_cats = "select * from categories";

    $run_p_cats = oci_parse($db,$get_p_cats);
    oci_execute($run_p_cats);

    while($row_p_cats=oci_fetch_array($run_p_cats)){

        $p_cat_id = $row_p_cats['CATEGORY_ID'];

        $p_cat_title = $row_p_cats['CATEGORY_NAME'];

        echo "

            <li>

                <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>

            </li>

        ";

    }

}

/// finish getPCats functions ///

/// begin getCats functions ///

/*function getCats(){

    global $db;

    $get_cats = "select * from categories";

    $run_cats = mysqli_query($db,$get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){

        $cat_id = $row_cats['CAT_ID'];

        $cat_title = $row_cats['cat_title'];

        echo "

            <li>

                <a href='shop.php?cat=$cat_id'> $cat_title </a>

            </li>

        ";

    }

}*/

/// finish getCats functions ///

/// begin getpcatpro functions ///

function getpcatpro(){

    global $db;

    if(isset($_GET['p_cat'])){

        $p_cat_id = $_GET['p_cat'];

        $get_p_cat ="select * from categories where CATEGORY_ID='$p_cat_id'";

        $run_p_cat = oci_parse($db,$get_p_cat);

        oci_execute($run_p_cat);

        $row_p_cat = oci_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['CATEGORY_NAME'];

        $p_cat_desc = $row_p_cat['CATEGORY_DESC'];

        $get_products ="select * from product where CATEGORY_ID='$p_cat_id'";

        $run_products = oci_parse($db,$get_products);

        oci_execute($run_products);

        $count = oci_fetch($run_products);

        

        if($count==0){

            echo "

                <div class='box'>

                    <h1> No Product Found In This Product Categories </h1>

                </div>

            ";

        }else{

            echo "

                <div class='box'>

                    <h1> $p_cat_title </h1>

                    <p> $p_cat_desc </p>

                </div>

            ";

        }

        while($row_products=oci_fetch_array($run_products)){

            $pro_id = $row_products['PRODUCT_ID'];

            $pro_title = $row_products['PRODUCT_TITLE'];

            $pro_price = $row_products['PRODUCT_PRICE'];

            $pro_img1 = $row_products['PRODUCT_IMG1'];

            echo "

                <div class='col-md-4 col-sm-6 center-responsive'>

            <div class='product'>

                <a href='details.php?pro_id=$pro_id'>

                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>

                </a>

                <div class='text'>

                    <h3>

                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>

                    </h3>

                    <p class='price'>

                        $ $pro_price

                    </p>

                    <p class='button'>

                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>

                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>

                    </p>

                </div>

            </div>

        </div>

            ";

        }

    }

}

/// finish getpcatpro functions ///

/// begin getcatpro functions ///
/*
function getcatpro(){

    global $db;

    if(isset($_GET['cat'])){

        $cat_id = $_GET['cat'];

        $get_cat = "select * from categories where cat_id='$cat_id'";

        $run_cat = mysqli_query($db,$get_cat);

        $row_cat = mysqli_fetch_array($run_cat);

        $cat_title = $row_cat['cat_title'];

        $cat_desc = $row_cat['cat_desc'];

        $get_cat = "select * from products where cat_id='$cat_id' LIMIT 0,6";

        $run_products = mysqli_query($db,$get_cat);

        $count = mysqli_num_rows($run_products);

        if($count==0){


            echo "

                <div class='box'>

                    <h1> No Product Found In This Category </h1>

                </div>

            ";

        }else{

            echo "

                <div class='box'>

                    <h1> $cat_title </h1>

                    <p> $cat_desc </p>

                </div>

            ";

        }

        while($row_products=mysqli_fetch_array($run_products)){

            $pro_id = $row_products['product_id'];

            $pro_title = $row_products['product_title'];

            $pro_price = $row_products['product_price'];

            $pro_desc = $row_products['product_desc'];

            $pro_img1 = $row_products['product_img1'];

            echo "

                <div class='col-md-4 col-sm-6 center-responsive'>

                    <div class='product'>

                        <a href='details.php?pro_id=$pro_id'>

                            <img class='img-responsive' src='admin_area/product_images/$pro_img1'>

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

}*/

/// finish getcatpro functions ///

/// finish getRealIpUser functions ///

function items(){

    global $db;

    $ip_add = getRealIpUser();

    $get_items = "select * from cart where IP_ADD='$ip_add'";

    $run_items = oci_parse($db,$get_items);

    oci_execute($run_items);

    $li = oci_parse($db, "SELECT count(*) FROM CART");
                        oci_execute($li);
                        $row=oci_fetch_array($li);
                        $count=$row[0];

                          echo $count;

}

/// finish getRealIpUser functions ///

/// begin total_price functions ///

function total_price(){

    global $db;

    $ip_add = getRealIpUser();

    $total = 0;

    $select_cart = "select * from cart where IP_ADD='$ip_add'";

    $run_cart = oci_parse($db,$select_cart);

    oci_execute($run_cart);

    while($record=oci_fetch_array($run_cart)){

        $pro_id = $record['CART_ID'];

        $pro_qty = $record['CART_QUANTITY'];

        $get_price = "select * from product where PRODUCT_ID='$pro_id'";

        $run_price = oci_parse($db,$get_price);

        oci_execute($run_price);

        while($row_price=oci_fetch_array($run_price)){

            $sub_total = $row_price['PRODUCT_PRICE']*$pro_qty;

            $total += $sub_total;

        }

    }

    echo "$" . $total;

}

/// finish total_price functions ///

?>
