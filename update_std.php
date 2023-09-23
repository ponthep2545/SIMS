<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "students";

$id = $_POST["id"];
$en_name = $_POST["en_name"];
$en_surname = $_POST["en_surname"];
$th_name = $_POST["th_name"];
$th_surname = $_POST["th_surname"];
$major_code = $_POST["major_code"];
$email = $_POST["email"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . mysqli_connect_error())));
}

$sql = "UPDATE std_info SET en_name='$en_name', en_surname='$en_surname', th_name='$th_name', th_surname='$th_surname', major_code='$major_code', email='$email' WHERE id=$id";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array("status" => "success", "message" => "Record updated successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error updating record: " . mysqli_error($conn)));
}

mysqli_close($conn);
?>
