<?php 

	$db = new PDO('sqlite:../../../db/Inventory.db');
	
	$UserID = $_GET['ID'];
	
	$GetName = $db->query("SELECT FirstName, LastName FROM users WHERE ID ='$UserID'");
	$FirstNameLastName = $GetName->fetchall(PDO::FETCH_ASSOC);
	foreach( $FirstNameLastName as $name ){
		$FullName = $name['FirstName']." ".$name['LastName'];
	}

?>

<html>
	<table>
		<tr>
			<th><?php print $FullName; ?></th>
		</tr>
		<td>
		 	HI
		</td>
	</table>
</html>










