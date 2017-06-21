<?php

#header('Content-type: application/json');

$db = new PDO('sqlite:../../db/Inventory.db');

function Sanitize($ToClean){
	$ToClean = trim($ToClean);
	$ToClean = htmlspecialchars($ToClean);
	$ToClean = strip_tags($ToClean);
	
	return $ToClean;
}

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
	$FirstName = Sanitize(ucfirst($_POST['FirstName']));
	$LastName = Sanitize(ucfirst($_POST['LastName']));
	$Table = Sanitize($_POST['Table']);
	
	$isvalid = true; // Assume we are valid until proven otherwise
	
	$CheckLast = $db->query("SELECT LastName FROM users WHERE LastName = '$LastName'");
	foreach( $CheckLast as $LastFound ){
		$LastWasFound = true;
	}
	
	if( $LastWasFound == true ){
		$CheckFirst = $db->query("SELECT FirstName FROM users WHERE Lastname = '$LastName'");
		foreach( $CheckFirst as $FirstNamesFound ){
			if( $FirstNamesFound['FirstName'] == $FirstName ){
				$isvalid = false;
			}
		}
	}
	
	echo json_encode($isvalid);
}

if( isset($_POST['FieldNumber']) ){

	$FieldType = $_POST['FieldType'];
	$FieldNumber = $_POST['FieldNumber'];
	$isvalid = true;
	
	$CheckFieldNumber = $db->query("SELECT FieldNumber FROM field WHERE FieldNumber = '$FieldNumber'");
	foreach( $CheckFieldNumber as $NumberFound ){
		$NumberWasFound = true;
	}
	
	if( $NumberWasFound == true ){
		$CheckFieldType = $db->query("SELECT FieldType FROM field WHERE FieldNumber = '$FieldNumber'");
		foreach( $CheckFieldType as $FieldTypeFound ){
			if( $FieldTypeFound['FieldType'] == $FieldType ){
				$isvalid = false;
			}
		}
	}
	
	echo json_encode($isvalid);
}



?>









