<?php
require_once '../config/config.php';
// Check if GenreID is provided in the URL
if(isset($_GET['id'])) {
    $genreID = $_GET['id'];

    // Connect to  MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "arcane-reads";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve genre information from the database
    $sql = "SELECT GenreName, GenreDescription FROM genre WHERE GenreID = $genreID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display genre information
        while ($row = $result->fetch_assoc()) {
            $genreName = $row["GenreName"];
            $genreDescription = $row["GenreDescription"];
            echo "<h2 class='h2_sub'>$genreName</h2>";
            echo "<p class='h2_para'>$genreDescription</p>";
        }

        // Retrieve novels for the selected genre
        $novelSql = "SELECT NovelID, Title, Summary, CoverImgPath FROM novel WHERE GenreID = $genreID";
        $novelResult = $conn->query($novelSql);

        if ($novelResult->num_rows > 0) {
            // Display novels
            echo "<div class='novel-grid'>";
            while ($novelRow = $novelResult->fetch_assoc()) {
                $NovelCoverImg = IMAGE_BASE_PATH . $novelRow["CoverImgPath"];
                echo "<div class='novel-item'>";
                echo "<img src='{$NovelCoverImg}' alt='{$novelRow['Title']}' width='200px' height='200px'><br>";
                echo "<strong >{$novelRow['Title']}</strong><br>";
                echo "</div>";
            }
            
            echo "</div>";
        } else {
            echo "No novels found for this genre.";
        }
    } else {
        echo "Genre not found.";
    }

    $conn->close();
} else {
    echo "Genre ID not provided.";
}
?>
