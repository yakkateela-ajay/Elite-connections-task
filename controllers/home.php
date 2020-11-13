<?php
date_default_timezone_set('Asia/Calcutta'); 
class Home 
{  //Home.php Controller Class  

    public $db;

    public function __construct() {
        $this->db = $this->connect_db();
    }

    public function __distruct() {
        $this->db = $this->clode_db();
    }

    function connect_db() {
        // Create connection
        $_conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($_conn->connect_error) {
            die("Connection failed: " . $_conn->connect_error);
        }
        return $_conn;
    }

    function clode_db($obj) {
        return $obj->close();
    }

    //Queries//

    function get_records($query)
    {
        $rows_array = array();
        $results = $this->db->query($query);
        if (!empty($results) && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $rows_array[] = $row;
            }
        }
        return $rows_array;
    }

    function get_count($query) {
        $results = $this->db->query($query);
        if (!empty($results) && $results->num_rows > 0) {
            return $results->num_rows;
        }
        return 0;
    }

    //End of Queries//

    function index() {
        $responseArray = array('status' => 200, 'message' => 'try other cool services.');
        echo json_encode($responseArray);
    }

//total main close
 }