<?php
include("includes/db.php");

?>



<?php

if (isset($_GET['key'])) {
    # code...
		$st = "UPDATE TRADER SET STATUST = '1' WHERE TRADER_ID = (SELECT max(TRADER_ID) FROM TRADER) ";

		$qry = oci_parse($con, $st);
		oci_execute($qry);
		header("Location:index.php");

    }else{
    	echo "Fail! Please try again.";
    }

?>
