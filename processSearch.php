<?php

	if(isset($_POST["isValidRequest"]))
	{
		$terms = $_POST["terms"];

		include "class/Search.php";
		$searchObj = new Search;
		
		$searchObj->setTerms($terms);
		$results = $searchObj->searchForTerms();

		if($results !== false)
		{
			echo json_encode($results);
		}
		else
		{
			echo "false";
		}
	}

?>