<?php include(INCLUDES ."activateDatatable.php"); ?>

<body>
<div class="container-fluid">
	<h3>All HE Users</h3>
	<table id="datatable" class="table table-sm table-bordered table-striped table-hover display nowrap" width="100%" style="font-size:15px">
		<thead>
			<tr>
				<th>Edit</th>
				<th>User Name</th>
				<th>Department</th>
				<th>AD Account</th>
				<th>Desk Phone</th>
				<th>Cell Phone</th>
				<th>Position</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$db = new PDO('sqlite:db/Inventory.db');
	
				if(!$db){
				  echo $db->lastErrorMsg();
				} else {

			$allusers = $db->query("SELECT * FROM users ORDER BY 'FirstName' ASC");

			foreach($allusers as $row)
			{
				print "<tr>";
				print "<td>";
				print "<form class='form-inline' style='padding:0; margin:0'>";
				print "<div class='form-group'>";
				print "<form action='www/php/users/edituserhe.php' method='POST' style='padding:0; margin:0'>";
				print "<a data-toggle='modal' href='www/php/users/edituserhe.php?ID=".$row['ID']."' data-target='#editmodal'><span class='glyphicon glyphicon-edit'></span> </a>";
				print "<a href='#' id='popover' data-toggle='popover' data-trigger='hover' data-poload='www/php/users/assigned.php?ID=".$row['ID']."'><span class='glyphicon glyphicon-info-sign'></span> </a>";
				print "</div>";
				print "</form>";
				print "</td>";
		
				$FNameLName = $db->query('SELECT FirstName, LastName FROM users WHERE ID = '.$row['ID']);
				$CombinedName = $FNameLName->fetchall(PDO::FETCH_ASSOC);
					foreach($CombinedName as $person)
					{
						$FullName = "$person[FirstName] $person[LastName]";
						print "<td>".$FullName."</td>";
					}
			
				$CellPhone = NULL;
		
				$AssignedMobile = $db->query('SELECT PhoneNumber FROM mobile WHERE Model NOT LIKE "%iPad%" AND AssignedTo = '.$row['ID']);
				$CellPhoneNumber = $AssignedMobile->fetchall(PDO::FETCH_ASSOC);
		
				if( ($CellPhoneNumber != NULL) || ($CellPhoneNumber != "") ){
					foreach($CellPhoneNumber as $number){
						$CellPhone = $number['PhoneNumber'];
					}
				} else {
					$CellPhone = "";
				}
		
				print "<td>".$row['Department']."</td>";
				print "<td>".$row['ADAccount']."</td>";
				print "<td>".$row['DeskPhone']."</td>";
				print "<td>".$CellPhone."</td>";
				print "<td>".$row['Position']."</td>";
				print "<td>".$row['Notes']."</td>";
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

<script>
	$("#editmodal").on('hidden.bs.modal', function () {
    	$(this).data('bs.modal', null);
	});
	
	
	
	$('*[data-poload]').hover(function() {
    	var e=$(this);
    	e.off('hover');
    	$.get(e.data('poload'),function(d) {
        	e.popover({html: true, content: d}).popover('show');
    	});
	});
	
</script>

</body>
</html>