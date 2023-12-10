<!-- property_listing.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listing</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .property-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .property {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .property img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }
    </style>
</head>

<body>

    <div class="property-container">
        <?php
        include_once "databasesettings.php";

        // Establish database connection
        $conn = new mysqli($host, $user, $pass, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve data from the 'properties' table
        $property_ID = $_GET['propertyID'];
        $selectProperties = "SELECT * FROM properties WHERE id = '$property_ID'";
        $result = $conn->query($selectProperties);
       
        // Display data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="property">';
                echo '<h2>' . $row['property_name'] . '</h2>';
                echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                echo '<p><strong>Price:</strong> $' . number_format($row['price'], 2) . '</p>';
                echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                echo '<img src="' . $row['image'] . '" alt="Property Image">';
                echo '</div>';
            }
        } else {
            echo '<p>No properties found.</p>';
        }
        $conn->close();
        ?>

    </div>

</body>

</html>