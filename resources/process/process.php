<?php

//open the database
$db = new PDO('sqlite:../../db/Inventory.db');

if( isset($_POST['DeleteUser']) ) {

	$UserToDelete = $_POST['DeleteUser'];
	$db->exec("DELETE FROM users WHERE ID = '$UserToDelete'");
	
	$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = 'Open' WHERE AssignedTo = '$UserToDelete'");
	$db->exec("UPDATE OR REPLACE computers SET AssignedTo = 'Open' WHERE AssignedTo = '$UserToDelete'");
	$db->exec("UPDATE OR REPLACE accessories SET AssignedTo = 'Open' WHERE AssignedTo = '$UserToDelete'");
	$db->exec("UPDATE OR REPLACE software SET AssignedTo = 'Open' WHERE AssignedTo = '$UserToDelete'");

	header("Location: ../../index.php?page=users/allusershe");
	$db = NULL;
	
}

if( isset($_POST['AddUser']) ) {
	
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$ADAccount = $_POST['ADAccount'];
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
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$ADAccount = $_POST['ADAccount'];
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
	
	$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = 'Open' WHERE AssignedTo = 'field$FieldUserToDelete'");
	$db->exec("UPDATE OR REPLACE computers SET AssignedTo = 'Open' WHERE AssignedTo = 'field$FieldUserToDelete'");

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
	
	if( isset($_POST['Notes'])){
    	$Notes = $_POST['Notes'];
    	$db->exec("UPDATE OR REPLACE field SET Notes = '$Notes' WHERE ID = '$ID'");
	}
	
	$db->exec("UPDATE OR REPLACE field SET FirstName = '$FirstName', LastName = '$LastName', FieldNumber = '$FieldNumber', FirstName = '$FirstName', DistrictName = '$DistrictName', HomeStoreNumber = '$HomeStoreNumber', CellPhoneNumber = '$CellPhoneNumber', StreetAddress = '$StreetAddress', City = '$City', ZipCode = '$ZipCode' WHERE ID = '$ID'");

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
	} else {
		$AssignedTo = "Open";
	}
	
	$Status = $_POST['Status'];
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
	
	if(trim($_POST['Carrier']) !== ""){
    	$Carrier = $_POST['Carrier'];
    	$db->exec("UPDATE OR REPLACE mobile SET Carrier = '$Carrier' WHERE ID = '$ID'");
	}
	
	$PhoneNumber = $_POST['PhoneNumber'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$PurchasePrice = $_POST['PurchasePrice'];
	
	if( isset($_POST['AssignedToID']) ){
    	$AssignedTo = $_POST['AssignedToID'];
    	$db->exec("UPDATE OR REPLACE mobile SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}
	
	if( isset($_POST['Status'])){
    	$Status = $_POST['Status'];
    	$db->exec("UPDATE OR REPLACE mobile SET Status = '$Status' WHERE ID = '$ID'");
	}
	
	if( isset($_POST['Notes'])){
    	$Notes = $_POST['Notes'];
    	$db->exec("UPDATE OR REPLACE mobile SET Notes = '$Notes' WHERE ID = '$ID'");
	}
	
	
	
	$db->exec("UPDATE OR REPLACE mobile SET Make = '$Make', Model = '$Model', SerialNumber = '$SerialNumber', AssetTag = '$AssetTag', IMEI = '$IMEI', ICCID = '$ICCID', PhoneNumber = '$PhoneNumber', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice' WHERE ID = '$ID'");
	
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
	
	if( isset($_POST['AssignedToID']) ){
		$AssignedTo = $_POST['AssignedToID'];
		$db->exec("UPDATE OR REPLACE computers SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}
	
	if( isset($_POST['Status']) ){
		$Status = $_POST['Status'];
		$db->exec("UPDATE OR REPLACE computers SET Status = '$Status' WHERE ID = '$ID'");
	}
	
	$Notes = $_POST['Notes'];
	
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

	header("Location: ../index.php");
	$db = NULL;
	
}

if( isset($_POST['DeleteAccessory']) ) {

	$AccessoryToDelete = $_POST['DeleteAccessory'];
	$db->exec("Delete FROM accessories WHERE ID = '$AccessoryToDelete'");
	
	header("Location: ../../index.php?page=hardware/allaccessories");
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
	
	if( isset($_POST['AssignedToID']) ){
		$AssignedTo = $_POST['AssignedToID'];
		$db->exec("UPDATE OR REPLACE accessories SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}

	if( isset($_POST['Status']) ){
		$Status = $_POST['Status'];
		$db->exec("UPDATE OR REPLACE accessories SET Status = '$Status' WHERE ID = '$ID'");
	}
	
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE accessories SET Make = '$Make', Model = '$Model', SerialNumber = '$SerialNumber', AssetTag = '$AssetTag', Description = '$Description', EthernetMAC = '$EthernetMAC', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice', Notes = '$Notes' WHERE ID = '$ID'");
	
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
		$AssignedTo = "Available";
	}
	
	if( isset($_POST['Status']) ){
		$Status = $_POST['Status'];
	} else {
		$Status = "Open";
	}
	
	$Notes = $_POST['Notes'];

	$db->exec("INSERT INTO software (SoftwareDeveloper, SoftwareName, Version, SerialKey, LicenseType, DeviceLimit, Category, WebSite, PurchaseDate, PurchasePrice, ExpirationDate, Vendor, AssignedTo, Status, Notes) VALUES ('$SoftwareDeveloper', '$SoftwareName', '$Version', '$SerialKey', '$LicenseType', '$DeviceLimit', '$Category', '$WebSite', '$PurchaseDate', '$PurchasePrice', '$ExpirationDate', '$Vendor', '$AssignedTo', '$Status', '$Notes');");
	
	header("Location: ../index.php");
	
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
	
	if( isset($_POST['AssignedToID']) ){
		$AssignedTo = $_POST['AssignedToID'];
		$db->exec("UPDATE OR REPLACE software SET AssignedTo = '$AssignedTo' WHERE ID = '$ID'");
	}

	if( isset($_POST['Status']) ){
		$Status = $_POST['Status'];
		$db->exec("UPDATE OR REPLACE software SET Status = '$Status' WHERE ID = '$ID'");
	}
	
	$Notes = $_POST['Notes'];
	
	$db->exec("UPDATE OR REPLACE software SET SoftwareDeveloper = '$SoftwareDeveloper', SoftwareName = '$SoftwareName', Version = '$Version', SerialKey = '$SerialKey', DeviceLimit = '$DeviceLimit', Category = '$Category', WebSite = '$WebSite', Vendor = '$Vendor', PurchaseDate = '$PurchaseDate', PurchasePrice = '$PurchasePrice', Notes = '$Notes' WHERE ID = '$ID'");
	
	header("Location: ../index.php");
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

if( isset($_POST['CancelUser']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelFieldUser']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelMobile']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelComputer']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelAccessory']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelSoftware']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelStore']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

if( isset($_POST['CancelPrinter']) ) {
	header("Location: ../index.php");
	$db = NULL;
}

?>