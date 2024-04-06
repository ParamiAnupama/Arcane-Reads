<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
<div class="body_container">
    <div class="container">
        <h2>Login</h2>
        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: red;">' . $_GET['error'] . '</p>';
            }
            ?>
        <form action="user_login_process.php" method="POST">
            <input type="email" name="email" placeholder="Reader Email" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account yet? <a href="./usersignup.php">Sign up here</a></p>
    </div>
    </div>
    <footer> 
        <p>&copy; 2024 Arcane-Reads. All rights reserved.</p>
    </footer>
</body>
</html>
