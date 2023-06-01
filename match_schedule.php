<head>
<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
</head>
<?php
// Connect to database
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'fcms';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Query database for matches
$query = "SELECT match_id, match_date, match_time, match_venue, opponent, league
FROM match_info
WHERE match_date >= CURRENT_DATE() 
ORDER BY TIMESTAMPDIFF(SECOND, CONCAT(match_date, ' ', match_time), NOW()) DESC
LIMIT 5;
";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    echo '<div class="card_container">';
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['match_id']; 
      $opponent = $row['opponent'];
      $date = $row['match_date'];
      $time = $row['match_time'];
      $venue = $row['match_venue'];
      $league = $row['league'];


        
        echo '<a class="card" href="match_page.php?match_id=' . $id . '">';
        echo '<div class="card_header">';
        echo $id;
        echo '</div>';
        echo '<div class="card-body">';
        echo "<div class='date_time'>$date $time";
        echo "</div>";
        echo "<h2 class=\"card_title\">vs $opponent </h2>";
        echo '</div>';
        echo '<div class="card-footer">';
        echo $league;
        echo '</div>';
        echo '</a>';
        
    }
    echo '</div>';
} else {
    echo "No results found";
}

// Close database connection
mysqli_close($conn);

// Display table with CSS styling
echo <<<HTML
<style>
.card_container{
    display:flex;
    justify-content: center !important;
    flex-direction: row; /* set flex-direction to row */
    flex-wrap: wrap; /* add flex-wrap property */
    width: 100%;
    height: 100%;
    margin: 0; /* center the container horizontally */
    align-items: space-between ;
    background-image: linear-gradient(#555c66, #404040);
}

.card {
  width: 80%;
  color: white !important;
  height: 150px !important;
  margin: 10px auto !important; /* center the cards horizontally */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.5s;
  font-family: 'Oswald' !important;
  background: linear-gradient(to bottom, #778899, #696969);
  cursor: pointer;
}

.card-body{
    display:flex !important;
    justify-content:space-between !important;
    align-items:center !important;
    margin-top:0px !important;
}

.card_title{
    text-transform: uppercase;
    text-align: center;
    margin: 0 !important;
    font-family: 'Oswald' !important;
    flex-grow: 1;
    padding-right:135px !important;
    font-size:45px;
    transition: transform 0.5s ease-in-out;
}

.date_time{
    text-align: center;
    width:125px;
    display:flex;
    flex-direction:row;
    flex-wrap:wrap

}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  color: black !important;
  transform: scale(1.02);
  background: #778899; 
  background: linear-gradient(to bottom, #478ac9, #4c7397);
}

.card_header{
  text-align:center;
  font-weight: bold;
  padding: 0px !important;
}

.card-footer {
  text-align:center;
  font-size: 14px;
  padding: 0px !important;
  border-bottom: 2px solid black;
}

</style>


HTML;
?>
