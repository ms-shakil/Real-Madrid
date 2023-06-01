<?php
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Connect to database
            
      // Connect to the database
      $con = mysqli_connect("localhost", "root", "", "fcms");
      
      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }

      // Get form data
      $player_id = $_POST['player_id'];
      $player_name = $_POST['name'];
      $player_age = $_POST['age'];
      $player_nationality = $_POST['nationality'];
      $player_status = $_POST['status'];
      $player_position = $_POST['position'];
      $player_number = $_POST['number'];
      $matchplayed = $_POST['matchplayed'];
      $player_join = $_POST['join'];
      $player_salary = $_POST['salary'];

      // Prepare and execute the SQL query
      $sql = "UPDATE players SET player_name='$player_name', player_age='$player_age', player_nationality='$player_nationality', player_status='$player_status', player_position='$player_position', player_number='$player_number',match_played='$matchplayed', join_date='$player_join', player_salary='$player_salary' WHERE player_id='$player_id'";

      if (mysqli_query($con, $sql)) {
        echo "Record updated successfully";
        header("Location: PlayerList.php");
      } else {
        echo "Error updating record: " . mysqli_error($con);
      }

      // Close the database connection
      mysqli_close($con);

    }
?>