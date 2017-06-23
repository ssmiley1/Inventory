<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$MobileIDToEdit = $_GET['ID'];
	$MobileToEdit = $db->query('SELECT * FROM mobile WHERE ID = '.$MobileIDToEdit);
	
	foreach($MobileToEdit as $row)
	{
		$ID = $row['ID'];
		$Make = $row['Make'];
		$Model = $row['Model'];
		$AssetTag = $row['AssetTag'];
		$SerialNumber = $row['SerialNumber'];
		$IMEI = $row['IMEI'];
		$ICCID = $row['ICCID'];
		$Carrier = $row['Carrier'];
		$PhoneNumber = $row['PhoneNumber'];
		$PurchaseDate = $row['PurchaseDate'];
		$PurchasePrice = $row['PurchasePrice'];
		$AssignedTo = $row['AssignedTo'];
		$Status = $row['Status'];
		$Notes = $row['Notes'];
		
	}
	
	include_once(INCLUDES ."assignedName.php");
	
?>

<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit Mobile</h4>
</div>
	<div class="modal-body">

	<form id="editForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Make">Make</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="Make" name="Make" value="<?php echo $Make; ?>"required />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Model">Model</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Model" name="Model" value="<?php echo $Model; ?>"required />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="AssetTag">Asset Tag</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="AssetTag" name="AssetTag" value="<?php echo $AssetTag; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="SerialNumber">Serial Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SerialNumber" name="SerialNumber" value="<?php echo $SerialNumber; ?>"required />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="IMEI">IMEI</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="IMEI" name="IMEI" value="<?php echo $IMEI; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="ICCID">ICCID</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="ICCID" name="ICCID" value="<?php echo $ICCID; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Carrier">Carrier</label>
			<div class="col-xs-5">
				<select class="form-control" name="Carrier" id="Carrier">
					<option selected disabled><?php echo $Carrier; ?></option>
					<option value="ATT">ATT</option>
					<option value="Verizon">Verizon</option>
					<option value="Truphone">Truphone</option>
					<option value="Vodaphone">Vodaphone</option>
					<option value="Rogers">Rogers</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="PhoneNumber">Phone Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo $PhoneNumber; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Price</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PurchasePrice" name="PurchasePrice" value="<?php echo $PurchasePrice; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PurchaseDate" name="PurchaseDate" value="<?php echo $PurchaseDate; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Assigned To</label>
			<div class="col-xs-5">
				<?php
				print "<select class='form-control' name='AssignedToID' id='AssignedToID'>";
				print "<option selected disabled>".$AssignedToName."</option>";
				print "<option value='Open'>Open</option>";
				foreach ($AllUsers as $user) {
					print "<option value='".$user['ID']."'>".$user['FirstName']." ".$user['LastName']."</option>";
				}
				foreach ($AllField as $field) {
					print "<option value='field".$field['ID']."'>".$field['FieldType'].$field['FieldNumber']."</option>";
				}
				print "</select>";
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Status</label>
			<div class="col-xs-5">
				<?php
				if ($Status == '' ){
					print "<select select class='form-control' name='Status' id='Status'>";
            		print "<option selected disabled>Choose Status...</option>";
            		print "<option value='New in box'>New in box</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='Locked'>Locked</option>";
            		print "<option value='Suspended'>Suspended</option>";
            		print "<option value='Damaged'>Damaged</option>";
            		print "</select>";
				} else {
					print "<select select class='form-control' name='Status' id='Status'>";
            		print "<option selected disabled value='".$Status."'>".$Status."</option>";
            		print "<option value='New in box'>New in box</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='Locked'>Locked</option>";
            		print "<option value='Suspended'>Suspended</option>";
            		print "<option value='Damaged'>Damaged</option>";
            		print "</select>";
				}
			?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Notes</label>
			<div class="col-xs-5">
				<textarea class="form-control" name="Notes" id="Notes" style="resize:none"><?php echo $Notes; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-danger pull-left" name="DeleteMobile" value="<?php echo $ID; ?>">Delete Item</button>
				<button type="submit" class="btn btn-success pull-right" name="UpdateMobile" value="<?php echo $ID; ?>">Save</button>
			</div>
		</div>
	</form>
	
	
<script type="text/javascript">

	$.validator.setDefaults({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
	});

  $("#editForm").validate({
  	errorElement: 'span',
	errorClass: 'help-block',
	errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
    },
	err: {
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
		}
	},
	rules: {
  		AssetTag: {
  			digits: true,
  			minlength: 4,
  		},
  		SerialNumber: {
  			required: true,
  		}
  	},
  	messages: {
  		Make: {
  			required: "Make required."
  		},
  		Model: {
  			required: "Model required."
  		},
  		AssetTag: {
  			digits: "Requires digits only.",
  			minlength: "4 digits minimun.",
  		},
  		SerialNumber: {
  			required: "Serial Number required.",
  		}
  	}
  });
  
  $(".modal").on("hidden.bs.modal", function(){
    	$( "#editForm" ).validate().resetForm();
    	$( "#editForm" )[0].reset();
    	$( "#editForm" ).find('.has-error').removeClass("has-error");
        $( "#editForm" ).find('.has-success').removeClass("has-success");
        $( "#editForm" ).find('.form-control-feedback').remove()

	});
	
</script>












