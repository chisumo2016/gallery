
<?php 

require_once("new_config.php");

class Database {


	public $connection;

	function __construct(){

     $this->open_db_connection(); // Open our connection automatically


	}

	public function open_db_connection(){
// $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if($this->connection->connect_errno) {

	die("Database connection failed badly" . $this->connection->connect_error);

            }

    }

    // Query
    
    public function query($sql){
        
        $result= mysqli_query($this->connection,$sql);
        
        return $result;
    }

    private function confirm_query($result){
        if(!$result){
            
            die("Query Failed");
           }
        
         }
          //Escape string  to clean our dabatabase
        public function escape_string($string) {
        $escaped_string = $this->connection->real_escape_string($string);
         //$escaped_string = $mysqli_real_string($this->connection,$string);
        return $escaped_string;
        }
    
    // Insert the user id into the database
    public function the_insert_id(){
        
        return mysqli_insert_id($this->connection);
    }

}  // End of Class Database


$database = new Database();

 ?>