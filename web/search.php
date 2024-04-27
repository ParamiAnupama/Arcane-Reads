<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Search Novels</title>
</head>
<body>

    <header>
        <?php include '../web/header.php'; ?>
    </header>

    <div class="container">

    

    <h1 class="h2_main">Search Novels</h1>
    
        <br>
        <form action="search.php" method="POST" >
            <label for="author_search" class="h2_para">Search by Author &nbsp;</label>
            <input type="text" id="author_search" name="author_search" placeholder="Enter author's name">
            </br></br>
            <label for="genre" class="h2_para">Filter by Genre &nbsp;</label>
            <select id="genre" name="genre" >
            <?php
                // Connect to your MySQL database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "arcane-reads";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve genres from the database
                $sql = "SELECT GenreID, GenreName FROM genre";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each genre
                    while ($row = $result->fetch_assoc()) {
                        $genreID = $row["GenreID"];
                        $genreName = $row["GenreName"];
                        echo "<option value='$genreID'>$genreName</option>";
                    }
                } else {
                    echo "<option value=''>No genres found</option>";
                }
                

                $conn->close();
                ?>
            </select>
            </br></br>
            <button type="submit">Search</button>

            <br>

        </form>
    

    <!-- Display search results below the form -->
    <div id="search_results">
                <?php
            require_once '../config/config.php';

            // Check if GenreID is provided in the URL
            if(isset($_POST['genre'])) {
                $genreID = $_POST['genre'];

                // Connect to your MySQL database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "arcane-reads";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                // Prepare SQL statement to retrieve genre information
                $genreSql = "SELECT GenreName, GenreDescription FROM genre WHERE GenreID = ?";
                $genreStmt = $conn->prepare($genreSql);
                $genreStmt->bind_param("i", $genreID);
                $genreStmt->execute();
                $genreResult = $genreStmt->get_result();

                if ($genreResult->num_rows > 0) {
                    // Display genre information
                    while ($row = $genreResult->fetch_assoc()) {
                        $genreName = $row["GenreName"];
                        $genreDescription = $row["GenreDescription"];
                        echo "<h2 class='h2_main'>Results - $genreName </h2><br>";
                        
                    }

                    // Check if author search is provided
                    if(isset($_POST['author_search'])) {
                        $authorSearch = $_POST['author_search'];
                        // Prepare SQL statement to retrieve novels filtered by author's name
                        $novelSql = "SELECT n.NovelID, n.Title, n.Summary, n.CoverImgPath, a.AuthorName 
                                    FROM novel n
                                    INNER JOIN author a ON n.AuthorID = a.AuthorID
                                    WHERE n.GenreID = ? AND a.AuthorName LIKE ?";
                        $novelStmt = $conn->prepare($novelSql);
                        $likeParam = "%" . $authorSearch . "%";
                        $novelStmt->bind_param("is", $genreID, $likeParam);
                    } else {
                        // Prepare SQL statement to retrieve all novels for the selected genre
                        $novelSql = "SELECT n.NovelID, n.Title, n.Summary, n.CoverImgPath, a.AuthorName 
                                    FROM novel n
                                    INNER JOIN author a ON n.AuthorID = a.AuthorID
                                    WHERE n.GenreID = ?";
                        $novelStmt = $conn->prepare($novelSql);
                        $novelStmt->bind_param("i", $genreID);
                    }

                    // Execute the prepared statement for novels
                    $novelStmt->execute();
                    $novelResult = $novelStmt->get_result();

                    if ($novelResult->num_rows > 0) {
                        // Display novels
                        echo '<div class="novel_container">';
                        
                        while ($novelRow = $novelResult->fetch_assoc()) {
                            $novelID = $novelRow["NovelID"];
                            $novelName = $novelRow["Title"];
                            $novelCoverImg = IMAGE_BASE_PATH . $novelRow["CoverImgPath"];
                            $authorName = $novelRow["AuthorName"];

                            echo "<div class='novel_item'>";
                            echo "<a href='../novels/novel.php?id=$novelID' class='navbar-link'><img src='$novelCoverImg' alt='$novelName Cover Image'></br>$novelName</a>";
                            echo "</div>";
                        }
                        echo '</div>'; // Close novel-container
                    } else {
                        echo "No novels found for this genre.";
                    }
                } else {
                    echo "Genre not found.";
                }

                // Close the prepared statements and database connection
                
                $conn->close();
                $genreStmt->close();
                $novelStmt->close();
            } 
            ?>

    </div>
</div>

    <footer class="bottom">
        <p>&copy; 2024 Arcane-Reads. All rights reserved.</p>
    </footer>
</body>
</html>


