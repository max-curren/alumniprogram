<?php
	class Database
	{
		private $host = getenv('IP');
		private $port = 3306;
		private $user = "maxwellthecoder";
		private $pass = "";
		private $dbName = "c9";

		function connectToDB()
		{
			try
			{
				return new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbName", $this->user, $this->pass);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}



	}
?>