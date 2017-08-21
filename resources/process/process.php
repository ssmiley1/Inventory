<?php

function Sanitize($ToClean){
	$ToClean = trim($ToClean);
	$ToClean = htmlspecialchars($ToClean);
	$ToClean = strip_tags($ToClean);
	
	return $ToClean;
}

//open the database
$db = new PDO('sqlite:../../db/Inventory.db');

if( isset($_POST['DeleteUser']) ) {

	$UserToDelete = $_POST['DeleteUser'];
	$db->exec("DELETE FROM users WHERE ID = '$UserToDelete'");
	
	$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = 'Open', Status = 'Available' WHERE AssignedTo = '$UserToDelete'");
	$db->exec("UPDATE OR REPLACE computers SET AssignedTo = 'Open', Status = 'Available' WHERE AssignedTo = '$UserToDelete'");
	$db->exec("UPDATE OR REPLACE accessories SET AssignedTo = 'Open', Status = 'Available' WHERE AssignedTo = '$UserToDelete'");
	$db->exec("UPDATE OR REPLACE software SET AssignedTo = 'Open', Status = 'Available' WHERE AssignedTo = '$UserToDelete'");

	header("Location: ../../index.php?page=users/allusershe");
	$db = NULL;
	
}

if( isset($_POST['AddUser']) ) {
	
	$FirstName = ucfirst($_POST['FirstName']);
	$LastName = ucfirst($_POST['LastName']);
	$ADAccount = strtolower($_POST['ADAccount']);
	$Email = $_POST['Email'];
	$DeskPhone = $_POST['DeskPhone'];
	$StartDate = $_POST['StartDate'];
	$Department = $_POST['Department'];
	$Position = $_POST['Position'];
	$Notes = $_POST['Notes'];
	
	$db->exec("INSERT INTO users (FirstName, LastName, ADAccount, Email, DeskPhone, StartDate, Department, Position, Notes) VALUES ('$FirstName', '$LastName', '$ADAccount', '$Email', '$DeskPhone', '$StartDate', '$Department', '$Position', '$Notes');");

	header("Location: ../../index.php?page=users/allusershe");
	$db = NULL;
	
}

if( isset($_POST['UpdateUser']) ) {
	
	$ID = $_POST['UpdateUser'];
	$FirstName = ucfirst($_POST['FirstName']);
	$LastName = ucfirst($_POST['LastName']);
	$ADAccount = strtolower($_POST['ADAccount']);
	$Email = $_POST['Email'];
	$DeskPhone = $_POST['DeskPhone'];
	$StartDate = $_POST['StartDate'];
	$Department = $_POST['Department'];
	$Position = $_POST['Position'];
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE users SET FirstName = '$FirstName', LastName = '$LastName', ADAccount = '$ADAccount', Email = '$Email', DeskPhone = '$DeskPhone', StartDate = '$StartDate', Department = '$Department', Position = '$Position', Notes = '$Notes' WHERE ID = '$ID'");

	header("Location: ../../index.php?page=users/allusershe");
	$db = NULL;
	
}

if( isset($_POST['DeleteField']) ) {

	$FieldUserToDelete = $_POST['DeleteField'];
	$db->exec("DELETE FROM field WHERE ID = '$FieldUserToDelete'");
	
	$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = 'Open', Status = 'Available' WHERE AssignedTo = 'field$FieldUserToDelete'");
	$db->exec("UPDATE OR REPLACE computers SET AssignedTo = 'Open', Status = 'Available' WHERE AssignedTo = 'field$FieldUserToDelete'");

	header("Location: ../../index.php?page=users/allusersfield");
	$db = NULL;
	
}

if( isset($_POST['AddField']) ) {
	
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$FieldType = $_POST['FieldType'];
	$FieldNumber = $_POST['FieldNumber'];
	$DistrictName = $_POST['DistrictName'];
	$HomeStoreNumber = $_POST['HomeStoreNumber'];
	$StreetAddress = $_POST['StreetAddress'];
	$City = $_POST['City'];
	$State = $_POST['State'];
	$ZipCode = $_POST['ZipCode'];
	$Notes = $_POST['Notes'];
	
	$db->exec("INSERT INTO field (FirstName, LastName, FieldType, FieldNumber, DistrictName, HomeStoreNumber, StreetAddress, City, State, ZipCode, Notes) VALUES ('$FirstName', '$LastName', '$FieldType', '$FieldNumber', '$DistrictName', '$HomeStoreNumber', '$StreetAddress', '$City', '$State', '$ZipCode', '$Notes');");

	header("Location: ../../index.php?page=users/allusersfield");
	$db = NULL;
	
}

