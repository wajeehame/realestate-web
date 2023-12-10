<?php

include_once "databasesettings.php";

// Establish database connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the 'properties' table
$createPropertiesTable = "CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    size INT NOT NULL,
    beds INT NOT NULL,
    baths INT NOT NULL,
    built_year INT NOT NULL,
    description TEXT,
    amenities TEXT,
    image VARCHAR(255) NOT NULL
)";

if ($conn->query($createPropertiesTable) === TRUE) {
    echo "Table 'properties' created successfully.<br>";

    // Insert sample data into the 'properties' table
    $insertSampleData = "INSERT INTO properties (property_name, location, price, size, beds, baths, built_year, description, amenities, image) VALUES
        ('Fort Nine 38, Bills Ave', 'New Jersey', 2000000.00, 5000, 5, 4, 2010, 'A luxurious villa with beautiful views.', 'Swimming Pool, Garden, Garage', 'images/house1.jpg'),
        ('485 Liberty Pkwy', 'Atlanta', 750000.00, 3126, 3, 2, 2015, 'A stylish modern home in the heart of Atlanta.', 'Balcony, Gym, Parking', 'images/house2.jpg'),
        ('732 Paradise Valley', 'Arizona', 3000000.00, 5136, 7, 6, 2008, 'A palatial mansion adorned with expansive grounds, and luxurious amenities in a peaceful neighborhood.', 'Fireplace, Garden, Patio', 'images/house3.jpg'),
        ('157 Ocean Bright Point', 'Los Angeles', 799000.00, 1582, 2, 1, 1995, 'A cozy cottage in a peaceful neighborhood around the bay area.', 'Petspaces, Huge Driveway, Patio', 'images/house4.jpg'),
        ('101 W Linn St', 'Pennsylvania', 1000000.00, 4532, 6, 4, 2018, 'A sprawling mansion adorned with landscaped gardens and offering breathtaking views of the countryside. ', 'Swimming pool, Huge Driveway, Playground', 'images/house5.jpg')";

    if ($conn->query($insertSampleData) === TRUE) {
        echo "Sample data inserted successfully.<br>";
    } else {
        echo "Error inserting sample data: " . $conn->error . "<br>";
    }
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>
