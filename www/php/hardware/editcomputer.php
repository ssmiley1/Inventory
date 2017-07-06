<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$ComputerIDToEdit = $_GET['ID'];
	$ComputerToEdit = $db->query('SELECT * FROM computers WHERE ID = '.$ComputerIDToEdit);
	
	$FieldInfo = $db->query('SELECT ID, FieldType, FieldNumber FROM field ORDER BY FieldNumber ASC');
	$AllField = $FieldInfo->fetchall(PDO::FETCH_ASSOC);
	
	$UserInfo = $db->query('SELECT ID, FirstName, LastName FROM users ORDER BY FirstName ASC');
	$AllUsers = $UserInfo->fetchall(PDO::FETCH_ASSOC);
	
	foreach($ComputerToEdit as $row)
	{
		$ID = $row['ID'];
		$Make = $row['Make'];
		$Model = $row['Model'];
		$SerialNumber = $row['SerialNumber'];
		$Type = $row['Type'];
		$AssetTag = $row['AssetTag'];
		$EthernetMAC = $row['EthernetMAC'];
		$WiFiMAC = $row['WiFiMAC'];
		$PurchaseDate = $row['PurchaseDate'];
		$PurchasePrice = $row['PurchasePrice'];
		$AssignedTo = $row['AssignedTo'];
		$Status = $row['Status'];
		$Notes = $row['Notes'];
		
	}	
		
	if (stripos($AssignedTo, "field") !== false) {
	
		$AssignedFieldID = substr($AssignedTo, 5);
		$AssignedFieldUser = $db->query('SELECT ID, FieldType, FieldNumber FROM field WHERE ID = '.$AssignedFieldID);
		$AssignedFieldName = $AssignedFieldUser->fetchall(PDO::FETCH_ASSOC);
		
		foreach ($AssignedFieldName as $field)
		{
			$AssignedToName = "$field[FieldType]$field[FieldNumber]";
		}
	
	} elseif ($AssignedTo == "Open") {
	
		$AssignedToName = "Open";
		
	} else {
	
	$AssignedUser = $db->query('SELECT ID, FirstName, LastName FROM users WHERE ID = '.$AssignedTo);
	$UserName = $AssignedUser->fetchall(PDO::FETCH_ASSOC);
	
		foreach($UserName as $name)
		{
			$AssignedToName = "$name[FirstName] $name[LastName]";
		}
	}
	
	if( $AssignedTo !== "Open" ){
		$Status = "Assigned";
	}
	
?>

<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit Computer</h4>
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
			<label class="col-xs-3 control-label" for="SerialNumber">Serial Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SerialNumber" name="SerialNumber" value="<?php echo $SerialNumber; ?>"required />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Type">Type</label>
			<div class="col-xs-5">
				<select class="form-control" name="Type">
					<option selected disabled><?php echo $Type; ?></option>
					<option value="Desktop">Desktop</option>
					<option value="Laptop">Laptop</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Asset Tag</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="AssetTag" name="AssetTag" value="<?php echo $AssetTag; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Ethernet MAC</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="EthernetMAC" value="<?php echo $EthernetMAC; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">WiFi MAC</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="WiFiMAC" name="WiFiMAC" value="<?php echo $WiFiMAC; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Price</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="PurchasePrice" value="<?php echo $PurchasePrice; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="PurchaseDate" value="<?php echo $PurchaseDate; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Assigned To</label>
			<div class="col-xs-5">
				<?php
				print "<select class='form-control' id='AssignedToID' name='AssignedToID'>";
				print "<option selected disabled>".$AssignedToName."</option>";
				print "<option value='Open'>Open</option>";
				foreach ($AllUsers as $user) {
					print "<option value='".$user['ID']."'>".$user['FirstName']." ".$user['LastName']."</option>";
				}
				print "</select>";
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Status</label>
			<div class="col-xs-5">
				<?php
				if( (isset($Status)) and ($Status !== NULL) and ($Status !== '') ){
					print "<select select class='form-control' name='Status' id='Status'>";
            		print "<option selected value='".$Status."'>".$Status."</option>";
            		print "<option value='New in box'>New in box</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='Assigned'>Assigned</option>";
            		print "<option value='On Hold'>On Hold</option>";
            		print "<option value='Damaged'>Damaged</option>";
            		print "<option value='To Recycle'>To Recycle</option>";
            		print "</select>";
				} else {
					print "<select select class='form-control' name='Status' id='Status'>";
            		print "<option selected value='Available'>Choose Status...</option>";
            		print "<option value='New in box'>New in box</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='Assigned'>Assigned</option>";
            		print "<option value='On Hold'>On Hold</option>";
            		print "<option value='Damaged'>Damaged</option>";
            		print "<option value='To Recycle'>To Recycle</option>";
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
				<button type="submit" class="btn btn-danger pull-left" name="DeleteComputer" value="<?php echo $ID; ?>">Delete Item</button>
				<button type="submit" class="btn btn-success pull-right" name="UpdateComputer" value="<?php echo $ID; ?>">Save</button>
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
  			required: true,
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
  			required: "Asset Tag required.",
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












