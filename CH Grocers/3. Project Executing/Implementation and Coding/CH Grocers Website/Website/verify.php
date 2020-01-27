<?php
include("includes/db.php");

?>



<?php

if (isset($_GET['key'])) {
    # code...
		$st = "UPDATE CUSTOMER SET STATUS = '1' WHERE CUSTOMER_ID = (SELECT max(CUSTOMER_ID) FROM CUSTOMER) ";

		$qry = oci_parse($con, $st);
		oci_execute($qry);
		header("Location:index.php");

    }else{
    	echo "Fail! Please try again";
    }

?>