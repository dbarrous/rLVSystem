<?php
require "db.php";

$email = $_GET['email'];
$sql = "UPDATE users SET confNum=1 WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php?account=confirmed");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
