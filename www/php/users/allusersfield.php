<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid hidden-print">
	<h3>All Field Users</h3>
	<table id="datatable" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
		<thead>
			<tr>
				<th>Edit</th>
				<th>Field Name</th>
				<th>Full Name</th>
				<th>District Name</th>
				<th>Cell Phone</th>
				<th>Street Address</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$db = new PDO('sqlite:db/Inventory.db');
	
				if(!$db){
				  echo $db->lastErrorMsg();
				} else {

			$allfield = $db->query("SELECT * FROM field ORDER BY 'FieldType' ASC");

			foreach($allfield as $row)
			{
			
				$UserID = "field".$row['ID'];
				
				# Check if there is a mobile phone in the mobile table assigned to this user
				$AssignedMobilePhoneNumber = NULL;
				$AssignedCellPhoneNumber = $db->query("SELECT PhoneNumber FROM mobile WHERE AssignedTo = '$UserID'");
				foreach( $AssignedCellPhoneNumber as $number ){
					$AssignedMobilePhoneNumber = $number['PhoneNumber'];
				}
			
				print "<tr>";
				print "<td>";
				
				print "<form class='inline-form' style='padding:0; margin:0'>";
				print "<div class='row'>";
				
				print "<div class='form-group col-sm-2'>";
				print "<form action='www/php/users/edituserfield.php' method='POST' style='padding:0; margin:0'>";
				print "<a data-toggle='modal' href='www/php/users/edituserfield.php?ID=".$row['ID']."' data-target='#editmodal'><span class='glyphicon glyphicon-edit'></span></a>";
				print "</form>";
				print "</div>"; #<-- div col-sm-2
				
				print "<div class='form-group col-sm-2'>";
				print "<form action='www/php/users/fieldship.php' method='POST' style='padding:0; margin:0'>";
				print "<a data-toggle='modal' href='www/php/users/fieldship.php?ID=".$row['ID']."' data-target='#shippingmodal'><span class='glyphicon glyphicon-send'></span></a>";
				print "</form>";
				print "</div>"; #<-- div col-sm-2
				
				print "</div>"; #<-- row
				print "</form>"; #<-- inline-form
				
				print "</td>";
				
				print "<td>".$row['FieldType'].$row['FieldNumber']."</td>";
				print "<td>".$row['FirstName']." ".$row['LastName']."</td>";
				print "<td>".$row['DistrictName']."</td>";

				# Display the assigned cell phone number, or if doesn't exist, use the one (possibly older info) that exists in the field table
				if( ($row['CellPhoneNumber'] == NULL) or ($row['CellPhoneNumber'] == '') ){
					print "<td>".$AssignedMobilePhoneNumber."</td>";
				}else{
					print "<td>".$row['CellPhoneNumber']."</td>";
				}

				print "<td>".$row['StreetAddress']."</td>";
				print "<td>".$row['City']."</td>";
				print "<td>".$row['State']."</td>";
				print "<td>".$row['ZipCode']."</td>";
				
				print "</tr>";
			}
				$db = NULL;
			}
		?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="editmodal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		</div>
	</div>
</div>

<div class="modal fade" id="shippingmodal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		</div>
	</div>
</div>

<script>
	$("#editmodal").on('hidden.bs.modal', function () {
    	$(this).data('bs.modal', null);
	});
	$("#shippingmodal").on('hidden.bs.modal', function () {
    	$(this).data('bs.modal', null);
	});
	
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
     
     $('#shippingmodal').hide();
     $('.modal-backdrop').hide();
     
	}
	
</script>

</body>
</html>