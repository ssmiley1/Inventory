<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" href="../../favicon.ico">

    	<title>Claire's Inventory</title>

   	 	<!-- Bootstrap core CSS -->
    	<link href="/www/css/bootstrap.min.css" rel="stylesheet">
    	<!-- <link href="/www/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    
	</head>
<body>

<?php
	$db = new PDO('sqlite:db/Inventory.db');

	$allcomputers = $db->query("SELECT ID FROM computers");
	$allmobile = $db->query("SELECT ID FROM mobile");
	$allaccessories = $db->query("SELECT ID FROM accessories");
	
	$availcomputers = $db->query("SELECT ID FROM computers WHERE AssignedTo == 'Open' AND Status != 'Damaged' AND Status != 'Lost/Stolen'");
	$availmobiles = $db->query("SELECT ID FROM mobile WHERE AssignedTo == 'Open' AND Status != 'Damaged' AND Status != 'Lost/Stolen'");
	$availaccessories = $db->query("SELECT ID FROM accessories WHERE AssignedTo == 'Open' AND Status != 'Damaged' AND Status != 'Lost/Stolen'");
	
	$damagedcomputers = $db->query("SELECT ID FROM computers WHERE Status = 'Damaged'");
	$damagedmobiles = $db->query("SELECT ID FROM mobile WHERE Status = 'Damaged'");
	$damagedaccessories = $db->query("SELECT ID FROM accessories WHERE Status = 'Damaged'");
	
	$computercount = 0;
	$mobilecount = 0;
	$accessorycount = 0;
	
	$availcomputercount = 0;
	$availmobilecount = 0;
	$availaccessorycount = 0;
	
	$damagedcomputercount = 0;
	$damagedmobilecount = 0;
	$damagedaccessorycount = 0;
	
	foreach($allcomputers as $computer){ $computercount++; }
	foreach($allmobile as $mobile){ $mobilecount++; }
	foreach($allaccessories as $accessory){ $accessorycount++; }
	
	foreach($availcomputers as $availcomputer){ $availcomputercount++; }
	foreach($availmobiles as $availmobile){ $availmobilecount++; }
	foreach($availaccessories as $availaccessory){ $availaccessorycount++; }
	
	foreach($damagedcomputers as $damagedcomputer){ $damagedcomputercount++; }
	foreach($damagedmobiles as $damagedmobile){ $damagedmobilecount++; }
	foreach($damagedaccessories as $damagedaccessory){ $damagedaccessorycount++; }
	
	$allheusers = $db->query("SELECT ID FROM users");
	$allfieldusers = $db->query("SELECT ID FROM field");
	
	$heusercount = 0;
	$fieldusercount = 0;
	
	foreach($allheusers as $heuser){ $heusercount++; }
	foreach($allfieldusers as $fielduser){ $fieldusercount++; }
?>


<div class="container">
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="panel panel-default" style="width:220px">
		<div class="panel-heading" style="text-align:center">Hardware Totals</div>
			<div class="panel-body" align="left">
				<div class="list-group">
				  <div class="list-group">
					<a href="index.php?page=hardware/allcomputers" class="list-group-item" id="allcomputers">Computers:<span class="badge badge-important pull-right"><?php print $computercount; ?></span></a>
					<a href="index.php?page=hardware/allmobile" class="list-group-item">Mobile:<span class="badge badge-important pull-right"><?php print $mobilecount; ?></span></a>
					<a href="index.php?page=hardware/allaccessories" class="list-group-item">Accessories:<span class="badge badge-important pull-right"><?php print $accessorycount; ?></span></a>
				</div>
				</div>
			</div>
		</div>
	</div> <!-- column -->
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="panel panel-default" style="width:220px">
		<div class="panel-heading" style="text-align:center">Hardware Available</div>
			<div class="panel-body" align="left">
				<div class="list-group">
					<a href="index.php?page=hardware/availcomputers" class="list-group-item">Computers:<span class="badge badge-important pull-right"><?php print $availcomputercount; ?></span></a>
					<a href="index.php?page=hardware/availmobile" class="list-group-item">Mobile:<span class="badge badge-important pull-right"><?php print $availmobilecount; ?></span></a>
					<a href="index.php?page=hardware/availaccessories" class="list-group-item">Accessories:<span class="badge badge-important pull-right"><?php print $availaccessorycount; ?></span></a>
				</div>
			</div>
		</div>
	</div> <!-- column -->
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="panel panel-default" style="width:220px">
		<div class="panel-heading" style="text-align:center">Hardware Damaged</div>
			<div class="panel-body" align="left">
				<div class="list-group">
				  	<a href="index.php?page=hardware/damagedcomputers" class="list-group-item">Computers:<span class="badge badge-important pull-right"><?php print $damagedcomputercount; ?></span></a>
					<a href="index.php?page=hardware/damagedmobile" class="list-group-item">Mobile:<span class="badge badge-important pull-right"><?php print $damagedmobilecount; ?></span></a>
					<a href="index.php?page=hardware/damagedaccessories" class="list-group-item">Accessories:<span class="badge badge-important pull-right"><?php print $damagedaccessorycount; ?></span></a>
				</div>
			</div>
		</div>
	</div> <!-- column -->
</div> <!-- row -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="panel panel-default" style="width:220px">
		<div class="panel-heading" style="text-align:center">User Totals</div>
			<div class="panel-body" align="left">
				<div class="list-group">
					<a href="index.php?page=users/allheusers" class="list-group-item">HE Users:<span class="badge badge-important pull-right"><?php print $heusercount; ?></span></a>
					<a href="index.php?page=users/allfieldusers" class="list-group-item">Field Users:<span class="badge badge-important pull-right"><?php print $fieldusercount; ?></span></a>
				</div>
			</div>
		</div>
	</div> <!-- column -->
</div> <!-- row -->
</div> <!-- container -->
</body>
</html>