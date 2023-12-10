<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
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
                echo '<li><a href="./dashboard.php">Dashboard</a></li>';
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
            include_once "databasesettings.php";

            // connect to the database: 
            $con = mysqli_connect($host, $user, $pass, $dbname);

            // check if connection was successful if not exit script: 
            if (mysqli_connect_errno()) {
                echo "<p class='fail'>Failed to connect to database:" . $mysqli_connect_error() . "</p>";
                exit();
            }

            // prepare the query: 
            $username = $_SESSION['username'];
            // $checkUser = "SELECT user_id, username, user_password FROM user WHERE username = '$username'";

            $sql = "SELECT * FROM properties WHERE id = (SELECT property_id FROM wishlist WHERE username = '$username')";

            // get the data from the database table: 
            $result = $con->query($sql);

            echo "<h1>My Wishlist</h1>";
            // print the data: 
            if ($result->num_rows > 0) {

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
                    echo '<form action="./deleteWishlist.php" method="POST">';
                    echo '<input type="hidden" name="propertyID" value="' . $row["id"] . '">';
                    echo '<input type="submit" value="Remove">';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p class='message'>YOU HAVE NOT WISH LISTED ANY PROPERTIES.</p>";
            }

            // close database connection: 
            $con->close();
        } else {
            echo '<h1 class="message">You need to login to view this page!</h1>';
        }
        ?>

    </main>
    <?php include_once "footer.php" ?>