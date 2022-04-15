<?php 
    class Database {
        private $host = "109.234.161.150";
        private $database_name = "dhqm1449_estelleG";
        private $username = "dhqm1449_estelleG";
        private $password = "nJbTCMDmBP2Y";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>