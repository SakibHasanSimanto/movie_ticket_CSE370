<?php
include("includes/db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $message = "All fields are required.";
    } else {
        // Check if email already exists
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            $message = "Email already registered.";
        } else {
            // Insert new user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed')";
            if ($conn->query($sql)) {
                $message = "Registration successful!";
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
}
?>

<h2>User Registration</h2>
<form method="POST">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="email" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" value="Register">
</form>

<br><a href="login.php">Login</a>

<p><?php echo $message; ?></p>

