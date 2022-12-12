<?
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql";
$conn = new mysqli($servername, $username, $password, $dbname);




$name = $_POST["name"];
$email = $_POST["email"];
$homepage = $_POST["homepage"];
$comment = $_POST["comment"];
$sql = "INSERT INTO Guestbook (name, email, homepage, comment, time) VALUES ('$name', '$email', '$homepage', '$comment', now())";
$conn->query($sql);

$output = "SELECT * From guestbook ORDER BY id";
$result = $conn->query($output);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "-name: " . $row["name"] . "<br>" . "comment_:" . $row["comment"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
