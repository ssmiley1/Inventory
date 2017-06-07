<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add New Computer</h4>
</div>
	<div class="modal-body">

	<form id="addForm" action="index.php?page=hardware/allcomputers" method="post" class="form-horizontal">
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
				<textarea class="form-control" id="Notes" style="resize:none"></textarea>
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












