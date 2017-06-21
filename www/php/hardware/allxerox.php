<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid">
		<h3>All Printers</h3>
		<table id="datatable" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
			<thead>
				<tr>
					<th>Edit</th>
					<th>Make</th>
					<th>Model</th>
					<th>Serial Number</th>
					<th>Printer Name</th>
					<th>Location</th>
					<th>IP Address</th>
					<th>MAC Address</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$db = new PDO('sqlite:db/Inventory.db');
	
				if(!$db){
				  echo $db->lastErrorMsg();
				} else {

				$allprinters = $db->query("SELECT * FROM printers ORDER BY 'Model' ASC");

				foreach($allprinters as $row)
				{
					print "<tr>";
					print "<td>";
					print "<form class='form-inline' style='padding:0; margin:0'>";
					print "<div class='form-group'>";
					print "<form action='www/php/hardware/editprinter.php' method='POST' style='padding:0; margin:0'>";
					print "<a data-toggle='modal' href='www/php/hardware/editprinter.php?ID=".$row['ID']."' data-target='#editmodal'><span class='glyphicon glyphicon-edit'></span> </a>";
					print "</form>";
					print "<a href='http://".$row['IPAddress']."' target='_blank'><span class='glyphicon glyphicon-info-sign'></span> </a>";
					print "</div>";
					print "</form>";
					print "</td>";
					print "<td>".$row['Make']."</td>";
					print "<td>".$row['Model']."</td>";
					print "<td>".$row['SerialNumber']."</td>";
					print "<td>".$row['PrinterName']."</td>";
					print "<td>".$row['Location']."</td>";
					print "<td>".$row['IPAddress']."</td>";
					print "<td>".$row['MACAddress']."</td>";
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