<?php
class Attendance{
 
    // database connection and table name
    private $conn;
    private $table_name = "Attendance";
 
    // object properties
    public $id;
    public $employee;
    public $in_time;
    public $out_time;
    public $note;
    public $image_in;
    public $image_out;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read Attendances
    function readOne(){
 
        // query to read single record
        $query = "SELECT
                   *
                FROM
                    " . $this->table_name . " 
                WHERE
                    employee = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $stmt->bindParam(1, $this->employee);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->id = $row['id'];
        $this->employee = $row['employee'];
        $this->in_time = $row['in_time'];
        $this->out_time = $row['out_time'];
        $this->note = $row['note'];
    }

    // create Attendance
    function punchIn(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    employee=:employee, in_time=:in_time, note=:note";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->employee=htmlspecialchars(strip_tags($this->employee));
        $this->in_time=htmlspecialchars(strip_tags($this->in_time));
        $this->note=htmlspecialchars(strip_tags($this->note));
    
        // bind values
        $stmt->bindParam(":employee", $this->employee);
        $stmt->bindParam(":in_time", $this->in_time);
        $stmt->bindParam(":note", $this->note);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    

// update the Attendance
function punchOut(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                out_time = :out_time,
                note = :note
            WHERE
                employee = :employee";
                
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->in_time=htmlspecialchars(strip_tags($this->in_time));
    $this->employee=htmlspecialchars(strip_tags($this->employee));
    $this->out_time=htmlspecialchars(strip_tags($this->out_time));
    $this->note=htmlspecialchars(strip_tags($this->note));
 
    // bind new values
    $stmt->bindParam(':employee', $this->in_time);
    $stmt->bindParam(':employee', $this->employee);
    $stmt->bindParam(':out_time', $this->out_time);
    $stmt->bindParam(':note', $this->note);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
}