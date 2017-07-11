<?php
	$db = new PDO('sqlite:db/Inventory.db');
	
	$AllNULLStatus = $db->query("SELECT ID, AssignedTo, SerialNumber FROM computers WHERE Status = NULL OR Status = ''");
	$NULLcount = 0;
	
	print "<div class='container'>";
	
	foreach( $AllNULLStatus as $nullstatus ){
		if( is_numeric($nullstatus['AssignedTo']) and ($nullstatus['AssignedTo'] != "Open") ){
			print $nullstatus['SerialNumber']."<br>";
			$NULLcount++;
		}
	}
	print "Total: ".$NULLcount;
	
	print "</div>";
	#header("Location: ../../index.php?page=hardware/allcomputers");
	$db = NULL;
?>