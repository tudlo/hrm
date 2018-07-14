<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/attendance.php';
 
// instantiate database and attendance object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$attendance = new Attendance($db);
 
// query attendance
$stmt = $attendance->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // attendance array
    $attendance_arr=array();
    $attendance_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $attendance_item=array(
            "id" => $id,
            "employee" => $employee,
            "in_time" => $in_time,
            "out_time" => $out_time,
            "note" => $note,
            "image_in" => $image_in,
            "image_out" => $image_out
        );
 
        array_push($attendance_arr["records"], $attendance_item);
    }
 
    echo json_encode($attendance_arr);
}
 
else{
    echo json_encode(
        array("message" => "No attendance found.")
    );
}
?>