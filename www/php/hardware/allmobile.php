<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid">
		<h3>All Mobile</h3>
		<table id="allcomputers" class="table table-sm table-bordered table-striped table-hover display compact nowrap" width="100%" style="font-size:15px">
			<thead>
		<tr>
			<th>Make</th>
			<th>Model</th>
			<th>Asset #</th>
			<th>Serial Number</th>
			<th>IMEI</th>
			<th>ICCID</th>
			<th>Carrier</th>
			<th>Line Number</th>
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

	$allmobile = $db->query("SELECT * FROM mobile WHERE Status != 'Damaged' AND Status != 'Lost/Stolen' ORDER BY 'Make' ASC");
	
	foreach($allmobile as $row)
	{
		print "<tr>";
		print "<td>".$row['Make']."</td>";
		print "<td>".$row['Model']."</td>";
		print "<td>".$row['AssetTag']."</td>";
		print "<td>".$row['SerialNumber']."</a></td>";
		print "<td>".$row['IMEI']."</td>";
		print "<td>".$row['ICCID']."</td>";
		print "<td>".$row['Carrier']."</td>";
		print "<td>".$row['PhoneNumber']."</td>";
		
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
		
		} elseif( ($row['AssignedTo'] == "Open") || ($row['AssignedTo'] == NULL) ){
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
		$db = NULL;
?>
	</tbody>
		</table>

</div>
</body>
</html>