if( isset($_POST['UpdateField']) ) {
	
	$ID = $_POST['UpdateField'];
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	
	if( isset($_POST['FieldType'])){
    	$FieldType = $_POST['FieldType'];
    	$db->exec("UPDATE OR REPLACE field SET FieldType = '$FieldType' WHERE ID = '$ID'");
	}
	
	$FieldNumber = $_POST['FieldNumber'];
	$DistrictName = $_POST['DistrictName'];
	$HomeStoreNumber = $_POST['HomeStoreNumber'];
	$CellPhoneNumber = $_POST['CellPhoneNumber'];
	$StreetAddress = $_POST['StreetAddress'];
	$City = $_POST['City'];
	
	if( isset($_POST['State'])){
    	$State = $_POST['State'];
    	$db->exec("UPDATE OR REPLACE field SET State = '$State' WHERE ID = '$ID'");
	}
	
	$ZipCode = $_POST['ZipCode'];
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE field SET FirstName = '$FirstName', LastName = '$LastName', FieldNumber = '$FieldNumber', FirstName = '$FirstName', DistrictName = '$DistrictName', HomeStoreNumber = '$HomeStoreNumber', CellPhoneNumber = '$CellPhoneNumber', StreetAddress = '$StreetAddress', City = '$City', ZipCode = '$ZipCode', Notes = '$Notes' WHERE ID = '$ID'");

	header("Location: ../../index.php?page=users/allusersfield");
	$db = NULL;
	
}

if( isset($_POST['DeleteMobile']) ) {

	$MobileToDelete = $_POST['DeleteMobile'];
	$db->exec("DELETE FROM mobile WHERE ID = '$MobileToDelete'");

	header("Location: ../../index.php?page=hardware/allmobile");
	$db = NULL;
	
}

