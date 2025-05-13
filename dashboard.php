<?php
include("includes/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['user_name'];
?>

<h2>Welcome, <?php echo $userName; ?>!</h2>
<h3>Now Showing</h3>

<?php
$sql = "SELECT * FROM movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr><th>Title</th><th>Genre</th><th>Duration (min)</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['title'] . "</td>
                <td>" . $row['genre'] . "</td>
                <td>" . $row['duration'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No movies available.";
}
?>

<br><a href="search_movies.php">🔍 Search Movies</a>
<br><a href="showtimes.php">🎟️ View All Showtimes</a> 
<br><a href="book_ticket.php">🎫 Book a Ticket</a>
<br><a href="my_bookings.php">📋 View My Bookings</a>

<br><a href="logout.php">Logout</a>

