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
  <h3>Add a Pupil:</h3>
<form action="..\scripts\addpupilscript.php" method="post">
  <!-- this is for adding a new pupil to tblpupil-->
  First name:<input type="text" name="pupilfirstname"><br>
  Surname: <input type="text" name="pupilsurname"><br>
  Year: <input type="number" name="yeargroup"><br>
  Date of Birth: <input type="date" name='dob'><br>
  <p>Please enter their Midyis scores below:</p>
  Vocabulary:<input type="text" name="MVocab"><br>
  Mathematics:<input type="text" name="MMath"><br>
  Non-Verbal:<input type="text" name="MNonVerbal"><br>
  Skills:<input type="text" name="MSkills"><br>
  Score:<input type="text" name="MScore"><br>
  <input class="btn" type="submit" value="Add"><br>
</form>
</div>
</body>
</html>
