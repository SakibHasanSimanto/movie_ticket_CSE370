<?php
include("includes/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Search Movies</h2>

<form method="GET">
    Enter movie title: <input type="text" name="query" required>
    <input type="submit" value="Search">
</form>

<?php
if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $sql = "SELECT * FROM movies WHERE title LIKE '%$search%'";
    $result = $conn->query($sql);

    echo "<h3>Search Results for '$search'</h3>";
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr><th>Title</th><th>Genre</th><th>Duration</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['genre'] . "</td>
                    <td>" . $row['duration'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No movies found.";
    }
}
?>

<br><a href="dashboard.php">← Back to Dashboard</a>

