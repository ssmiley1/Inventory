<?php

#header('Content-type: application/json');

$db = new PDO('sqlite:../../db/Inventory.db');

if( isset($_POST['AssetTag']) ){

	#$AssetTag = "1111"; // For testing
	$AssetTag = $_POST['AssetTag'];
	
	// Chop the asset tag down to 4 digits. Ignore leading 0's if asset tag is scanned.
	if( strlen($AssetTag) > 4){
		$AssetTag = substr($AssetTag, -4);
	}
	
	$exists = $db->query("SELECT AssetTag FROM computers WHERE AssetTag = '$AssetTag'");
	
	$isvalid = true; // Assume we can use the asset tag
	
	foreach( $exists as $found ){
		$isvalid = false; // We cannot use an existing asset tag
	}
	
	echo json_encode($isvalid);
}

if( isset($_POST['SerialNumber']) ){

	$SerialNumber = $_POST['SerialNumber'];
	
	$exists = $db->query("SELECT SerialNumber FROM computers WHERE SerialNumber = '$SerialNumber'");
	
	$isvalid = true; // Assume we don't have this serial number until we find it
	
	foreach( $exists as $found ){
		$isvalid = false;
	}
	
	echo json_encode($isvalid);
}

?>