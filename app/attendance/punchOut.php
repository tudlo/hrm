<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/attendance.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$attendance = new Attendance($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
// $attendance->in_time = $data->in_time;
 
// set attendance property values
$attendance->in_time = $data->in_time;
$attendance->employee = $data->employee;
$attendance->out_time = $data->out_time;
$attendance->note = $data->note;
 
// update the attendance
if($attendance->punchOut()){
    echo '{';
        echo '"message": "Punched out success"';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to punch out."';
    echo '}';
}
?>