<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <style>

    :root {
      --background-color: black;
      --text-color: hsl(0, 0%, 100%);
    }

    .wrapper {
      display: grid;
      place-content: center;
      margin-top: 0;
      background-color: var(--background-color);
      min-height: 40vh;
      font-family: "Oswald", sans-serif;
      font-size: clamp(1.5rem, 1rem + 18vw, 15rem);
      font-weight: 700;
      text-transform: uppercase;
      color: var(--text-color);
    }

    .wrapper>div {
      grid-area: 1/1/-1/-1;
    }

    .top {
      clip-path: polygon(0% 0%, 100% 0%, 100% 48%, 0% 58%);
    }

    .bottom {
      clip-path: polygon(0% 60%, 100% 50%, 100% 100%, 0% 100%);
      color: transparent;
      background: -webkit-linear-gradient(177deg, black 53%, var(--text-color) 65%);
      background: linear-gradient(177deg, black 53%, var(--text-color) 65%);
      background-clip: text;
      -webkit-background-clip: text;
      transform: translateX(-0.02em);
    }
  </style>
  <title>Players List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

  <link rel="stylesheet" href="PlayerList.css" media="screen">

</head>

<body>
  <header>
  <?php include('../includes/navbar.php'); ?>
  </header>

  <section class="wrapper">
    <div class="top">PLAYERS</div>
    <div class="bottom" aria-hidden="true">PLAYERS</div>
  </section>
  <div class="button-container">
    <button id="show-form-btn" class="button button-primary">Add player</button>

    <div class="sort-form">
      <form method="POST" action="../get_people.php">
        <div class="sort-options">
          <label for="sort-by">Sort By:</label>
          <select id="sort-by" name="sort-by">
            <option value="player_name">Name</option>
            <option value="player_number">Number</option>
            <option value="match_played">Match played</option>
            <option value="player_age">Age</option>
            <option value="player_nationality">Nationality</option>
            <option value="join_date">Join Date</option>
            <option value="player_salary">Salary</option>
          </select>
        </div>
        <div class="sort-options">
          <label for="sort-order">Sort Order:</label>
          <select id="sort-order" name="sort-order">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
          </select>
        </div>
        <button type="submit" class="sort-button">Sort</button>
      </form>
    </div>

    <button id="show-update-form-btn" class="button button-tertiary">Update Player</button>
  </div>


  <div class="ADDformContainer">
    <form method="POST" action="insert_data.php">
      <div class="form-header">
        <h2>ADD PLAYER</h2>
        <button type="button" id="close-form-btn" class="close-btn"><i class="fas fa-times"></i></button>
      </div>

      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Enter player name" required>
      </div>

      <div class="form-group">
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" class="form-control" placeholder="Enter player age" required>
      </div>

      <div class="form-group">
        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" class="form-control" placeholder="Enter player nationality" required>
      </div>

      <div class="form-group">
        <label for="status">Player status:</label>
        <select id="status" name="status">
          <option value="fit">FIT</option>
          <option value="injured">INJURED</option>
          <option value="Not available">N/A</option>
        </select>
      </div>

      <div class="form-group">
        <label for="position">Player position:</label>
        <select id="position" name="position">
          <option value="striker">striker</option>
          <option value="midfield">midfield</option>
          <option value="defender">defender</option>
          <option value="goalkeeper">goalkeeper</option>
        </select>
      </div>

      <div class="form-group">
        <label for="number">Player number:</label>
        <input type="text" id="number" name="number" class="form-control" placeholder="Enter player number" required>
      </div>

      <div class="form-group">
        <label for="matchplayed">Number of matches played:</label>
        <input type="text" id="matchplayed" name="matchplayed" class="form-control" placeholder="Enter no. of matches played" required>
      </div>

      <div class="form-group">
        <label for="join">Joining Date:</label>
        <input type="date" id="join" name="join">
      </div>

      <div class="form-group">
        <label for="salary">Player salary:</label>
        <input type="text" id="salary" name="salary" class="form-control" placeholder="Enter player salary/month" required>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>
  <div class="UPDATEformContainer">
    <form method="POST" action="update_data.php">
      <div class="form-header">
        <h2>UPDATE PLAYER</h2>
        <button type="button" id="close-update-form-btn" class="close-btn"><i class="fas fa-times"></i></button>
      </div>

      <div class="form-group">
        <label for="player_id">Player ID:</label>
        <input type="text" id="player_id" name="player_id" class="form-control" placeholder="Enter player ID" required>
      </div>

      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Enter player name" required>
      </div>

      <div class="form-group">
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" class="form-control" placeholder="Enter player age" required>
      </div>

      <div class="form-group">
        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" class="form-control" placeholder="Enter player nationality" required>
      </div>

      <div class="form-group">
        <label for="status">Player status:</label>
        <select id="status" name="status">
          <option value="fit">FIT</option>
          <option value="injured">INJURED</option>
          <option value="Not available">N/A</option>
        </select>
      </div>

      <div class="form-group">
        <label for="position">Player position:</label>
        <select id="position" name="position">
          <option value="striker">striker</option>
          <option value="midfield">midfield</option>
          <option value="defender">defender</option>
          <option value="goalkeeper">goalkeeper</option>
        </select>
      </div>

      <div class="form-group">
        <label for="number">Player number:</label>
        <input type="text" id="number" name="number" class="form-control" placeholder="Enter player number" required>
      </div>

      <div class="form-group">
        <label for="matchplayed">Number of matches played:</label>
        <input type="text" id="matchplayed" name="matchplayed" class="form-control" placeholder="Enter no. of matches played" required>
      </div>

      <div class="form-group">
        <label for="join">Joining Date:</label>
        <input type="date" id="join" name="join">
      </div>

      <div class="form-group">
        <label for="salary">Player salary:</label>
        <input type="text" id="salary" name="salary" class="form-control" placeholder="Enter player salary/month" required>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
  <?php include('../get_people.php'); ?>
  <script>
    const showFormBtn = document.getElementById("show-form-btn");
    const closeFormBtn = document.getElementById("close-form-btn");
    const formContainer = document.querySelector(".ADDformContainer");

    showFormBtn.addEventListener("click", () => {
      formContainer.style.display = "block";
    });

    closeFormBtn.addEventListener("click", () => {
      formContainer.style.display = "none";
    });
  </script>
  <script>
    const showUpdateFormBtn = document.getElementById("show-update-form-btn");
    const closeUpdateFormBtn = document.getElementById("close-update-form-btn");
    const updateFormContainer = document.querySelector(".UPDATEformContainer");

    showUpdateFormBtn.addEventListener("click", () => {
      updateFormContainer.style.display = "block";
    });

    closeUpdateFormBtn.addEventListener("click", () => {
      updateFormContainer.style.display = "none";
    });
  </script>

<?php
  include('../includes/bar-chart.php');
?>
</body>
</html>