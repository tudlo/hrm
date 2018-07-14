<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/attendance.php';
 
$database = new Database();
$db = $database->getConnection();
 
$attendance = new Attendance($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$attendance->employee = $data->employee;
$attendance->in_time = $data->in_time;
$attendance->note = $data->note;
 
// create the product
if($attendance->punchIn()){
    echo '{';
        echo '"message": "Punched in!."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to Punch in."';
    echo '}';
}
?>