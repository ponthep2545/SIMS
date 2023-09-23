<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "students";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}

echo "Connected successfully</br>";
$sql = "SELECT * FROM `std_info`";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteRow(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    type: "POST",
                    url: "delete_std.php",
                    data: { student_id: id }, 
                    success: function(response) {
                        if (response == "success") {
                            alert("Record deleted successfully.");
                            location.reload();
                        } else {
                            alert("Error deleting record.");
                        }
                    },
                    error: function() {
                        alert("Error deleting record.");
                    }
                });
            }
        }
    </script>
</head>
<body>
    <h1>Student Information Management System</h1>

    <?php
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>id</th><th>name</th><th>surname</th>";
            echo "<th>ชื่อ</th><th>นามสกุล</th>";
            echo "<th>Major</th><th>email</th><th>Action</th><th>Action</th></tr>"; // Add an "Action" column
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["en_name"] . "</td>";
                echo "<td>" . $row["en_surname"] . "</td>";
                echo "<td>" . $row["th_name"] . "</td>";
                echo "<td>" . $row["th_surname"] . "</td>";
                echo "<td>" . $row["major_code"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                // Add a "Delete" link/button that calls a JavaScript function
                echo "<td><a href='javascript:void(0);' onclick='deleteRow(" . $row["id"] . ")'>Delete</a></td>";
                echo "<td><a href='update_std_form.php?id=" . $row["id"] . "'>Update</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    echo "<a href='insert_std_form.html'>Insert new record</a>";

    mysqli_close($conn);
    ?>
</body>
</html>
