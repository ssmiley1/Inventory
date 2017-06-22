<link href="/www/css/bootstrap.min.css" rel="stylesheet">

<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$UserID = $_GET['ID'];
	
	$GetName = $db->query("SELECT FirstName, LastName FROM users WHERE ID ='$UserID'");
	$FirstNameLastName = $GetName->fetchall(PDO::FETCH_ASSOC);
	foreach( $FirstNameLastName as $name ){
		$FullName = $name['FirstName']." ".$name['LastName'];
	}
	
	$AssignedComputers = $db->query("SELECT Make, Model, SerialNumber, AssetTag FROM computers WHERE AssignedTo = '$UserID'");
	$AssignedMobile = $db->query("SELECT Make, Model, SerialNumber, AssetTag FROM mobile WHERE AssignedTo = '$UserID'");
	$AssignedAccessories = $db->query("SELECT Make, Model, SerialNumber, AssetTag, Description FROM accessories WHERE AssignedTo = '$UserID'");

?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Equipment assigned to <?php echo $FullName; ?></h4>
</div>
	<div class="modal-body">
		<div class="panel panel-default" style="width:100%">
			<div class="panel-heading" style="text-align:left">Computers</div>
				<table class="table table-sm">
					<thead>
						<tr>
							<th>Make</th>
							<th>Model</th>
							<th>Serial Number</th>
							<th>Asset Tag</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach( $AssignedComputers as $computer ){
								print "<tr>";
								print "<td>".$computer['Make']."</td>";
								print "<td>".$computer['Model']."</td>";
								print "<td>".$computer['SerialNumber']."</td>";
								print "<td>".$computer['AssetTag']."</td>";
								print "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="modal-body">
		<div class="panel panel-default" style="width:100%">
			<div class="panel-heading" style="text-align:left">Mobile</div>
				<table class="table table-sm">
					<thead>
						<tr>
							<th>Make</th>
							<th>Model</th>
							<th>Serial Number</th>
							<th>Asset Tag</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach( $AssignedMobile as $mobile ){
								print "<tr>";
								print "<td>".$mobile['Make']."</td>";
								print "<td>".$mobile['Model']."</td>";
								print "<td>".$mobile['SerialNumber']."</td>";
								print "<td>".$mobile['AssetTag']."</td>";
								print "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="modal-body">
		<div class="panel panel-default" style="width:100%">
			<div class="panel-heading" style="text-align:left">Accessories</div>
				<table class="table table-sm">
					<thead>
						<tr>
							<th>Make</th>
							<th>Model</th>
							<th>Serial Number</th>
							<th>Description</th>
							<th>Asset Tag</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach( $AssignedAccessories as $accessory ){
								print "<tr>";
								print "<td>".$accessory['Make']."</td>";
								print "<td>".$accessory['Model']."</td>";
								print "<td>".$accessory['SerialNumber']."</td>";
								print "<td>".$accessory['Description']."</td>";
								print "<td>".$accessory['AssetTag']."</td>";
								print "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
<div class="modal-body">
	<div class="row">
		<div class="form-group">
			<div class="col-xs-12">
				<button type="submit" class="btn btn-success pull-right" name="PrintButton" onclick="printDiv('assignedmodal')">Print</button>
			</div>
		</div>
	</div>
</div>











