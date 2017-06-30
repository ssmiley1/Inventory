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
<h4 class="modal-title">Assign Hardware</h4>
</div>
	<div class="modal-body" id="modal-body">

	<form id="assignForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label">Assign To</label>
			<div class="col-xs-4">
				<select class="form-control" name="AssignedToID" id="AssignedToID" autofocus required>
				<option selected disabled value="Open">Choose User...</option>
				<option value="Open">Open</option>
				<?php
				foreach ($AllUsers as $user) {
					print "<option value='".$user['ID']."'>".$user['FirstName']." ".$user['LastName']."</option>";
				}
				foreach ($AllField as $field) {
					print "<option value='field".$field['ID']."'>".$field['FieldType'].$field['FieldNumber']."</option>";
				}
				?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="AssetTag1">Asset Tag</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" id="AssetTag1" name="AssetTag1" required/>
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="AssetTag2">Asset Tag</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" id="AssetTag2" name="AssetTag2" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="AssetTag3">Asset Tag</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" id="AssetTag3" name="AssetTag3" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="AssetTag4">Asset Tag</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" id="AssetTag4" name="AssetTag4" />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="AssetTag5">Asset Tag</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" id="AssetTag5" name="AssetTag5" />
			</div> 
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-success pull-right" name="AssignEquipment">Assign</button>
			</div>
		</div>
	</form>
	
	</div>
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

  $("#assignForm").validate({
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
  		AssignedToID: {
  			required: true
  		},
  		AssetTag1: {
  			required: true,
  			digits: true,
  			minlength: 4,
  			maxlength: 6,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTagAssign: function() {
  						return $("#AssetTag1").val();
  					}
  				}
  			}
  		},
  		AssetTag2: {
  			digits: true,
  			minlength: 4,
  			maxlength: 6,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTagAssign: function() {
  						return $("#AssetTag2").val();
  					}
  				}
  			}
  		},
  		AssetTag3: {
  			digits: true,
  			minlength: 4,
  			maxlength: 6,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTagAssign: function() {
  						return $("#AssetTag3").val();
  					}
  				}
  			}
  		},
  		AssetTag4: {
  			digits: true,
  			minlength: 4,
  			maxlength: 6,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTagAssign: function() {
  						return $("#AssetTag4").val();
  					}
  				}
  			}
  		},
  		AssetTag5: {
  			digits: true,
  			minlength: 4,
  			maxlength: 6,
  			remote: {
  				url: "/resources/process/validate.php",
  				type: "post",
  				data: {
  					AssetTagAssign: function() {
  						return $("#AssetTag5").val();
  					}
  				}
  			}
  		},
  	},
  	success: function(element) {
		$(element).closest('.form-group').addClass('has-success');
    },
  	messages: {
  		AssignedToID: {
  			required: "User required."
  		},
  		AssetTag1: {
  			required: "Asset Tag required.",
  			digits: "Requires digits only.",
  			minlength: "4 digits minimum.",
  			maxlength: "6 digits maximum.",
  		},
  		AssetTag2: {
  			digits: "Requires digits only.",
  			minlength: "4 digits minimum.",
  			maxlength: "6 digits maximum.",
  		},
  		AssetTag3: {
  			digits: "Requires digits only.",
  			minlength: "4 digits minimum.",
  			maxlength: "6 digits maximum.",
  		},
  		AssetTag4: {
  			digits: "Requires digits only.",
  			minlength: "4 digits minimum.",
  			maxlength: "6 digits maximum.",
  		},
  		AssetTag5: {
  			digits: "Requires digits only.",
  			minlength: "4 digits minimum.",
  			maxlength: "6 digits maximum.",
  		}
  	}
  });
  
  $(".modal").on("hidden.bs.modal", function(){
    	$( "#assignForm" ).validate().resetForm();
    	$( "#assignForm" )[0].reset();
    	$( "#assignForm" ).find('.has-error').removeClass("has-error");
        $( "#assignForm" ).find('.has-success').removeClass("has-success");
        $( "#assignForm" ).find('.form-control-feedback').remove()

	});
	
</script>