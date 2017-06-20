<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$UserIDToEdit = $_GET['ID'];
	$UserToEdit = $db->query('SELECT * FROM users WHERE ID = '.$UserIDToEdit);
	
	foreach($UserToEdit as $row)
	{
		$ID = $row['ID'];
		$FirstName = $row['FirstName'];
		$LastName = $row['LastName'];
		$ADAccount = $row['ADAccount'];
		$Email = $row['Email'];
		$DeskPhone = $row['DeskPhone'];
		$StartDate = $row['StartDate'];
		$Department = $row['Department'];
		$Position = $row['Position'];
		$Notes = $row['Notes'];
		
	}	
?>

<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit HE User</h4>
</div>
	<div class="modal-body">

	<form id="editForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FirstName">First Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>"required />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="LastName">Last Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="LastName" name="LastName" value="<?php echo $LastName; ?>"required />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="ADAccount">AD Account</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="ADAccount" name="ADAccount" value="<?php echo $ADAccount; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Email">Email</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="DeskPhone">Desk Phone</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="DeskPhone" value="<?php echo $DeskPhone; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="StartDate">Start Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="StartDate" value="<?php echo $StartDate; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Department">Department</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="Department" value="<?php echo $Department; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Position</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="Position" value="<?php echo $Position; ?>" />
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
				<button type="submit" class="btn btn-danger pull-left" name="DeleteUser" value="<?php echo $ID; ?>">Delete User</button>
				<button type="submit" class="btn btn-success pull-right" name="UpdateUser" value="<?php echo $ID; ?>">Save</button>
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
  		FirstName: {
  			required: true,
  		},
  		LastName: {
  			required: true,
  		}
  	},
  	messages: {
  		FirstName: {
  			required: "Name required."
  		},
  		LastName: {
  			required: "Name required."
  		},
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












