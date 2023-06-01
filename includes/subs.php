
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    
</body>
<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'fcms';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

$match_id = $_GET['match_id'];

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$player_query ="SELECT p.player_id, p.player_name
                FROM players p
                WHERE p.player_id NOT IN (
                SELECT player_id FROM starting_eleven WHERE match_id = $match_id
                ) AND p.player_id NOT IN (
                SELECT player_id FROM substitute WHERE match_id = $match_id
                )";

$player_result = mysqli_query($conn, $player_query);

// Display dropdown button with players
echo "<h1>SUBSTITUTES</h1>";
echo "<div class='dropdown'>";
echo "<form action='includes/add_sub_player.php' method='POST'>";
echo "<select name='player_id'>";
echo "<option value='' disabled selected>Select a Player</option>";
while($player_row = mysqli_fetch_assoc($player_result)) {
    $player_id = $player_row['player_id'];
    $player_name = $player_row['player_name'];
    $player_position = $player_row['player_position'];

    echo "<option value='$player_id'>$player_name</option>";
}
echo "</select>";
echo "<input type='hidden' name='match_id' value='$match_id'>";
echo "<input type='submit' value='Add Player' class='add-player-btn'>";
echo "</form>";
echo "</div>";

// Select data from the "substitute" table
$sql = "SELECT * FROM substitute where match_id=$match_id";
$result = mysqli_query($conn, $sql);


// Check if there are any results
if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  echo "<table class='table'>";
  echo "<tr><th>Player Name</th><th>position</th><th>Player ID</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>".$row["player_name"]."</td><td>".$row["player_position"]."</td><td>".$row["player_id"]."</td><td><button class='btn btn-danger' onclick='deleteSubPlayer(".$match_id.", ".$row["player_id"].")'>Delete</button></td></tr>";
  }  
  echo "</table>";
  
} else {
  echo "0 results";
}

// Close the connection
mysqli_close($conn);
?>

</body>
<style>
 .table{
    width: 100%;
    border: 2px solid black;
    margin-bottom: 50px;
  }
  .add-player-btn {
    background-color: black;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }

  .add-player-btn:hover {
    background-color: #478ac9;
  }
</style>
<script>
function deleteSubPlayer(match_id, player_id) {
    console.log("i m here");
  // Send an AJAX request to delete the player from the database
  $.ajax({
    url: "includes/delete_sub_player.php",
    method: "POST",
    data: { match_id: match_id, player_id: player_id },
    success: function(response) {
      // Remove the corresponding row from the table
      $("table tbody tr").each(function() {
        if ($(this).find("td:last-child").text() == player_id) {
          $(this).remove();
        }
      });
      console.log("i m here");
      // Reload the page after the player has been deleted
      location.reload();
    }
  });
}
</script>

</html>