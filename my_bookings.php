<?php

include("includes/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT m.title AS movie, t.name AS theater, t.location, s.show_time,
               tf.row_number, tf.seat_number, tf.seat_category, tf.price,
               b.booking_time
        FROM bookings b
        JOIN showtimes s ON b.showtime_id = s.showtime_id
        JOIN movies m ON s.movie_id = m.movie_id
        JOIN theaters t ON s.theater_id = t.theater_id
        JOIN theater_info tf ON b.seat_id = tf.seat_id
        WHERE b.user_id = $user_id
        ORDER BY b.booking_time DESC";

$result = $conn->query($sql);

echo "<h2>My Bookings</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>Movie</th>
                <th>Theater</th>
                <th>Location</th>
                <th>Showtime</th>
                <th>Seat</th>
                <th>Category</th>
                <th>Price</th>
                <th>Booked On</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['movie']}</td>
                <td>{$row['theater']}</td>
                <td>{$row['location']}</td>
                <td>{$row['show_time']}</td>
                <td>Row {$row['row_number']} - Seat {$row['seat_number']}</td>
                <td>{$row['seat_category']}</td>
                <td>Tk {$row['price']}</td>
                <td>{$row['booking_time']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No bookings yet!";
}
?>

<br><a href="dashboard.php">← Back to Dashboard</a>

