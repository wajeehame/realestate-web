<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
    <style>
        :root {
            --primary-color: #a41083;
            --accent-white: rgba(217, 217, 217, 1);
        }

        body {
            background-color: rgb(167, 166, 166);
            margin: 0;
        }

        input[type="text"] {
            width: 300px;
            height: 30px;
        }

        input[type="submit"] {
            height: 35px;
            width: 70px;
        }

        main {
            max-width: 1200px;
            margin: auto;
            min-height: 95vh;
        }

        form {
            text-align: center;
        }

        .listings {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: space-around;
        }

        .property {
            display: flex;
            width: 500px;
            border-radius: 5px;
            background-color: #A41083;
            padding: 10px;
            justify-content: space-evenly;
            flex-wrap: wrap;
            /* flex-basis: 300px; */
            /* flex-grow: 1; */
            margin: 30px;
        }

        .property-image,
        img {
            width: 100%;
            min-width: 350px;
        }

        .property-details {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            padding: 15px;
            line-height: 2;
            background-color: whitesmoke;
            width: 100%;
        }

        .property-price {
            font-size: 1.8em;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .property-price::after {
            content: ".00";
            font-size: 0.5em;
        }

        .property-location {
            letter-spacing: 2px;
            font-size: 1em;
        }

        .message {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        footer {
            min-height: 190px;
            background-color: var(--primary-color);
            color: white;
        }

        footer ul {
            padding: 50px;
        }

        footer ul li a {
            color: white;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <?php
            session_start();
            if ($_SESSION['username'] && $_SESSION['user_id']) {
                echo '<li><a href="./index.php">Home</a></li>';
                echo '<li><a href="./wishlist.php">Wish List</a></li>';
                echo '<li><a href="./logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="./index.php">Home</a></li>';
                echo '<li><a href="./register.php">Register</a></li>';
                echo '<li><a href="./login.php">Login</a></li>';
            }
            ?>
        </ul>
    </nav>
    <main>

        <?php
        if ($_SESSION['username'] && $_SESSION['user_id']) {

            echo '<form action="./dashboard.php" method="GET">';
            echo '<div>';
            echo '<input type="text" id="search" name="search" placeholder="Search">';
            echo '<input type="submit" value="Search">';
            echo '</div>';
            echo '</form>';

            include_once "databasesettings.php";

            // connect to the database: 
            $con = mysqli_connect($host, $user, $pass, $dbname);

            // check if connection was successful if not exit script: 
            if (mysqli_connect_errno()) {
                echo "<p class='fail'>Failed to connect to database:" . $mysqli_connect_error() . "</p>";
                exit();
            }


            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                // Get the search term from the URL
                $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';


                // prepare the query: 
                // $sql = "SELECT * FROM properties";
                $sql = "SELECT MAX(id) AS id, property_name, location, MAX(price) AS price, MAX(size) AS size, MAX(beds) AS beds, MAX(baths) AS baths, MAX(built_year) AS built_year, MAX(description) AS description, MAX(amenities) AS amenities, MAX(image) AS image
            FROM properties
            WHERE 
            LOWER(location) LIKE LOWER('%$searchTerm%') OR
            LOWER(amenities) LIKE LOWER('%$searchTerm%') OR
            beds = '$searchTerm' OR
            baths = '$searchTerm' OR
            price = '$searchTerm'
            GROUP BY location";

                // get the data from the database table: 
                $result = $con->query($sql);

                // print the data: 
                if ($result->num_rows > 0) {

                    echo "<h1>Listings</h1>";
                    echo "<div class='listings'>";
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="property">';
                        echo '<div class="property-image">';
                        echo '<img src="' . $row['image'] . '" alt="">';
                        echo '</div>';
                        echo '<div class="property-details">';
                        echo '<div class="property-price">$' . $row['price'] . '</div>';
                        echo '<div class="property-location">' . $row['location'] . '</div>';
                        echo '<div class="property-utility">';
                        echo '<span class="num-beds">' . $row['beds'] . '</span><span> bed | </span>';
                        echo '<span class="num-baths">' . $row['baths'] . '</span> bath';
                        echo '</div>';
                        echo '<form action="./property_details.php" method="GET">';
                        echo '<input type="hidden" name="propertyID" value="' . $row["id"] . '">';
                        echo '<input type="submit" value="Details">';
                        echo '</form>';
                        echo '<form action="./addWishlist.php" method="POST">';
                        echo '<input type="hidden" name="propertyID" value="' . $row["id"] . '">';
                        echo '<input type="hidden" name="username" value="' . $_SESSION['username'] . '">';
                        echo '<input type="submit" value="Wish List">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo "</div>";
                } else {
                    echo "<p class='message'>NO PROPERTIES ARE LISTED CURRENTLY.</p>";
                }

                // close database connection: 
                $con->close();
            } else {
                echo '<h1 class="message">You need to login to view this page!</h1>';
            }
        }
        ?>

    </main>
    <?php include_once "footer.php" ?>