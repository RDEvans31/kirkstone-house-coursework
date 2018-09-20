<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  </style>
</head>
<body>
<?php
 include_once("connection.php");

?>
<nav class="navabar">
<div class="container-fluid">

 <div class="navbar-header"><a class="navbar-brand" href="http://www.kirkstonehouseschool.co.uk/">KHS</a></div>


</nav>
<div class="jumbotron">
  <form id="loginform" action="loginscript.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" placeholder="Enter username">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" placeholder="Enter password">
      </div>
      <button type="submit" class="btn btn-default">Login</button>
  </form>
</div>
</body>
</html>
