<?php
$student_id = $_POST["student_id"];

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "students";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM `std_info` WHERE `id` = '$student_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "success";
} else {
    echo "error";
}

mysqli_close($conn);
?>