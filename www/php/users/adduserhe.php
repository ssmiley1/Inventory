<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Add HE User</h4>
</div>
<div class="modal-body">
	<form id="addForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="FirstName">First Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="FirstName" name="FirstName" required />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="LastName">Last Name</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="LastName" name="LastName" required />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="ADAccount">AD Account</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="ADAccount" name="ADAccount" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Email">Email</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Email" name="Email" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="DeskPhone">Desk Phone</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="DeskPhone" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="StartDate">Start Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="StartDate" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Department">Department</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="Department" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Position</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="Position" />
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
				<button type="submit" class="btn btn-success pull-right" name="AddUser">Save</button>
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
  		FirstName: {
  			required: true
  		},
  		LastName: {
  			required: true,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					LastName: function() {
  						return $("#LastName").val();
  					},
  					Table: "users"
  				}
  			}
  		}
  	},
  	messages: {
  		FirstName: {
  			required: "Name required."
  		},
  		LastName: {
  			required: "Name required.",
  			remote: "Name already exists."
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











