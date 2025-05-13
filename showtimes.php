<?php

include("includes/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>All Showtimes</h2>

<?php
$sql = "SELECT s.show_time, m.title AS movie_title, t.name AS theater_name, t.location
        FROM showtimes s
        JOIN movies m ON s.movie_id = m.movie_id
        JOIN theaters t ON s.theater_id = t.theater_id
        ORDER BY s.show_time ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>Movie</th>
                <th>Theater</th>
                <th>Location</th>
                <th>Show Time</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['movie_title']}</td>
                <td>{$row['theater_name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['show_time']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No showtimes available.";
}
?>

<br><a href="dashboard.php">← Back to Dashboard</a>
