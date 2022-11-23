<?php




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM users";
$result = $conn->query($sql);


$login_success = false;
$full_name = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (
            $row["username"] == $_POST["username"] &&
            $row["password"] == $_POST["password"]
        ) {
            $login_success = true;
            echo 'Välkommen ', $_POST['username'];
        }
    }
} else {
    echo "login fail";
}
$conn->close();
if ($login_success) {
    session_start();
    $_SESSION["username"] = $_POST["username"];
}
echo "<a href='upload.html'>Ladda upp fil</a>";
