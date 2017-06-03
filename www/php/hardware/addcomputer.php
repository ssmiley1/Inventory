<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<?php
	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	if(!$db){
	  echo $db->lastErrorMsg();
	} else {

	$allcomputerexisting = $db->query("SELECT AssetTag,SerialNumber FROM computers");
	
	}
?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add New Computer</h4>
</div>
	<div class="modal-body">

	<form id="userForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label">Make</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="Make"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Model</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="Model" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Serial Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="SerialNumber" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Type</label>
			<div class="col-xs-5">
				<select class="form-control">
				<option selected>Choose Type...</option>
				<option>Desktop</option>
				<option>Laptop</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Asset Tag</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="AssetTag" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Ethernet MAC</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="EthernetMAC" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">WiFi MAC</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="WiFiMAC" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Price</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="PurchasePrice" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="PurchaseDate" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Assigned To</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="AssignedTo" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Status</label>
			<div class="col-xs-5">
				<select class="form-control">
				<option selected>Choose Status...</option>
				<option>Available</option>
				<option>New in box</option>
				<option>Damaged</option>
				<option>To recycle</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Notes</label>
			<div class="col-xs-5">
				<textarea class="form-control" rows="5" id="Notes" style="resize:none"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</div>
	</form>
	
<?php

	if (isset($_POST['AssetTag'])){
		$AssetTag = $_POST['AssetTag'];
	
		foreach($allcomputerexisting as $check){
			if ($check['AssetTag'] == $AssetTag){
				$exists = 1;
				break;
			}
		}
		
		if ($exists == 1){
			print $AssetTag." exists.";
		} else {
			print $AssetTag." does not exist.";
		}
	}
?>