<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'fcms';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

$player_id = $_POST['player_id'];
$match_id = $_POST['match_id'];

// Delete player from starting 11
$delete_query = "DELETE FROM starting_eleven WHERE player_id = $player_id AND match_id = $match_id";
mysqli_query($conn, $delete_query);

// Redirect back to starting 11 page
header("Location: ../match_page.php?match_id=$match_id");
exit();
?>
