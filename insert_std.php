<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $en_name = $_POST["en_name"];
    $en_surname = $_POST["en_surname"];
    $th_name = $_POST["th_name"];
    $th_surname = $_POST["th_surname"];
    $major_code = $_POST["major_code"];
    $email = $_POST["email"];
    
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "students";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }
    
    $sql = "INSERT INTO `std_info` (`id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email`) VALUES ('$id', '$en_name', '$en_surname', '$th_name', '$th_surname', '$major_code', '$email')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
    
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>