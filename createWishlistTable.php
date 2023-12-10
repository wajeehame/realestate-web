<?php
include_once "databasesettings.php";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Could not connect to server\n";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Successfully connected.\n";

    $wishlistTable = "CREATE TABLE wishlist (
        id INT(10) AUTO_INCREMENT PRIMARY KEY,
        property_id VARCHAR(30) NOT NULL,
        username VARCHAR(30) NOT NULL
    )";

    if ($conn->query($wishlistTable) === TRUE) {
        echo "Wishlist table created successfully.\n";
    } else {
        echo "Error creating table for wishlist: " . $conn->error;
    }
}

$conn->close();
