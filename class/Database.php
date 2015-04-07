<?php
	class Database
	{
		private $host = "localhost";
		private $dbName = "alumni";
		private $user = "root";
		private $pass = "password";

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