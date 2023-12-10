<?php
include_once "header.php";
include_once "databasesettings.php";

// Establish database connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$property_ID = $_POST['propertyID'];
$username = $_SESSION['username'];
$deletewish = "DELETE FROM wishlist WHERE property_id = '$property_ID' and username = '$username'";
// DELETE FROM wishlist WHERE property_id = 13 and username = test;

if ($conn->query($deletewish) === TRUE) {
    // echo "wishlist deleted the property successfully.<br>";
    echo "<main>";
    echo "<p class='message'>YOU HAVE DELETED A PROPERTY FROM YOUR WISHLIST.</p>";
    echo "</main>";
    header("refresh:1;url=wishlist.php");
} else {
    echo "Error deleting wishlist item: " . $conn->error . "<br>";
    echo "<h2>Back to wishlist: <a href='./wishlist.php'>Wishlist</a></h2>";
}

// Close the connection
$conn->close();
include_once "footer.php";
