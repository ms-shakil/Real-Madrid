<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'fcms';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$match_id = $_POST['match_id'];
$player_id = $_POST['player_id'];

$select_query = "SELECT player_name, player_position FROM players WHERE player_id=$player_id";
$result = mysqli_query($conn, $select_query);

if (!$result) {
    die("Error selecting player information: " . mysqli_error($conn));
}

if ($row = mysqli_fetch_assoc($result)) {
    $player_name = $row['player_name'];
    $player_position = $row['player_position'];

    $insert_query = "INSERT INTO substitute (match_id, player_id, player_name, player_position) VALUES ($match_id, $player_id, '$player_name','$player_position')";

    $result = mysqli_query($conn, $insert_query);

    if (!$result) {
        die("Error adding player: " . mysqli_error($conn));
    }

    mysqli_close($conn);

    echo "Player added successfully!";
    header("Location: ../match_page.php?match_id=$match_id");
    exit();



} else {
    mysqli_close($conn);

    echo "Error retrieving player information: " . mysqli_error($conn);
    echo "<br>";
    echo "Redirecting to starting_e.php?match_id=$match_id...";
    ob_start(); // Start output buffering
    header("Location: starting_e.php?match_id=$match_id");
    ob_end_flush(); // Flush output buffer and redirect
  
}
?>


