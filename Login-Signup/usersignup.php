<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Assets/css/styles.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <style>
       .radiotext{
    text-align: left;
    color: #767070;
    font-size: 15px;
 }
 </style>
</head>
<body>
    
<?php include '../web/header.php'; ?>

<div class="body_container">

    <div class="log_container">
        <h2>Sign Up</h2>
        <?php
        // Check if an error message exists in the URL parameters
        if (isset($_GET['error'])) {
            // Display the error message in red
            echo '<p style="color: red;">' . $_GET['error'] . '</p>';
        }
        ?>
        <form action="usersignup_process.php" method="POST">
            <input type="text" name="user_id" placeholder="ID" required><br>
            <input type="text" name="userfirstname" placeholder="First Name" required><br>
            <input type="text" name="userlastname" placeholder="Last Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="tel" name="contact_no" placeholder="Contact Number" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <span class="form_text">Registered Date</span>
            <br>
            <input type="date" name="date" required><br>
           
            <br>
            <button class="login" type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="./user_login.php">Login here</a></p>
    </div>
    </div>
    <footer> 
        <p>&copy; 2024 Arcane-Reads. All rights reserved.</p>
    </footer>
</body>
</html>
