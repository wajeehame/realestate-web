<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF =8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body class="background">
    <nav>
        <ul>
            <?php
            session_start();
            if ($_SESSION['username'] && $_SESSION['user_id']) {
                echo '<li><a href="./dashboard.php">Dashboard</a></li>';
                echo '<li><a href="./wishlist.php">Wish List</a></li>';
                echo '<li><a href="./logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="./index.php">Home</a></li>';
                echo '<li><a href="./register.php">Register</a></li>';
            }
            ?>
        </ul>
    </nav>
    <main>
        <form action="" method="post" id="login">
            <div class="login">
                <h1>Login</h1>
                <label for="username">Username:</label>
                <br>
                <input type="text" id="username" name="username" minlength="3" maxlength="30" required>

                <label for="password">Password:</label>
                <br>
                <input type="password" id="password" name="password" minlength="3" maxlength="30" required>

                <button type="submit">Login</button>
                <a href="register.php">Don't have an account? Register</a>
                 <?php
        include_once "databasesettings.php";

        $conn = new mysqli($host, $user, $pass, $dbname);

        // Check connection
        if ($conn->connect_error) {
            echo "Could not connect to server\n";
            die("Connection failed: " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);

            //form validations: 
            if (empty($username) || empty($password)) {
                echo "<p> Both username and password are required.</p>";
            } else {
                $checkUser = "SELECT user_id, username, user_password FROM user WHERE username = '$username'";
                $resultUser = $conn->query($checkUser);
                //verification
                if ($resultUser->num_rows > 0) {
                    $row = $resultUser->fetch_assoc();
                    $user_password = $row["user_password"];

                    if ($password === $user_password) {
                        $_SESSION['user_id'] = $row["user_id"];
                        $_SESSION['username'] = $row["username"];
                        echo "<p class='green'> Login successful!";
                        header("refresh:3;url=dashboard.php"); //url=dashboard.php
                    } else {
                        echo "<p class='red'> Invalid password.</p>";
                    }
                } else {
                    echo "<p class='red'> User not found. Please check your username.</p>";
                }
            }
        }
        ?>
            </div>
        </form>
       
    </main>
    <?php include_once "footer.php" ?>