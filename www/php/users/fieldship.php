<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$UserID = $_GET['ID'];
	$FieldUserID = "field".$UserID;
	
	$ShippingInfo = $db->query("SELECT FirstName, LastName, FieldType, FieldNumber, CellPhoneNumber, StreetAddress, City, State, ZipCode FROM field WHERE ID = '$UserID'");
	$AssignedPhoneNumber = $db->query("SELECT PhoneNumber FROM mobile WHERE AssignedTo = '$FieldUserID'");

	foreach( $ShippingInfo as $info ){
		$FullFieldName = $info['FieldType'].$info['FieldNumber'];
		$FirstName = $info['FirstName'];
		$LastName = $info['LastName'];
		$StreetAddress = $info['StreetAddress'];
		$City = $info['City'];
		$State = $info['State'];
		$ZipCode = $info['ZipCode'];
		$CellPhoneNumberInFieldTable = $info['CellPhoneNumber'];
	}
	
	# Make the cell phone number the phone number of the device that is assigned to them if exists
	foreach( $AssignedPhoneNumber as $number ){
		$CellPhoneNumber = $number['PhoneNumber'];
	}
	
	# Else use the cell phone number that is in the field user table
	if( $CellPhoneNumber == NULL ){
		$CellPhoneNumber = $CellPhoneNumberInFieldTable;
	}
	
?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Shipping form for <?php echo $FullFieldName; ?></h4>
</div>
	<div class="modal-body">
		 	<div class="row">
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Requested By</span>
  						<input type="text" class="form-control" required placeholder="Requester Name" id="RequestedBy" name="RequestedBy" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-2">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Dept</span>
  						<input type="text" class="form-control" value="TSS" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-3">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Extension</span>
  						<input type="text" class="form-control" value="*7700" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-3">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Date</span>
  						<input type="text" class="form-control" value="<?php echo date("m-d-Y") ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Send To</span>
  						<input type="text" class="form-control" value="<?php echo $FullFieldName; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">ATTN</span>
  						<input type="text" class="form-control" value="<?php echo $FirstName." ".$LastName; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Phone #</span>
  						<input type="text" class="form-control" value="<?php echo $CellPhoneNumber; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="col-sm-12">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Street</span>
  						<input type="text" class="form-control" value="<?php echo $StreetAddress; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="col-sm-5">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">City</span>
  						<input type="text" class="form-control" value="<?php echo $City; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-5">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">State</span>
  						<input type="text" class="form-control" value="<?php echo $State; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-2">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Zip</span>
  						<input type="text" class="form-control" value="<?php echo $ZipCode; ?>" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Insured</span>
  						<span class="input-group-addon"><input type="checkbox" id="InsuranceCheckbox" name="InsuranceCheckbox"/></span>
  						<input type="text" class="form-control" value="" id="insurance" name="insurance" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Shipping</span>
							<select select class="form-control" name="Shipping" id="Shipping">
								<option selected value="Standard Overnight">Standard Overnight</option>
								<option value="Priority Overnight">Priority Overnight</option>
								<option value="Standard 2nd Day">Standard 2nd Day</option>
							</select>
					</div>
		 		</div>
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Signature</span>
  						<input type="text" class="form-control" value="Yes" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 		<div class="col-sm-4">
		 			<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Tracking</span>
  						<input type="text" class="form-control" value="Yes" aria-describedby="basic-addon1">
					</div>
		 		</div>
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="form-group">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-success pull-right" name="PrintButton" onclick="printDiv('shippingmodal')">Print</button>
					</div>
				</div>
		 	</div>
	</div>
	

	
	
	
	
	
	
	
	
	