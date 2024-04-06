<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
<header class="header">
    
        <div class="nav_container">
            
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <div class="logo">
                        <li class="navbar-logo"><img src="../assets/images/logoAR.png" alt="logo" width="100px" height="70px" /></li>
                    </div>
                    <li class="navbar-item">
                        <a href="../web/index.php" class="navbar-link" data-nav-link>Home</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../web/shop.html" class="navbar-link" data-nav-link>Shop</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../web/comments.html" class="navbar-link" data-nav-link>Comments</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../web/about.php" class="navbar-link" data-nav-link>About</a>
                    </li>
                    <li class="navbar-item dropdown">
                        <a href="#" class="navbar-link" data-nav-link>Genres</a>
                            <?php include 'dropdown_menu.php'; ?>
                            <p id="genre-msg" class="genre-msg"></p>
                    </li>
                    <li class="navbar-item">
                        <a href="../user_login.php" class="navbar-link" data-nav-link>Reader</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../seller_login.php" class="navbar-link" data-nav-link>Author</a>
                    </li>
                </ul>
            </nav>
            
        </div>
    
</header>
</body>
</html>
