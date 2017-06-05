<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" href="../../favicon.ico">

		<script type="text/javascript" charset="utf8" src="/www/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/media/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.colVis.min.js"></script>

		<link href="/www/css/bootstrap.min.css" rel="stylesheet">
		<link href="/www/DataTables/media/css/dataTables.bootstrap4.css" rel="stylesheet">
		<link href="/www/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet">
		
		<script>
		$(document).ready(function(){
    		var table = $('#allcomputers').DataTable( {
    			"serverside": false,
				"compact": true,
				"paging": false,
				"lengthchange": false,
				"sScrollY": "600px",
				"scrollX": true,
				"bScrollCollapse": true, 
				"order": [[ 0, "asc" ], [ 1, "asc" ]],
				"dom": "<'row'<'col-sm-6 text-left'Bl><'col-sm-6 text-left'f><'col-sm-3'>>" +
    					"<'row'<'col-sm-12'tr>>" +
    					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				"buttons": [ 'copy', 'excel', 'pdf', 'print', 'colvis']
			} );
			
			table.buttons().container()
    			.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
			
		});
		</script>
    
	</head>
<body>
<div class="container-fluid">
		<h3>All Computers</h3>
		<table id="allcomputers" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
			<thead class="thead-default">
				<tr>
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

				$allcomputers = $db->query("SELECT * FROM computers WHERE Status != 'Damaged' ORDER BY 'Make' ASC");

				foreach($allcomputers as $row)
				{
					print "<tr>";		
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
</body>
</html>