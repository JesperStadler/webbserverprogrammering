<?php
$servername = "localhost"; // kopplar till din lokala databas som körs i xampp
$username = "root";
$password = "";
$db = "myDB"; //använd namnet på din databas

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";



$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - username: " . $row["username"] . " name: " . $row["name"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
