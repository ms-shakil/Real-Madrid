<?php
// Database connection parameters
$host = 'localhost';
$user = "root";
$pass = '';
$dbname = 'fcms';

// Connect to the database
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a delete request was made
if (isset($_POST['delete'])) {
    $player_id = $_POST['delete'];
    $sql = "DELETE FROM players WHERE player_id='$player_id'";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST['sort-by']) && isset($_POST['sort-order'])){
  // Retrieve the values of the selected options
  $sort_by = $_POST['sort-by'];
  $sort_order = $_POST['sort-order'];
  
}else{
  $sort_by = "player_id";
  $sort_order = "ASC";
}
// Query the database for the list of people
$sql = "SELECT player_id, player_name, player_number, player_nationality, player_age, join_date,match_played, player_salary FROM players ORDER BY $sort_by $sort_order" ;
$result = mysqli_query($conn, $sql);

// Loop through the query results and output each person
if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<ul>";
    echo "<li>";
    echo "<span class='id'><strong>ID</strong></span>";
    echo "<span class='name'><strong>Name</strong></span>";
    echo "<span class='age'><strong>Age</strong></span>";
    echo "<span class='nationality'><strong>Nationality</strong></span>";
    echo "<span class='number'><strong>Number</strong></span>";
    echo "<span class='matchplayed'><strong>Match played</strong></span>";
    echo "<span class='join'><strong>Joining Date</strong></span>";
    echo "<span class='salary'><strong>Salary</strong></span>";
    echo "<span class='delete'><strong>" . str_repeat('&nbsp;', 12) . "</strong></span>";

    echo "</li>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo "<span class='id'>" . $row['player_id'] . "</span>";
        echo "<span class='name'>" . $row['player_name'] . "</span>";
        echo "<span class='age'>" . $row['player_age'] . "</span>";
        echo "<span class='nationality'>" . $row['player_nationality'] . "</span>";
        echo "<span class='number'>" . $row['player_number'] . "</span>";
        echo "<span class='matchplayed'>" . $row['match_played'] . "</span>";
        echo "<span class='join'>" . $row['join_date'] . "</span>";
        echo "<span class='salary'>" . $row['player_salary'] . "</span>";
        echo "<span class='delete'><form method='post'><button type='submit' name='delete' value='" . $row['player_id'] . "'>Delete</button></form></span>";
        echo "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "No Entries made till now.";
}

// Close the database connection
mysqli_close($conn);
?>

<style>
    ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

li {
  text-transform: uppercase;
  text-align: center;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  padding: 10px;
  font-size: 18px;
}

.id {
  width: 10%;
}

.name {
  width: 20%;
}

.age {
  width: 10%;
}

.nationality {
  width: 20%;
}

.number {
  width: 10%;
}
.matchplayed{
    width: 20%;
}

.join {
  width: 20%;
}

.salary {
  width: 10%;
  text-align: start;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
}

</style>