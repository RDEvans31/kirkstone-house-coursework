<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php include_once("../connection.php"); ?>
<script>
  $(function() {
    $("#navigation").load("adminformsnavbar.php");
    });
</script>
<div id="navigation"></div>
<div class="jumbotron text-center">
  <h3>Add a User:</h3>
  <form action="..\scripts\adduserscript.php" method="post">
    <!--This is for adding a new user to tbluser -->
    First name:<input type="text" name="firstname"><br>
    Surname: <input type="text" name="surname"><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    Privilege:<input type="radio" name="privilege" value=0>Admin<input type="radio" name="privilege" value=1>Teacher<input type="radio" name="privilege" value=2>Head<br>
    <input class="btn" type="Submit" value="Add">
  </form>
</div>
</body>
</html>