if( isset($_POST['AddMobile']) ) {

	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$IMEI = $_POST['IMEI'];
	$ICCID = $_POST['ICCID'];
	$Carrier = $_POST['Carrier'];
	$PhoneNumber = $_POST['PhoneNumber'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	
	if( isset($_POST['AssignedToID']) ){
		$AssignedTo = $_POST['AssignedToID'];
		$Status = "Assigned";
	} else {
		$AssignedTo = "Open";
		$Status = $_POST['Status'];
	}
	
	$Notes = $_POST['Notes'];

	$db->exec("INSERT INTO mobile (Make, Model, SerialNumber, IMEI, ICCID, Carrier, PhoneNumber, PurchaseDate, PurchasePrice, AssignedTo, Status, Notes) VALUES ('$Make', '$Model', '$SerialNumber', '$IMEI', '$ICCID', '$Carrier', '$PhoneNumber', '$PurchaseDate', '$PurchasePrice', '$AssignedTo', '$Status', '$Notes');");
	
	header("Location: ../../index.php?page=hardware/allmobile");
	$db = NULL;

}

if( isset($_POST['UpdateMobile']) ) {
	
	$ID = $_POST['UpdateMobile'];
	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$AssetTag = $_POST['AssetTag'];
	$IMEI = $_POST['IMEI'];
	$ICCID = $_POST['ICCID'];
	$PhoneNumber = $_POST['PhoneNumber'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	$Status = $_POST['Status'];
	$Notes = $_POST['Notes'];
	$AssignedTo = $_POST['AssignedToID'];
	
	if(trim($_POST['Carrier']) !== ""){
    	$Carrier = $_POST['Carrier'];
    	$db->exec("UPDATE OR REPLACE mobile SET Carrier = '$Carrier' WHERE ID = '$ID'");
	}
	
	if( isset($AssignedTo) ){
		$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}
	
	if( isset($Status) ){
		$db->exec("UPDATE OR REPLACE mobile SET Status = '$Status' WHERE ID = '$ID'");
	}
	
	
	
	$db->exec("UPDATE OR REPLACE mobile SET Make = '$Make', Model = '$Model', SerialNumber = '$SerialNumber', AssetTag = '$AssetTag', IMEI = '$IMEI', ICCID = '$ICCID', PhoneNumber = '$PhoneNumber', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice', Notes = '$Notes' WHERE ID = '$ID'");
	
	header("Location: ../../index.php?page=hardware/allmobile");
	$db = NULL;
	
}

if( isset($_POST['DeleteComputer']) ) {

	$ComputerToDelete = $_POST['DeleteComputer'];
	$db->exec("Delete FROM computers WHERE ID = '$ComputerToDelete'");
	
	header("Location: ../../index.php?page=hardware/allcomputers");
	$db = NULL;
}

if( isset($_POST['AddComputer']) ) {

	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$Type = $_POST['Type'];
	$AssetTag = $_POST['AssetTag'];
	$EthernetMAC = $_POST['EthernetMAC'];
	$WiFiMAC = $_POST['WiFiMAC'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	
	if( isset($_POST['AssignedToID']) ){
		$AssignedTo = $_POST['AssignedToID'];
	} else {
		$AssignedTo = "Open";
	}
	
	$Status = $_POST['Status'];
	$Notes = $_POST['Notes'];

	$db->exec("INSERT INTO computers (Make, Model, SerialNumber, Type, AssetTag, EthernetMAC, WiFiMAC, PurchaseDate, PurchasePrice, AssignedTo, Status, Notes) VALUES ('$Make', '$Model', '$SerialNumber', '$Type', '$AssetTag', '$EthernetMAC', '$WiFiMAC', '$PurchaseDate', '$PurchasePrice', '$AssignedTo', '$Status', '$Notes');");
		
	header("Location: ../../index.php?page=hardware/allcomputers");
	$db = NULL;
	
}

if( isset($_POST['UpdateComputer']) ) {
	
	$ID = $_POST['UpdateComputer'];
	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	
	if( isset($_POST['Type']) ){
		$Type = $_POST['Type'];
		$db->exec("UPDATE OR REPLACE computers SET Type = '$Type' WHERE ID = '$ID'");
	}
	
	$AssetTag = $_POST['AssetTag'];
	$EthernetMAC = $_POST['EthernetMAC'];
	$WiFiMAC = $_POST['WiFiMAC'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	$AssignedTo = $_POST['AssignedToID'];
	$Status = $_POST['Status'];
	$Notes = $_POST['Notes'];
	
	if( isset($AssignedTo) ){
		$db->exec("UPDATE OR REPLACE computers SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}
	
	if( isset($Status) ){
		$db->exec("UPDATE OR REPLACE computers SET Status = '$Status' WHERE ID = '$ID'");
	}
		
	
	$db->exec("UPDATE OR REPLACE computers SET Make = '$Make', Model = '$Model', SerialNumber = '$SerialNumber', AssetTag = '$AssetTag', EthernetMAC = '$EthernetMAC', WiFiMAC = '$WiFiMAC', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice', Notes = '$Notes' WHERE ID = '$ID'");
	
	header("Location: ../../index.php?page=hardware/allcomputers");
	$db = NULL;
	
}

if( isset($_POST['UpdateStore']) ) {
	
	$ID = $_POST['UpdateStore'];
	$StoreNumber = $_POST['StoreNumber'];
	$PhoneNumber = $_POST['PhoneNumber'];
	$DSM = $_POST['DSM'];
	$Div = $_POST['Div'];
	$Mall = $_POST['Mall'];
	$Address = $_POST['Address'];
	$City = $_POST['City'];
	$State = $_POST['State'];
	$Zip = $_POST['Zip'];
	$Country = $_POST['Country'];
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE stores SET StoreNumber = '$StoreNumber', PhoneNumber = '$PhoneNumber', DSM = '$DSM', Div = '$Div', Mall = '$Mall', Address = '$Address', City = '$City', State = '$State', Zip = '$Zip', Country = '$Country', Notes = '$Notes' WHERE ID = '$ID'");

	header("Location: ../index.php");
	$db = NULL;
	
}

if( isset($_POST['AddPrinter']) ){

	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$PrinterName = $_POST['PrinterName'];
	$Location = $_POST['Location'];
	$IPAddress = $_POST['IPAddress'];
	$MACAddress = $_POST['MACAddress'];
	$Notes = $_POST['Notes'];
	
	$db->exec("INSERT INTO printers (Make, Model, SerialNumber, PrinterName, Location, IPAddress, MACAddress, Notes) VALUES ('$Make', '$Model', '$SerialNumber', '$PrinterName', '$Location', '$IPAddress', '$MACAddress', '$Notes');");
	
	header("Location: ../../index.php?page=hardware/allprinters");
	$db = NULL;
	
}

if( isset($_POST['DeletePrinter']) ) {
	$PrinterToDelete = $_POST['DeletePrinter'];
	$db->exec("Delete FROM printers WHERE ID = '$PrinterToDelete'");
	
	header("Location: ../../index.php?page=hardware/allprinters");
	$db = NULL;
}

if( isset($_POST['AddAccessory']) ) {

	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$AssetTag = $_POST['AssetTag'];
	$Description = $_POST['Description'];
	$EthernetMAC = $_POST['EthernetMAC'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	
	if( isset($_POST['AssignedToID']) ){
		$AssignedTo = $_POST['AssignedToID'];
	} else {
		$AssignedTo = "Open";
	}
	
	$Status = $_POST['Status'];
	$Notes = $_POST['Notes'];

	$db->exec("INSERT INTO accessories (Make, Model, SerialNumber, AssetTag, Description, EthernetMAC, PurchaseDate, PurchasePrice, AssignedTo, Status, Notes) VALUES ('$Make', '$Model', '$SerialNumber', '$AssetTag', '$Description', '$EthernetMAC', '$PurchaseDate', '$PurchasePrice', '$AssignedTo', '$Status', '$Notes');");
	
	header("Location: ../../index.php?page=hardware/allaccessories");
	$db = NULL;

}

if( isset($_POST['UpdatePrinter']) ) {
	
	$ID = $_POST['UpdatePrinter'];
	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$PrinterName = $_POST['PrinterName'];
	$Location = $_POST['Location'];
	$IPAddress = $_POST['IPAddress'];
	$MACAddress = $_POST['MACAddress'];
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE printers SET Make = '$Make', Model = '$Model', SerialNumber = '$SerialNumber', PrinterName = '$PrinterName', Location = '$Location', IPAddress = '$IPAddress', MACAddress = '$MACAddress', Notes = '$Notes' WHERE ID = '$ID'");

	header("Location: ../../index.php?page=hardware/allprinters");
	$db = NULL;
	
}

if( isset($_POST['DeleteAccessory']) ) {

	$AccessoryToDelete = $_POST['DeleteAccessory'];
	$db->exec("Delete FROM accessories WHERE ID = '$AccessoryToDelete'");
	
	header("Location: ../../index.php?page=hardware/allaccessories");
	$db = NULL;
}

if( isset($_POST['UpdateAccessory']) ) {
	
	$ID = $_POST['UpdateAccessory'];
	$Make = $_POST['Make'];
	$Model = $_POST['Model'];
	$SerialNumber = $_POST['SerialNumber'];
	$AssetTag = $_POST['AssetTag'];
	$Description = $_POST['Description'];
	$EthernetMAC = $_POST['EthernetMAC'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	$Status = $_POST['Status'];
	
	if( isset($AssignedTo) ){
		if( is_numeric($AssignedTo) ){
			$Status = "Assigned";
		}elseif( $AssignedTo == "Open" ){
			if( $Status == "Assigned" ){
				$Status = "Available";
				}
			}
		$db->exec("UPDATE OR REPLACE accessories SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}
	
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE accessories SET Make = '$Make', Model = '$Model', SerialNumber = '$SerialNumber', AssetTag = '$AssetTag', Description = '$Description', EthernetMAC = '$EthernetMAC', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice', Status = '$Status', Notes = '$Notes' WHERE ID = '$ID'");
	
	header("Location: ../../index.php?page=hardware/allaccessories");
	$db = NULL;
	
}

if( isset($_POST['DeleteSoftware']) ) {

	$SoftwareToDelete = $_POST['DeleteSoftware'];
	$db->exec("Delete FROM software WHERE ID = '$SoftwareToDelete'");
	
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['AddSoftware']) ) {

	$SoftwareDeveloper = $_POST['SoftwareDeveloper'];
	$SoftwareName = $_POST['SoftwareName'];
	$Version = $_POST['Version'];
	$SerialKey = $_POST['SerialKey'];
	
	if( isset($_POST['LicenseType']) ){
		$LicenseType = $_POST['LicenseType'];
	} else {
		$LicenseType = "Full Version";
	}
	
	$DeviceLimit = $_POST['DeviceLimit'];
	$Category = $_POST['Category'];
	$WebSite = $_POST['WebSite'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	$ExpirationDate = $_POST['ExpirationDate'];
	$Vendor = $_POST['Vendor'];
	
	if( isset($_POST['AssignedTo']) ){
		$AssignedTo = $_POST['AssignedTo'];
	} else {
		$AssignedTo = "Open";
	}
	
	if( isset($_POST['Status']) ){
		$Status = $_POST['Status'];
	} else {
		$Status = "Available";
	}
	
	$Notes = $_POST['Notes'];

	$db->exec("INSERT INTO software (SoftwareDeveloper, SoftwareName, Version, SerialKey, LicenseType, DeviceLimit, Category, WebSite, PurchaseDate, PurchasePrice, ExpirationDate, Vendor, AssignedTo, Status, Notes) VALUES ('$SoftwareDeveloper', '$SoftwareName', '$Version', '$SerialKey', '$LicenseType', '$DeviceLimit', '$Category', '$WebSite', '$PurchaseDate', '$PurchasePrice', '$ExpirationDate', '$Vendor', '$AssignedTo', '$Status', '$Notes');");
	
	header("Location: ../../index.php?page=software/allsoftware");
	$db = NULL;

}

if( isset($_POST['UpdateSoftware']) ) {
	
	$ID = $_POST['UpdateSoftware'];
	$SoftwareDeveloper = $_POST['SoftwareDeveloper'];
	$SoftwareName = $_POST['SoftwareName'];
	$Version = $_POST['Version'];
	$SerialKey = $_POST['SerialKey'];
	
	if( isset($_POST['LicenseType']) ){
		$LicenseType = $_POST['LicenseType'];
		$db->exec("UPDATE OR REPLACE software SET LicenseType = '$LicenseType' WHERE ID = '$ID'");
	}
	
	$DeviceLimit = $_POST['DeviceLimit'];
	$Category = $_POST['Category'];
	$WebSite = $_POST['WebSite'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	$ExpirationDate = $_POST['ExpirationDate'];
	$Vendor = $_POST['Vendor'];
	
	$AssignedTo = $_POST['AssignedToID'];
	if( isset($AssignedTo) ){
		$db->exec("UPDATE OR REPLACE software SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}
	
	$Status = $_POST['Status'];
	if( isset($Status) ){
		$db->exec("UPDATE OR REPLACE software SET Status = '$Status' WHERE ID = '$ID'");
	}
	
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE software SET SoftwareDeveloper = '$SoftwareDeveloper', SoftwareName = '$SoftwareName', Version = '$Version', SerialKey = '$SerialKey', DeviceLimit = '$DeviceLimit', Category = '$Category', WebSite = '$WebSite', Vendor = '$Vendor', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice', Notes = '$Notes' WHERE ID = '$ID'");
	
	header("Location: ../../index.php?page=software/allsoftware");
	$db = NULL;
}

if( isset($_POST['AssignEquipment']) ){

	$AssetTags = array($_POST['AssetTag1'], $_POST['AssetTag2'], $_POST['AssetTag3'], $_POST['AssetTag4'], $_POST['AssetTag5']);
	$AssignTo = $_POST['AssignedToID'];
	
	foreach( $AssetTags as $AssetTag ){
		// Chop the asset tag down to 4 digits. Ignore leading 0's if asset tag is scanned.
		if( strlen($AssetTag) > 4){
			$AssetTag = substr($AssetTag, -4);
		}
		if( (isset($AssetTag)) and ($AssetTag != '') and ($AssetTag != NULL) ){
			$db->exec("UPDATE OR REPLACE computers SET AssignedTo = '$AssignTo' WHERE AssetTag = '$AssetTag'");
			$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = '$AssignTo' WHERE AssetTag = '$AssetTag'");
			$db->exec("UPDATE OR REPLACE accessories SET AssignedTo = '$AssignTo' WHERE AssetTag = '$AssetTag'");
		}
	}

	header("Location: ../../index.php?page=users/allusershe");
	$db = NULL;
}

if( isset($_POST['DeleteStore']) ) {
	
	
	header("Location: ../index.php");
	$db = NULL;
	
}

if( isset($_POST['AddStore']) ) {
	
	
	header("Location: ../index.php");
	$db = NULL;
	
}

if( isset($_POST['UpdateStore']) ) {
	
	
	header("Location: ../index.php");
	$db = NULL;
	
}


?>