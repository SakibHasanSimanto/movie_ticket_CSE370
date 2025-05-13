<?php

include("includes/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// STEP 1: Showtimes dropdown
if (!isset($_GET['showtime_id'])) {
    $sql = "SELECT s.showtime_id, s.show_time, m.title, t.name 
            FROM showtimes s 
            JOIN movies m ON s.movie_id = m.movie_id 
            JOIN theaters t ON s.theater_id = t.theater_id";
    $result = $conn->query($sql);

    echo "<h2>Select a Showtime</h2>";
    echo "<form method='GET'>";
    echo "<select name='showtime_id'>";
    while($row = $result->fetch_assoc()) {
        echo "<option value='{$row['showtime_id']}'>
                {$row['title']} at {$row['name']} ({$row['show_time']})
              </option>";
    }
    echo "</select> <input type='submit' value='Next'>";
    echo "</form>";
}

// STEP 2: Choose Seat and Book
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seat_id = $_POST['seat_id'];
    $showtime_id = $_POST['showtime_id'];
    $user_id = $_SESSION['user_id'];
    $booking_time = date("Y-m-d H:i:s");

    // Prevent double booking
    $check = "SELECT * FROM bookings WHERE showtime_id=$showtime_id AND seat_id=$seat_id";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>Sorry, this seat is already booked!</p>";
    } else {
        $sql = "INSERT INTO bookings (user_id, showtime_id, seat_id, booking_time)
                VALUES ($user_id, $showtime_id, $seat_id, '$booking_time')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Seat booked successfully!</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    echo "<br><a href='dashboard.php'>← Back to Dashboard</a>";
}

// STEP 3: Show available seats
else {
    $showtime_id = $_GET['showtime_id'];
    
    $sql = "SELECT s.seat_id, s.seat_number, s.row_number, s.seat_category, s.price 
            FROM theater_info s
            WHERE s.seat_id NOT IN (
                SELECT seat_id FROM bookings WHERE showtime_id = $showtime_id
            )";

    $result = $conn->query($sql);

    echo "<h2>Available Seats</h2>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='showtime_id' value='$showtime_id'>";
    echo "<select name='seat_id'>";
    while($row = $result->fetch_assoc()) {
        echo "<option value='{$row['seat_id']}'>
                Row {$row['row_number']} Seat {$row['seat_number']} - {$row['seat_category']} (Tk {$row['price']})
              </option>";
    }
    echo "</select> <input type='submit' value='Book Seat'>";
    echo "</form>";
}
?>

