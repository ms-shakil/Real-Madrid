<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Starting 11</title>
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
<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'fcms';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

$match_id = $_GET['match_id'];

// Get all available players
$player_query = " SELECT p.player_id, p.player_name
                  FROM players p
                  LEFT JOIN starting_eleven s
                  ON p.player_id = s.player_id AND s.match_id = $match_id
                  WHERE s.player_id IS NULL";

$player_result = mysqli_query($conn, $player_query);

// Display dropdown button with players
echo "<h1>STARTING 11</h1>";
echo "<div class='dropdown'>";
echo "<form action='includes/add_starting_player.php' method='POST'>";
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

// Display current starting 11 table
$starting11_query = "SELECT player_name, position, player_id
                    FROM starting_eleven
                    WHERE match_id = $match_id;
";
$starting11_result = mysqli_query($conn, $starting11_query);

echo "<table class='table'>";
echo "<thead>";
echo "<tr>";
echo "<th>Player Name</th>";
echo "<th>Position</th>";
echo "<th>Player ID</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while($starting11_row = mysqli_fetch_assoc($starting11_result)) {
    $player_name = $starting11_row['player_name'];
    $position = $starting11_row['position'];
    $player_id = $starting11_row['player_id'];

    echo "<tr>";
    echo "<td>$player_name</td>";
    echo "<td>$position</td>";
    echo "<td>$player_id</td>";
    echo "<td><button class='btn btn-danger' onclick='deletePlayer($match_id, $player_id)'>Delete</button></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</div>";

?>

</body>
<style>
  .table{
    width: 100%;
    border: 2px solid black;
  }
  h1{
    color:#478ac9;
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
function deletePlayer(match_id, player_id) {
  // Send an AJAX request to delete the player from the database
  $.ajax({
    url: "includes/delete_starting_player.php",
    method: "POST",
    data: { match_id: match_id, player_id: player_id },
    success: function(response) {
      // Remove the corresponding row from the table
      $("table tbody tr").each(function() {
        if ($(this).find("td:last-child").text() == player_id) {
          $(this).remove();
        }
      });
      // Reload the page after the player has been deleted
      location.reload();
    }
  });
}
</script>

</html>
