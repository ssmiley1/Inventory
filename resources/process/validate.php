<?php

#header('Content-type: application/json');

$db = new PDO('sqlite:../../db/Inventory.db');

if( isset($_POST['AssetTag']) ){

	$AssetTag = $_POST['AssetTag']; // The asset tag to look for
	$Table = $_POST['Table']; // Which sqlite database table to look in
	
	// Chop the asset tag down to 4 digits. Ignore leading 0's if asset tag is scanned.
	if( strlen($AssetTag) > 4){
		$AssetTag = substr($AssetTag, -4);
	}
	
	$isvalid = true; // Assume we can use the asset tag
	
	$exists = $db->query("SELECT AssetTag FROM computers WHERE AssetTag = '$AssetTag'");
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing asset tag
	}
	$exists = $db->query("SELECT AssetTag FROM mobile WHERE AssetTag = '$AssetTag'");
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing asset tag
	}
	$exists = $db->query("SELECT AssetTag FROM accessories WHERE AssetTag = '$AssetTag'");
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing asset tag
	}
	
	echo json_encode($isvalid);
}

if( isset($_POST['SerialNumber']) ){

	$SerialNumber = $_POST['SerialNumber']; // The serial number to look for
	$Table = $_POST['Table']; // Which sqlite database table to look in
	
	$isvalid = true; // Assume we can use the asset tag
	
	$exists = $db->query("SELECT SerialNumber FROM computers WHERE SerialNumber = '$SerialNumber'");
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing serial number
	}
	$exists = $db->query("SELECT SerialNumber FROM mobile WHERE SerialNumber = '$SerialNumber'");
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing serial number
	}
	$exists = $db->query("SELECT SerialNumber FROM accessories WHERE SerialNumber = '$SerialNumber'");
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing serial number
	}
	
	echo json_encode($isvalid);
}

if( isset($_POST['LastName']) ){
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$Table = $_POST['Table'];
	
	$isvalid = false;
	
	
	echo json_encode($isvalid);
}


?>