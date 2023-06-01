<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar', 'corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      // Retrieve data from database for bar chart
      <?php
        // Connect to database
        $conn = mysqli_connect("localhost", "root", "", "fcms");

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve top 5 players with most matches played
        $sql = "SELECT player_name, match_played FROM players ORDER BY match_played DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);

        // Store data in an array
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
          $data[] = array($row["player_name"], $row["match_played"]);
        }

        // Close connection
        mysqli_close($conn);
      ?>

      // Create bar chart using retrieved data
      var barData = google.visualization.arrayToDataTable([
        ['Player name', 'Match played'],
        <?php
          foreach ($data as $row) {
            echo "['".$row[0]."', ".$row[1]."],";
          }
        ?>
      ]);

      var barOptions = {
        chart: {
          title: 'Players with Most Matches Played',
        },
        bars: 'horizontal' // Required for horizontal bar charts.
      };

      var barChart = new google.charts.Bar(document.getElementById('bar_chart_div'));

      barChart.draw(barData, google.charts.Bar.convertOptions(barOptions));

      // Retrieve data from database for pie chart
      <?php
        // Connect to database
        $conn = mysqli_connect("localhost", "root", "", "fcms");

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve fitness and injured count of players
        $sql = "SELECT COUNT(*) AS count, player_status FROM players WHERE player_status IN ('fit', 'injured') GROUP BY player_status";
        $result = mysqli_query($conn, $sql);

        // Store data in an array
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
          $data[] = array($row["player_status"], $row["count"]);
        }

        // Close connection
        mysqli_close($conn);
      ?>

      // Create pie chart using retrieved data
      var pieData = google.visualization.arrayToDataTable([
        ['Player status', 'Count'],
        <?php
          foreach ($data as $row) {
            echo "['".$row[0]."', ".$row[1]."],";
          }
        ?>
      ]);

      var pieOptions = {
        title: 'Fitness to Injured Ratio of Players',
        is3D: true,
        height: 500,
        width: 800,
        pieSliceTextStyle: {
          color: 'white'
        },
        slices: {
          0: { color: '#32CD32' },
          1: { color: 'red' },
          2: { color: 'WHITE'}
        }
      };

      var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));

      pieChart.draw(pieData, pieOptions);
    }
  </script>
  <style>
    #bar_chart_div {
      width: 80%;
      margin: 0 auto;
    }

    #pie_chart_div {
  width: 80%;
  margin-left: 30%;
  text-align: center;
}
#pie_chart_div .google-visualization-title {
    text-align: center;
  }

.chart-title {
  text-align: center;
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.chart {
  width: 100%;
  height: 400px;
}

@media (max-width: 768px) {
  .chart-container {
    width: 100%;
  }

  .chart {
    height: 300px;
  }
}


    .chart-title {
  text-align: center;
  font-size: 1.5rem;
  margin-bottom: 1rem;
  
}

.chart {
  width: 100%;
  height: 400px;
}

@media (max-width: 768px) {
  .chart-container {
    width: 100%;
  }

  .chart {
    height: 300px;
  }
}
h1{
   font-family: 'Lato', sans-serif;
    font-size: 54px; 
    font-weight: 300;
    line-height: 58px;
    margin: 80px 0 58px;
    text-align: center;
}
body{
    margin-top: 25px;
}

  </style>
</head>
<body>
  <h1>Most experienced players</h1>
  <div id="bar_chart_div"></div>
  <h1>Squad fitness</h1>
  <div id="pie_chart_div"></div>
</body>
</html>
