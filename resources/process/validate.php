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
	
	$exists = $db->query("SELECT AssetTag FROM '$Table' WHERE AssetTag = '$AssetTag'");
	
	$isvalid = true; // Assume we can use the asset tag
	
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing asset tag
	}
	
	echo json_encode($isvalid);
}

if( isset($_POST['SerialNumber']) ){

	$SerialNumber = $_POST['SerialNumber']; // The serial number to look for
	$Table = $_POST['Table']; // Which sqlite database table to look in
	
	$exists = $db->query("SELECT SerialNumber FROM '$Table' WHERE SerialNumber = '$SerialNumber'");
	
	$isvalid = true; // Assume we don't have this serial number until we find it
	
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing serial number
	}
	
	echo json_encode($isvalid);
}


?>