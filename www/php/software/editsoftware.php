<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$SoftwareIDToEdit = $_GET['ID'];
	$SoftwareToEdit = $db->query('SELECT * FROM software WHERE ID = '.$SoftwareIDToEdit);
	
	$UserInfo = $db->query('SELECT ID, FirstName, LastName FROM users ORDER BY FirstName ASC');
	$AllUsers = $UserInfo->fetchall(PDO::FETCH_ASSOC);
	
	foreach($SoftwareToEdit as $row)
	{
		$ID = $row['ID'];
		$SoftwareDeveloper = $row['SoftwareDeveloper'];
		$SoftwareName = $row['SoftwareName'];
		$Verison = $row['Verison'];
		$SerialKey = $row['SerialKey'];
		$LicenseType = $row['LicenseType'];
		$DeviceLimit = $row['DeviceLimit'];
		$Category = $row['Category'];
		$WebSite = $row['WebSite'];
		$PurchaseDate = $row['PurchaseDate'];
		$PurchasePrice = $row['PurchasePrice'];
		$ExpirationDate = $row['ExpirationDate'];
		$Vendor = $row['Vendor'];
		$AssignedTo = $row['AssignedTo'];
		$Status = $row['Status'];
		$Notes = $row['Notes'];
	}
	
	if ($AssignedTo == "Open") {
	
		$AssignedToName = "Open";
		
	} else {
	
	$AssignedUser = $db->query('SELECT ID, FirstName, LastName FROM users WHERE ID = '.$AssignedTo);
	$UserName = $AssignedUser->fetchall(PDO::FETCH_ASSOC);
	
		foreach($UserName as $name)
		{
			$AssignedToName = "$name[FirstName] $name[LastName]";
		}
	}
	
	if( $AssignedTo !== "Open" ){
		$Status = "Assigned";
	}
	
?>

<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="/www/js/jquery-validation/dist/jquery.validate.min.js"></script>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit Software</h4>
</div>
	<div class="modal-body">

	<form id="editForm" action="/resources/process/process.php" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label" for="SoftwareDeveloper">Developer</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" autofocus id="SoftwareDeveloper" name="SoftwareDeveloper" value="<?php echo $SoftwareDeveloper; ?>"required />
			</div> 
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="SoftwareName">Software</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SoftwareName" name="SoftwareName" value="<?php echo $SoftwareName; ?>"required />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Version">Version</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Version" name="Version" value="<?php echo $Version; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="SerialKey">Serial Key</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="SerialKey" name="SerialKey" value="<?php echo $SerialKey; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="LicenseType">License Type</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="LicenseType" name="LicenseType" value="<?php echo $LicenseType; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="DeviceLimit">Device Limit</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="DeviceLimit" name="DeviceLimit" value="<?php echo $DeviceLimit; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="Category">Category</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="Category" name="Category" value="<?php echo $Category; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label" for="WebSite">Web Site</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="WebSite" name="WebSite" value="<?php echo $WebSite; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Date</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PurchaseDate" name="PurchaseDate" value="<?php echo $PurchaseDate; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Purchase Price</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="PurchasePrice" name="PurchasePrice" value="<?php echo $PurchasePrice; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Assigned To</label>
			<div class="col-xs-5">
				<?php
				print "<select class='form-control' name='AssignedToID' id='AssignedToID'>";
				print "<option selected disabled>".$AssignedToName."</option>";
				print "<option value='Open'>Open</option>";
				foreach ($AllUsers as $user) {
					print "<option value='".$user['ID']."'>".$user['FirstName']." ".$user['LastName']."</option>";
				}
				print "</select>";
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Status</label>
			<div class="col-xs-5">
				<?php
				if ($Status == '' ){
					print "<select select class='form-control' name='Status' id='Status'>";
            		print "<option selected disabled>Choose Status...</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='On Hold'>On Hold</option>";
            		print "<option value='Expired'>Expired</option>";
            		print "</select>";
				} else {
					print "<select select class='form-control' name='Status' id='Status'>";
            		print "<option selected disabled value='".$Status."'>".$Status."</option>";
            		print "<option value='Available'>Available</option>";
            		print "<option value='On Hold'>On Hold</option>";
            		print "<option value='Expired'>Expired</option>";
            		print "</select>";
				}
			?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Notes</label>
			<div class="col-xs-5">
				<textarea class="form-control" name="Notes" id="Notes" style="resize:none"><?php echo $Notes; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<button type="submit" class="btn btn-danger pull-left" name="DeleteSoftware" value="<?php echo $ID; ?>">Delete Item</button>
				<button type="submit" class="btn btn-success pull-right" name="UpdateSoftware" value="<?php echo $ID; ?>">Save</button>
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
  		SoftwareDeveloper: {
  			required: true
  		},
  		SoftwareName: {
  			required: true,
  		}
  	},
  	messages: {
  		SoftwareDeveloper: {
  			required: "Developer required."
  		},
  		SoftwareName: {
  			required: "Software name required."
  		},
  		SerialKey: {
  			required: "Serial Number required.",
  		}
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












