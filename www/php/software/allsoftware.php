<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid">
		<h3>All Software</h3>
		<table id="datatable" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
			<thead>
				<tr>
					<th>Edit</th>
					<th>Developer</th>
					<th>Software</th>
					<th>Version</th>
					<th>License Type</th>
					<th>Serial Key</th>
					<th>Purchase Date</th>
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

				$allsoftware = $db->query("SELECT * FROM software ORDER BY 'Developer' ASC");

				foreach($allsoftware as $row)
				{
					print "<tr>";
					print "<td>";
					print "<form action='www/php/software/editsoftware.php' method='POST' style='padding:0; margin:0'>";
					print "<a data-toggle='modal' href='www/php/software/editsoftware.php?ID=".$row['ID']."' data-target='#editmodal'><span class='glyphicon glyphicon-edit'></span></a>";
					print "</form>";
					print "</td>";
					print "<td>".$row['SoftwareDeveloper']."</td>";
					print "<td>".$row['SoftwareName']."</td>";
					print "<td>".$row['Version']."</td>";
					print "<td>".$row['LicenseType']."</td>";
					print "<td>".$row['SerialKey']."</td>";
					print "<td>".$row['PurchaseDate']."</td>";
					print "<td>".$row['PurchasePrice']."</td>";
		
					if( $row['AssignedTo'] == "Open" ){
						print "<td>".$row['AssignedTo']."</td>";
					} elseif ( strpos($row['AssignedTo'], 'field') !== false) {
						$FieldID = substr($row['AssignedTo'], 5);
						$FieldFullName = $db->query('SELECT FieldType, FieldNumber FROM field WHERE ID = '.$FieldID);
						$FieldWithNumber = $FieldFullName->fetchall(PDO::FETCH_ASSOC);
						foreach( $FieldWithNumber as $field ){
							print "<td>".$field['FieldType'].$field['FieldNumber']."</td>";
						}
					} elseif ( is_numeric($row['AssignedTo']) ) {
						$AllNames = $db->query('SELECT FirstName, LastName FROM users WHERE ID = '.$row['AssignedTo']);
						$FirstNameLastName = $AllNames->fetchall(PDO::FETCH_ASSOC);
						foreach( $FirstNameLastName as $name ){
							print "<td>".$name['FirstName']." ".$name['LastName']."</td>";
						}
					} else {
						print "<td>Error</td>";
					}
					
					print "<td>".$row['Status']."</td>";
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