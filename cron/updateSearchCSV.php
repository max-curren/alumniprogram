<?php
	
	include "../class/Database.php";
	$dbObj = new Database;
	$dbConnection = $dbObj->connectToDB();

	$getUsersQuery = $dbConnection->prepare("SELECT userID, firstName, lastName, gradYear FROM users");

	if($getUsersQuery->execute())
	{
		$results = $getUsersQuery->fetchAll(PDO::FETCH_ASSOC);

		$csvHandle = fopen("../search.csv", "a");

		foreach($results as $fields)
		{
			fputcsv($csvHandle, $fields);
		}

		fclose($csvHandle);
	}
	else
	{

	}

?>