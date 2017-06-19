<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$AccessoryIDToEdit = $_GET['ID'];
	$AccessoryToEdit = $db->query('SELECT * FROM accessories WHERE ID = '.$AccessoryIDToEdit);
	
	foreach($AccessoryToEdit as $row)
	{
		$ID = $row['ID'];
		$Make = $row['Make'];
		$Model = $row['Model'];
		$SerialNumber = $row['SerialNumber'];
		$AssetTag = $row['AssetTag'];
		$Description = $row['Description'];
		$EthernetMAC = $row['EthernetMAC'];
		$PurchaseDate = $row['PurchaseDate'];
		$PurchasePrice = $row['PurchasePrice'];
		$AssignedTo = $row['AssignedTo'];
		$Status = $row['Status'];
		$Notes = $row['Notes'];
		
	}
?>

<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit Accessory</h4>
</div>
	<div class="modal-body">

	<form id="addForm" action="index.php?page=hardware/allaccessories" method="post" class="form-horizontal">
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
			<label class="col-xs-3 control-label">Asset Tag</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="AssetTag" name="AssetTag" value="<?php echo $AssetTag; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Description</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Description" name="Description" value="<?php echo $Description; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Ethernet MAC</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="EthernetMAC" value="<?php echo $EthernetMAC; ?>" />
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
				<input type="text" class="form-control" name="AssignedTo" value="<?php echo $AssignedTo; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Status</label>
			<div class="col-xs-5">
				<?php
				if ($Status == '' ){
					print "<label for='Status'>Status:</label>";
					print "<select name='Status'>";
            		print "<option selected disabled>Choose Status...</option>";
            		print "<option value='New in box'>New in box</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='Locked'>Locked</option>";
            		print "<option value='Suspended'>Suspended</option>";
            		print "<option value='Damaged'>Damaged</option>";
            		print "</select>";
				} else {
					print "<label for='Status'>Status:</label>";
					print "<select name='Status'>";
            		print "<option selected disabled>".$Status."</option>";
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
				<textarea class="form-control" id="Notes" style="resize:none" ><?php print $Notes; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-default">Save</button>
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

  $("#addForm").validate({
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
  	messages: {
  		Make: {
  			required: "Make required."
  		},
  		Model: {
  			required: "Model required."
  		},
  		SerialNumber: {
  			required: "Serial Number required.",
  		}
  	}
  });
  
  $(".modal").on("hidden.bs.modal", function(){
    	$( "#addForm" ).validate().resetForm();
    	$( "#addForm" )[0].reset();
    	$( "#addForm" ).find('.has-error').removeClass("has-error");
        $( "#addForm" ).find('.has-success').removeClass("has-success");
        $( "#addForm" ).find('.form-control-feedback').remove()

	});
	
</script>












