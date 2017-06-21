<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid">
		<h3>All Computers</h3>
		<table id="datatable" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
			<thead>
				<tr>
					<th>Edit</th>
					<th>Make</th>
					<th>Model</th>
					<th>Serial Number</th>
					<th>Type</th>
					<th>Asset Tag</th>
					<th>Ethernet MAC</th>
					<th>WiFi MAC</th>
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

				$allcomputers = $db->query("SELECT * FROM computers ORDER BY 'Make' ASC");

				foreach($allcomputers as $row)
				{
					print "<tr>";
					print "<td>";
					print "<form action='www/php/hardware/editcomputer.php' method='POST' style='padding:0; margin:0'>";
					print "<a data-toggle='modal' href='www/php/hardware/editcomputer.php?ID=".$row['ID']."' data-target='#editmodal'><span class='glyphicon glyphicon-edit'></span></a>";
					print "</form>";
					print "</td>";
					print "<td>".$row['Make']."</td>";
					print "<td>".$row['Model']."</td>";
					print "<td>".$row['SerialNumber']."</td>";
					print "<td>".$row['Type']."</td>";
					print "<td>".$row['AssetTag']."</td>";
					print "<td>".strtoupper($row['EthernetMAC'])."</td>";
					print "<td>".strtoupper($row['WiFiMAC'])."</td>";
					print "<td>".$row['PurchasePrice']."</td>";
		
					if ( strpos($row['AssignedTo'], 'field') !== false) {
						$FieldID = substr($row['AssignedTo'], 5);
						$FieldFullName = $db->query('SELECT FieldType, FieldNumber FROM field WHERE ID = '.$FieldID);
						$FieldWithNumber = $FieldFullName->fetchall(PDO::FETCH_ASSOC);
						foreach($FieldWithNumber as $person)
						{
							$username = "$person[FieldType]$person[FieldNumber]";
							print "<td>".$username."</td>";
						}
						print "<td>Assigned</td>";
		
					} elseif( $row['AssignedTo'] == "Open" ){
						print "<td>".$row['AssignedTo']."</td>";
						print "<td>".$row['Status']."</td>";
					} else {

						$FullName = $db->query('SELECT FirstName, LastName FROM users WHERE ID = '.$row['AssignedTo']);
						$FirstNameLastName = $FullName->fetchall(PDO::FETCH_ASSOC);
						foreach($FirstNameLastName as $user)
						{
							$username = "$user[FirstName] $user[LastName]";
							print "<td>".$username."</td>";
						}
						print "<td>Assigned</td>";
					}
					print "<td>".$row['Notes']."</td>";
					print "</tr>";
					}
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