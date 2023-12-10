<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF =8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
                echo '<li><a href="./login.php">Login</a></li>';
            }
            ?>
        </ul>
    </nav>
    <main>
        <form action="" method="post" id="register">

            <div class="login">
                <h1>Register</h1>
                <label for="username">Username:</label>
                <br>
                <input type="text" id="username" name="username" minlength="3" maxlength="30" required>

                <label for="email">Email:</label>
                <br>
                <input type="email" id="email" name="email" minlength="3" maxlength="30" required>

                <label for="password">Password:</label>
                <br>
                <input type="password" id="password" name="password" minlength="3" maxlength="30" required>

                <label for="confirm">Confirm Password:</label>
                <br>
                <input type="password" id="confirm" name="confirm" minlength="3" maxlength="30" required>

                <button type="submit">Register</button>
                <a href="login.php">Already have an account? Login</a>
                <?php
include_once "databasesettings.php";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Could not connect to server\n";
    die("Connection failed: " . $conn->connect_error);
    // include_once "footer.php";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $confirm = htmlspecialchars($_POST["confirm"]);

        //form validations: 
        if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
            echo "<p class='red'> All fields are required.";
        } elseif ($password !== $confirm) {
            echo "<p class='red'> Password and Confirm Password do not match.";
        } else {
            $checkUser = "SELECT user_id FROM user WHERE username = '$username'";
            $checkEmail = "SELECT user_id FROM user WHERE user_email = '$email'";
            $resultUser = $conn->query($checkUser);
            $resultEmail = $conn->query($checkEmail);

            if ($resultUser->num_rows > 0) {
                echo "<p class='red'> Username already taken, Please choose another.";
            } elseif ($resultEmail->num_rows > 0) {
                echo "<p class='red'> Email is already registered. Please use another email";
            } else {
                $insertUser = "INSERT INTO user (username, user_email, user_password) VALUES ('$username', '$email', '$password')";
                if ($conn->query($insertUser) === TRUE) {
                    // $_SESSION['user_id'] = $conn->insert_id;
                    // $_SESSION['username'] = $username;
                    echo "<p class='green'> Registration successful!";
                    header("refresh:3;url=login.php");
                } else {
                    echo "Error: " . $insertUser . $conn->error;
                }
            }
        }
    }
}
$conn->close();
?>

            </div>
        </form>
    </main>
    <?php include_once "footer.php" ?>
</body>

</html>



