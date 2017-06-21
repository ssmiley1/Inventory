
<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add Field User</h4>
</div>
	<div class="modal-body">

	<form id="addForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FirstName">First Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="FirstName" name="FirstName" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="LastName">Last Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="LastName" name="LastName" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FieldType">Field Type</label>
			<div class="col-xs-5">
				<select class="form-control" name="FieldType" id="FieldType" required>
				<option selected disabled>Choose Type...</option>
				<option>CM</option>
				<option>DM</option>
				<option>RM</option>
				<option>TVP</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FieldNumber">Field Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="FieldNumber" name="FieldNumber" id="FieldNumber" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="DistrictName">District Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="DistrictName" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="HomeStoreNumber">Home Store Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="HomeStoreNumber" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="StreetAddress">Street Address</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="StreetAddress" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="City">City</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="City" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">State</label>
			<div class="col-xs-5">
				<select class="form-control" name="State">
				<option selected disabled>Choose State...</option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="DC">District Of Columbia</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="ZipCode">Zip Code</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="ZipCode" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Notes</label>
			<div class="col-xs-5">
				<textarea class="form-control" name="Notes" style="resize:none"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-success pull-right" name="AddField" >Save</button>
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
  		FieldType: {
  			required: true
  		},
  		FieldNumber: {
  			required: true,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					FieldType: function() {
  						return $("#FieldType").val();
  					},
  					FieldNumber: function() {
  						return $("#FieldNumber").val();
  					},
  					Table: "field"
  				}
  			}
  		}
  	},
  	messages: {
  		FieldType: {
  			required: "Type required."
  		},
  		FieldNumber: {
  			required: "Number required.",
  			remote: "User already exists."
  		},
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












