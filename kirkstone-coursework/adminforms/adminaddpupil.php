<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  select {color:#000;}
  input {color:#000;}
  </style>
</head>
<body>
<?php include_once("connection.php"); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">KHS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="..\admin.php">Admin <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Subjects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminaddsubject.php">Add</a>
          <a class="dropdown-item" href="adminassignteachertosubject.php">Assign teacher</a>
          <a class="dropdown-item" href="adminassignpupiltosubject.php">Assign pupil</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminadduser.php">Add</a>
          <a class="dropdown-item" href="admincreatetutorgroup.php">Create a tutor group</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pupils
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminaddpupil.php">Add</a>
          <a class="dropdown-item" href="adminassignpupiltotutorgroup.php">Assign to tutor group</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="jumbotron text-center">
  <h3>Add a Pupil:</h3>
<form action="..\scripts\addpupilscript.php" method="post">
  <!-- this is for adding a new pupil to tblpupil-->
  First name:<input type="text" name="pupilfirstname"><br>
  Surname: <input type="text" name="pupilsurname"><br>
  Year: <input type="number" name="yeargroup"><br>
  Tutor group:<input type="text" name="tutorgroup"><br>
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
