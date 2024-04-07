<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/css/styles.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<?php include '../web/header.php'; ?>
    
<div class="body_container">

    <div class="log_container">
        <h2>Login</h2>
        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: red;">' . $_GET['error'] . '</p>';
            }
            ?>
        <form action="seller_login_process.php" method="POST">
            <input type="email" name="email" placeholder="Author Email" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account yet? <a href="./sellersignup.php">Sign up here</a></p>
    </div>
    </div>
    <footer> 
        <p>&copy; 2024 Arcane-Reads. All rights reserved.</p>
    </footer>
</body>
</html>
