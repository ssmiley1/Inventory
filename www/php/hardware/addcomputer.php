<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<?php

	$db = new PDO('sqlite:../../../db/Inventory.db');

	$FieldInfo = $db->query('SELECT ID, FieldType, FieldNumber FROM field ORDER BY FieldType ASC, FieldNumber ASC');
	$AllField = $FieldInfo->fetchall(PDO::FETCH_ASSOC);
	
	$UserInfo = $db->query('SELECT ID, FirstName, LastName FROM users ORDER BY FirstName ASC');
	$AllUsers = $UserInfo->fetchall(PDO::FETCH_ASSOC);

?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add New Computer</h4>
</div>
	<div class="modal-body">

	<form id="addForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Make">Make</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="Make" name="Make" required/>
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Model">Model</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Model" name="Model" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="SerialNumber">Serial Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SerialNumber" name="SerialNumber" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Type">Type</label>
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
				<input type="text" class="form-control required" id="AssetTag" name="AssetTag" required/>
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
				<?php
				print "<select class='form-control' name='AssignedToID' id='AssignedToID'>";
				print "<option selected disabled value='Open'>Assigned To...</option>";
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
				<select class="form-control" id="Status" name="Status">
				<option selected>Available</option>
				<option value="New in box">New in box</option>
				<option value="Assinged">Assigned</option>
				<option value="On hold">On hold</option>
				<option value="Damaged">Damaged</option>
				<option value="To recycle">To recycle</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Notes</label>
			<div class="col-xs-5">
				<textarea class="form-control" id="Notes" name="Notes" style="resize:none"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-success pull-right" name="AddComputer">Save</button>
			</div>
		</div>
	</form>
</div>
	
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
  	rules: {
  		AssetTag: {
  			required: true,
  			digits: true,
  			minlength: 4,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTag: function() {
  						return $("#AssetTag").val();
  					},
  					Table: "computers"
  				}
  			}
  		},
  		SerialNumber: {
  			required: true,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					SerialNumber: function() {
  						return $("#SerialNumber").val();
  					},
  					Table: "computers"
  				}
  			}
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
  			remote: "Already exists."
  		},
  		SerialNumber: {
  			required: "Serial Number required.",
  			remote: "Already exists."
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












