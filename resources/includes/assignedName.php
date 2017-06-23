<?php

	$FieldInfo = $db->query('SELECT ID, FieldType, FieldNumber FROM field ORDER BY FieldType ASC, FieldNumber ASC');
	$AllField = $FieldInfo->fetchall(PDO::FETCH_ASSOC);
	
	$UserInfo = $db->query('SELECT ID, FirstName, LastName FROM users ORDER BY FirstName ASC');
	$AllUsers = $UserInfo->fetchall(PDO::FETCH_ASSOC);	
		
	if (stripos($AssignedTo, "field") !== false) {
	
		$AssignedFieldID = substr($AssignedTo, 5);
		$AssignedFieldUser = $db->query('SELECT ID, FieldType, FieldNumber FROM field WHERE ID = '.$AssignedTo);
		$AssignedFieldName = $AssignedFieldUser->fetchall(PDO::FETCH_ASSOC);
		
		foreach ($AssignedFieldName as $field)
		{
			$AssignedToName = "$field[FieldType]$field[FieldNumber]";
		}
	
	} elseif ( isnumberic($AssignedTo) ) {
	
		$AssignedUser = $db->query('SELECT ID, FirstName, LastName FROM users WHERE ID = '.$AssignedTo);
		$UserName = $AssignedUser->fetchall(PDO::FETCH_ASSOC);
	
		foreach($UserName as $name)
		{
			$AssignedToName = "$name[FirstName] $name[LastName]";
		}
	}
		
	} else {
	
		$AssignedToName = "Open";

?>