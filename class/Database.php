<?php
	class Database
	{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $dbName = "alumni";

		function connectToDB()
		{
			try
			{
				return new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->pass);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}



	}
?>