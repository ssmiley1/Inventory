<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<?php

	$db = new PDO('sqlite:../../../db/Inventory.db');

?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add New Printer</h4>
</div>
	<div class="modal-body">

	<form id="addForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Make">Make</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="Make" name="Make" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Model">Model</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Model" name="Model" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Asset Tag</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="AssetTag" name="AssetTag">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="SerialNumber">Serial Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SerialNumber" name="SerialNumber">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Printer Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PrinterName" name="PrinterName">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Location</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Location" name="Location">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">IP Address</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="IPAddress" name="IPAddress" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">MAC Address</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="MACAddress" name="MACAddress" />
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
				<button type="submit" class="btn btn-success pull-right" name="AddPrinter">Save</button>
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
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		}
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
  		Make: {
  			required: true
  		},
  		Model: {
  			required: true
  		}
  	},
  	messages: {
  		Make: {
  			required: "Make is required."
  		},
  		Model: {
  			required: "Model is required."
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












