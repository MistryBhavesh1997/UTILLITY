<?php
include("db_config.php");
class DB_Connect{

	public  $con1;
    // constructor
    function __construct() {
	 $this->connect();
    }
 
    // destructor
    function __destruct() {
        // $this->close();
    }
 
    // Connecting to database
    public function connect() {

        // connecting to mysql
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die("Connection Failed!");
        // selecting database
        mysqli_select_db($con,DB_DATABASE);
		$this->con1=$con;
 
        // return database handler
        return $con;
    }

    // Closing database connection
    public function mysqlQuery($query) {
		$res=mysqli_query($this->con1,$query);
		return $res;
    }

    public function mysqlIQuery($query) {
        $res=mysqli_query($this->con1,$query);
        $id=mysqli_insert_id($this->con1);
        return $id;
    }
}
?>