<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF =8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css">
</head>
<nav>
    <ul>
        <?php
        session_start();
        if ($_SESSION['username'] && $_SESSION['user_id']) {
            echo '<li><a href="./dashboard.php">Dashboard</a></li>';
            echo '<li><a href="./wishlist.php">Wish List</a></li>';
            echo '<li><a href="./logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="./register.php">Register</a></li>';
            echo '<li><a href="./login.php">Login</a></li>';
        }
        ?>
    </ul>
</nav>
<main>
    <div class="logo">
        <img src="./images/house.png" alt="">
    </div>
    <div class="company">
        <div class="company-card">
            <p class="company-card-title">What does your company do?</p>
            <p class="company-card-content">Our platform serves as a bridge, connecting discerning prospective home buyers with a select group of sellers offering an exquisite collection of beautiful estates. Through our user-friendly interface, buyers can explore a diverse range of properties, each with its own unique charm and appeal. Our dedicated sellers are able to showcase their properties in all their splendor, and closely monitor the entire sales process, ensuring that both buyers and sellers experience a seamless and transparent transaction.</p>
        </div>
        <div class="company-card">
            <p class="company-card-title">What kind of services do you provide?</p>
            <p class="company-card-content">The platform provides a seamless connection for discerning buyers to access an exclusive list of private sellers offering a diverse range of properties. Sellers are empowered to showcase their properties and monitor their sales, ensuring a smooth and transparent selling process. The platform's services aim to enhance the buying and selling experience by facilitating direct communication and efficient property management for both buyers and sellers.</p>
        </div>
        <div class="company-card">
            <p class="company-card-title">Why do they have to choose you over your competitors?</p>
            <p class="company-card-content">The platform provides access to exclusive sellers who uphold integrity and the value of their property. Sellers are equipped with the ability to easily manage and list their properties for sale. They can utilize our simple and intuitive interface to upload high-quality images of their properties, connect with prospective home buyers, and manage all of their listings. This comprehensive set of services aims to streamline the selling process for our valued sellers, ensuring a seamless and efficient experience while maximizing the exposure of their properties to potential buyers.</p>
        </div>
        <div class="company-card">
            <p class="company-card-title">Anything that you do as a business to attract customers?</p>
            <p class="company-card-content">Our platform appeals to a diverse range of buyers, from the contemporary homeowner to the more modern homeowner. We offer detailed property listings that include information such as total bathrooms, bedrooms, yard size, distance from shopping centers, and more. This comprehensive approach aims to provide buyers with the information they need to make informed decisions and find the perfect property to suit their needs and preferences.</p>
        </div>
    </div>
</main>
<?php include_once "footer.php" ?>