<?php
    
    class Search
    {
        
        private $terms;
        
        function setTerms($terms)
        {
            $this->terms = $terms;
        }
        
        function searchForTerms()
        {
            include_once "Database.php";
            $dbObj = new Database;
            $dbConnection = $dbObj->connectToDB();

            $quotedTerms = $dbConnection->quote($this->terms . "*");
            $searchDBQuery = $dbConnection->prepare("SELECT userID, firstName, lastName, gradYear, city, state, job, profilePic FROM users WHERE MATCH (firstName, lastName) AGAINST ($quotedTerms IN BOOLEAN MODE)");
            
            //$searchDBQuery = $dbConnection->prepare("SELECT userID, firstName, lastName, gradYear, city, state, job FROM users WHERE firstName LIKE '%$this->terms%'");

            $searchDBQuery->bindParam(":terms", $this->terms);

            if($searchDBQuery->execute())
            {
                $results = $searchDBQuery->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            }
            else
            {
                return false;
            }
        }
        
    }
    
?>