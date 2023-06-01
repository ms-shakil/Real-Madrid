<?php
// Get the form data
$name = $_POST['name'];
$age = $_POST['age'];
$nationality = $_POST['nationality'];
$status = $_POST['status'];
$position = $_POST['position'];
$number = $_POST['number'];
$matchplayed = $_POST['matchplayed'];
$join_date = $_POST['join'];
$salary = $_POST['salary'];

// Create a new database connection
$host = 'localhost';
$user = "root";
$pass = '';
$dbname = 'fcms';
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Build the SQL query
$sql = "INSERT INTO players (player_name, player_age, player_nationality, player_status, player_position, player_number,match_played, join_date, player_salary)
        VALUES ('$name', '$age', '$nationality', '$status', '$position', '$number','$matchplayed', '$join_date', '$salary')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "New player added successfully!";
    header("Location: PlayerList.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
