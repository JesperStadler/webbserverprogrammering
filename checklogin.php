<?php
session_start();
if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    echo "Du är inloggad som " . $_SESSION["username"];
} else {
    echo "Du är inte inloggad.";
}
?>
<a href="logout.php"> Click here to logout.</a>