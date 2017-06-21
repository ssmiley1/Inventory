<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$FieldIDToEdit = $_GET['ID'];
	$FieldToEdit = $db->query('SELECT * FROM field WHERE ID = '.$FieldIDToEdit);
	
	foreach($FieldToEdit as $row)
	{
		$ID = $row['ID'];
		$FirstName = $row['FirstName'];
		$LastName = $row['LastName'];
		$FieldType = $row['FieldType'];
		$FieldNumber = $row['FieldNumber'];
		$DistrictName = $row['DistrictName'];
		$HomeStoreNumber = $row['HomeStoreNumber'];
		$StreetAddress = $row['StreetAddress'];
		$City = $row['City'];
		$State = $row['State'];
		$ZipCode = $row['ZipCode'];
		$Notes = $row['Notes'];
		
		$AssignedID = "field".$ID;
		$GetAssignedCellPhoneNumber = $db->query("SELECT PhoneNumber FROM mobile WHERE AssignedTo = '$AssignedID'");
	
		foreach( $GetAssignedCellPhoneNumber as $AssignedPhone ){
			$CellPhoneNumber = $AssignedPhone['PhoneNumber'];
		}
		
		if( ($CellPhoneNumber == NULL) or ($CellPhoneNumber == '') ){
			$CellPhoneNumber = $row['CellPhoneNumber'];
		}
		
	}
	
?>

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
				<input type="text" class="form-control" autofocus id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="LastName">Last Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName; ?>" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FieldType">Field Type</label>
			<div class="col-xs-5">
				<select class="form-control" name="FieldType" id="FieldType" required>
				<option selected value="<?php echo $FieldType; ?>" ><?php echo $FieldType; ?></option>
				<option value="CM">CM</option>
				<option value="DM">DM</option>
				<option value="RM">RM</option>
				<option value="TVP">TVP</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FieldNumber">Field Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="FieldNumber" name="FieldNumber" id="FieldNumber" value="<?php echo $FieldNumber; ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="CellPhoneNumber">Cell Phone Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="CellPhoneNumber" name="CellPhoneNumber" id="CellPhoneNumber" value="<?php echo $CellPhoneNumber; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="DistrictName">District Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="DistrictName" value="<?php echo $DistrictName; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="HomeStoreNumber">Home Store Number</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="HomeStoreNumber" value="<?php echo $HomeStoreNumber; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="StreetAddress">Street Address</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="StreetAddress" value="<?php echo $StreetAddress; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="City">City</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="City" value="<?php echo $City; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">State</label>
			<div class="col-xs-5">
				<select class="form-control" name="State">
				<option selected disabled><?php echo $State; ?></option>
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
				<input type="text" class="form-control" name="ZipCode" value="<?php echo $ZipCode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Notes</label>
			<div class="col-xs-5">
				<textarea class="form-control" name="Notes" style="resize:none"><?php echo $Notes; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-danger pull-left" name="DeleteField" value="<?php echo $ID; ?>">Delete User</button>
				<button type="submit" class="btn btn-success pull-right" name="UpdateField" value="<?php echo $ID; ?>">Save</button>
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
  		}
  	},
  	messages: {
  		FieldType: {
  			required: "Type required."
  		},
  		FieldNumber: {
  			required: "Number required."
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












