<?php
include_once "databasesettings.php";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Could not connect to server\n";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Successfully connected.\n";

    $userTable = "CREATE TABLE user (
        user_id INT(10) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        user_email VARCHAR(30) NOT NULL,
        user_password VARCHAR(30) NOT NULL
    )";

    if ($conn->query($userTable) === TRUE) {
        echo "User table created successfully.\n";
    } else {
        echo "Error creating user table: " . $conn->error;
    }
}

$conn->close();
