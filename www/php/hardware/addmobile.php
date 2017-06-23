<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add New Mobile Device</h4>
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
				<input type="text" class="form-control" id="SerialNumber" name="SerialNumber" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">IMEI</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="IMEI" name="IMEI">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">ICCID</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="ICCID" name="ICCID">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Carrier">Carrier</label>
			<div class="col-xs-5">
				<select class="form-control" id="Carrier" name="Carrier">
				<option selected>Choose Carrier...</option>
				<option>ATT</option>
				<option>Verizon</option>
				<option>Truphone</option>
				<option>Vodafone</option>
				<option>Rogers</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Phone Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PurchaseDate" name="PurchaseDate" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Price</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PurchasePrice" name="PurchasePrice" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Assigned To</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="AssignedTo" name="AssignedTo" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Status</label>
			<div class="col-xs-5">
				<select class="form-control" id="Status" name="Status">
				<option selected>Choose Status...</option>
				<option>Available</option>
				<option>Locked</option>
				<option>Suspended</option>
				<option>Damaged</option>
				<option>Lost/Stolen</option>
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
				<button type="submit" class="btn btn-success pull-right" name="AddMobile">Save</button>
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
  		SerialNumber: {
  			required: true,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					SerialNumber: function() {
  						return $("#SerialNumber").val();
  					},
  					Table: "mobile"
  				}
  			}
  		},
  		AssetTag: {
  			required: false,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTag: function() {
  						return $("#AssetTag").val();
  					},
  					Table: "mobile"
  				}
  			}
  		}
  	},
  	messages: {
  		Make: {
  			required: "Make is required."
  		},
  		Model: {
  			required: "Model is required."
  		},
  		AssetTag: {
  			digits: "Please enter digits only.",
  			min: "Asset tag must be more than 4 digits.",
  			remote: "Asset tag already exists."
  		},
  		SerialNumber: {
  			required: "Serial number required.",
  			remote: "Serial number already exists."
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












