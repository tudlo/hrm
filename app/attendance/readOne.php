<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/attendance.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$attendance = new Attendance($db);
 
// set ID property of product to be edited
$attendance->employee = isset($_GET['employee']) ? $_GET['employee'] : die();
 
// read the details of product to be edited
$attendance->readOne();
 
// create array
$attendance_arr = array(
    "id" =>  $attendance->id,
    "employee" => $attendance->employee,
    "in_time" => $attendance->in_time,
    "out_time" => $attendance->out_time,
    "note" => $attendance->note
);
 
// make it json format
print_r(json_encode($attendance_arr));
?>