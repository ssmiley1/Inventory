<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid">
		<h3>All Mobile</h3>
		<table id="datatable" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
			<thead>
				<tr>
					<th>Edit</th>
					<th>Make</th>
					<th>Model</th>
					<th>Asset Tag</th>
					<th>Serial Number</th>
					<th>IMEI</th>
					<th>ICCID</th>
					<th>Carrier</th>
					<th>Phone Number</th>
					<th>Price</th>
					<th>Assigned To</th>
					<th>Status</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$db = new PDO('sqlite:db/Inventory.db');
	
				if(!$db){
				  echo $db->lastErrorMsg();
				} else {

				$allmobile = $db->query("SELECT * FROM mobile ORDER BY 'Make' ASC");

				foreach($allmobile as $row)
				{
					print "<tr>";
					print "<td>";
					print "<form action='www/php/hardware/editmobile.php' method='POST' style='padding:0; margin:0'>";
					print "<a data-toggle='modal' href='www/php/hardware/editmobile.php?ID=".$row['ID']."' data-target='#editmodal'><span class='glyphicon glyphicon-edit'></span></a>";
					print "</form>";
					print "</td>";
					print "<td>".$row['Make']."</td>";
					print "<td>".$row['Model']."</td>";
					print "<td>".$row['AssetTag']."</td>";
					print "<td>".$row['SerialNumber']."</td>";
					print "<td>".$row['IMEI']."</td>";
					print "<td>".$row['ICCID']."</td>";
					print "<td>".$row['Carrier']."</td>";
					print "<td>".$row['PhoneNumber']."</td>";
					print "<td>".$row['PurchasePrice']."</td>";
					
					if( strpos($row['AssignedTo'], 'field') !== false) {
						$FieldID = substr($row['AssignedTo'], 5);
						$FieldFullName = $db->query('SELECT FieldType, FieldNumber FROM field WHERE ID = '.$FieldID);
						$FieldWithNumber = $FieldFullName->fetchall(PDO::FETCH_ASSOC);
						foreach( $FieldWithNumber as $field ){
							print "<td>".$field['FieldType'].$field['FieldNumber']."</td>";
						}
					} elseif( is_numeric($row['AssignedTo']) ) {
						$UserFullName = $db->query('SELECT FirstName, LastName FROM users WHERE ID = '.$row['ID']);
						$UserName = $UserFullName->fetchall(PDO::FETCH_ASSOC);
						foreach( $UserName as $name ){
							print "<td>".$name['FirstName']." ".$name['LastName']."</td>";
						}
					} else {
						print "<td>".$row['AssignedTo']."</td>";
					}
					
					if( ($row['Status'] == NULL) or ($row['Status'] == '') ) {
						print "<td></td>";
					} else {
						print "<td>".$row['Status']."</td>";
					}
					print "<td>".$row['Notes']."</td>";
				}
				
				print "</tr>";
					
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

<script>
	$("#editmodal").on('hidden.bs.modal', function () {
    	$(this).data('bs.modal', null);
	});
</script>

</body>
</html>