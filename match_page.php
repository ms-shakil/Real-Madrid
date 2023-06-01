<!DOCTYPE html>
<html lang="en">
<head>
  <title>Match page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script class="u-script" type="text/javascript" src="jquery-1.9.1.min.js" defer=""></script>
  <link rel="stylesheet" href="match_page.css">
</head>
<body>
<header>
    <?php include('includes/navbar.php'); ?>
</header>
  

  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <?php
        // Connect to database
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'fcms';
        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

        // Get match id from query parameter
        $match_id = $_GET['match_id'];

        // Query database for match details
        $query = "SELECT match_date, match_time, match_venue, opponent, league
        FROM match_info
        WHERE match_id = $match_id
        LIMIT 1;
        ";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $opponent = $row['opponent'];
          $date = $row['match_date'];
          $time = $row['match_time'];
          $venue = $row['match_venue'];
          $league = $row['league'];

          echo "<div class='match-info w-100'>";
          echo "<h1>$opponent</h1>";
          echo "<p>Date: $date</p>";
          echo "<p>Time: $time</p>";
          echo "<p>Venue: $venue</p>";
          echo "<p>League: $league</p>";
          echo "</div>";

          // Query database for starting 11 info
          echo "<div class='ALLtables'>";
          echo "<div class='start_tables'>";
          include 'includes\starting_e.php';
          echo "</div>";
          echo "<div class='sub_tables'>";
          include 'includes\subs.php';
          echo "</div>";
          echo "</div>";
        } else {
          echo "<p>No match found</p>";
        }
      
        ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
