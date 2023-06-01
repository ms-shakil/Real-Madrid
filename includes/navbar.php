<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .navbar{
      height:60px;
      background: grey !important;
    }
    #collapsibleNavbar{
      justify-content: space-between;
    }
    .dropdown-menu{
      z-index: 100 !important;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/dbms%20project/Home.php">FCMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/dbms%20project/Home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/dbms%20project/About.php">ABOUT</a>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PAGES</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="http://localhost/dbms%20project/pages/PlayerList.php">Player list</a></li>
            <li><a class="dropdown-item" href="#">Coach list</a></li>
            <li><a class="dropdown-item" href="#">Management list</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item dropdown order-last">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">ACCOUNT</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">settings</a></li>
            <li><a class="dropdown-item" href="#">LOGOUT</a></li> 
          </ul>
        </li>
      </ul>
    </div>
    
  </div>
</nav>


</body>
</html>