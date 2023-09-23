<?php
$id = $_GET["id"];
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "students";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}

$sql = "SELECT * FROM std_info WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateStudent() {
            var formData = {
                id: <?php echo $row["id"]; ?>,
                en_name: $("#en_name").val(),
                en_surname: $("#en_surname").val(),
                th_name: $("#th_name").val(),
                th_surname: $("#th_surname").val(),
                major_code: $("#major_code").val(),
                email: $("#email").val()
            };

            $.ajax({
                type: "POST",
                url: "update_std.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        alert(response.message);
                        // Redirect or perform other actions as needed
                        window.location.href = "student.php";
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("An error occurred during the update process.");
                }
            });
        }
    </script>
</head>
<body>
    <form method="post">
        id: <input type="text" name="id" value="<?php echo $row["id"]; ?>" readonly><br>
        name: <input type="text" id="en_name" name="en_name" value="<?php echo $row["en_name"]; ?>"><br>
        surname: <input type="text" id="en_surname" name="en_surname" value="<?php echo $row["en_surname"]; ?>"><br>
        ชื่อ: <input type="text" id="th_name" name="th_name" value="<?php echo $row["th_name"]; ?>"><br>
        นามสกุล: <input type="text" id="th_surname" name="th_surname" value="<?php echo $row["th_surname"]; ?>"><br>
        Major: <input type="text" id="major_code" name="major_code" value="<?php echo $row["major_code"]; ?>"><br>
        Email: <input type="text" id="email" name="email" value="<?php echo $row["email"]; ?>"><br>
        <button type="button" onclick="updateStudent()">Update</button>
        <input type="reset" value="Reset">
    </form>
</body>
</html>
