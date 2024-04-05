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

// Retrieve genres from the genre table
$sql = "SELECT GenreID, GenreName FROM genre";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each genre
    echo '<ul class="dropdown-menu">';
    while ($row = $result->fetch_assoc()) {
        $genreID = $row["GenreID"];
        $genreName = $row["GenreName"];
        echo "<li class='dropdown-item'>";
        echo "<a href='../genres/genre.php?id=$genreID' class='navbar-link'>$genreName</a>";
        echo "</li>";
    }
    echo '</ul>'; // Close navbar-list
} else {
    echo "No genres found in the database.";
}



$conn->close();
?>
