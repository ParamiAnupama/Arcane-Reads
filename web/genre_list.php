<?php
require_once '../config/config.php';
// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "arcane-reads";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve genres from the genre table with cover images
$sql = "SELECT GenreID, GenreName, GenreCoverImg FROM genre";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each genre
    echo '<div class="genre-container">';
    while ($row = $result->fetch_assoc()) {
        $genreID = $row["GenreID"];
        $genreName = $row["GenreName"];
        $genreCoverImg = IMAGE_BASE_PATH . $row["GenreCoverImg"];

        echo "<div class='genre-item'>";
        echo "<a href='../genres/genre.php?id=$genreID' class='navbar-link'><img src='$genreCoverImg' alt='$genreName Cover Image'>$genreName</a>";
        echo "</div>";
    }
    echo '</div>'; // Close genre-container
} else {
    echo "No genres found in the database.";
}

$conn->close();
?>