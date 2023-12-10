<?php
include_once "header.php";
include_once "databasesettings.php";


// Establish database connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$addwish = "INSERT INTO wishlist (property_ID, username) VALUES ('" . $_POST['propertyID'] . "','" . $_POST['username'] . "')";

if ($conn->query($addwish) === TRUE) {
    // echo "wishlist added new property successfully.<br>";
    echo "<main>";
    echo "<p class='message'>YOU HAVE ADDED A NEW PROPERTY TO YOUR WISHLIST.</p>";
    echo "</main>";
    header("refresh:1;url=wishlist.php");
} else {
    echo "Error inserting wishlist item: " . $conn->error . "<br>";
    echo "<h2>Back to wishlist: <a href='./wishlist.php'>Wishlist</a></h2>";
}

// Close the connection
$conn->close();
include_once "footer.php";
