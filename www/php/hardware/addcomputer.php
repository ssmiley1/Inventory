<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<?php
	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	if(!$db){
	  echo $db->lastErrorMsg();
	} else {

	$allcomputerexisting = $db->query("SELECT AssetTag,SerialNumber FROM computers ORDER BY 'AssetTag' DESC");
	
	}
?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add New Computer</h4>
</div>
	<div class="modal-body">

	<form id="addForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label">Make</label>
			<div class="col-xs-5">
				<input type="text" class="form-control required" id="Make" name="Make"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Model</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Model" name="Model" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Serial Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SerialNumber" name="SerialNumber" />
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
				<input type="text" class="form-control" id="AssetTag" name="AssetTag" />
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
				<textarea class="form-control" rows="5" id="Notes" style="resize:none">
				<?php
					foreach($allcomputerexisting as $computer){
						if($computer['AssetTag'] != ""){
							echo $computer['AssetTag']."\n";
						} else {
							echo "None\n";
						}
					}
				
				?>
				</textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</div>
	</form>
	
<script type="text/javascript">
  $('#addForm').on('submit', function(e) {
    var make = $('#Make');
    var model = $('#Model');
    var serial = $('#SerialNumber');
    var asset = $('#AssetTag');

    // Check if there is an entered value
    if(!make.val()) {
		make.closest('.form-group').addClass('has-error');
		var error = 1;
    } else {
    	make.closest('.form-group').removeClass('has-error');
    }
    if(!model.val()) {
    	model.closest('.form-group').addClass('has-error');
		var error = 1;
    } else {
    	model.closest('.form-group').removeClass('has-error');
    }
    if(!serial.val()) {
    	serial.closest('.form-group').addClass('has-error');
		var error = 1;
    } else {
    	serial.closest('.form-group').removeClass('has-error');
    }
    if(!asset.val()) {
    	asset.closest('.form-group').addClass('has-error');
		var error = 1;
    } else {
    	asset.closest('.form-group').removeClass('has-error');
    }
    
    
    
    if(error==1){
    	// Stop submission of the form
      e.preventDefault();
    } else {
    	window.location = "index.php?page=hardware/allcomputers";
    }
  });
</script>