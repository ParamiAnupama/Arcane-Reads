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
    $sql = "SELECT GenreName, GenreDescription, GenreCatchPhrase FROM genre WHERE GenreID = $genreID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display genre information
        while ($row = $result->fetch_assoc()) {
            $genreName = $row["GenreName"];
            $genreDescription = $row["GenreDescription"];
            $genreCatchPhrase = $row["GenreCatchPhrase"];
            echo "<h2 class='h2_sub'>$genreName</h2>";
            echo "<p class='h2_para'>$genreDescription</p>";
            echo "<p class='h2_para'>$genreCatchPhrase</p><br>";
        }

        // Retrieve novels for the selected genre
        $novelSql = "SELECT NovelID, Title, Summary, CoverImgPath FROM novel WHERE GenreID = $genreID";
        $novelResult = $conn->query($novelSql);

        if ($novelResult->num_rows > 0) {
            echo '<div class="novel_container">';
            while ($novelrow = $novelResult->fetch_assoc()) {
                $novelID = $novelrow["NovelID"];
                $novelName = $novelrow["Title"];
                $novelCoverImg = IMAGE_BASE_PATH . $novelrow["CoverImgPath"];
            
                echo "<div class='novel_item'>";
                echo "<a href='../novelss/novel.php?id=$novelID' class='navbar-link'><img src='$novelCoverImg' alt='$novelName Cover Image'>";
                echo "<div class='novel_name'>$novelName</div></a>";
                echo "</div>";
            }
            echo '</div>'; // Close novel-container
            
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
