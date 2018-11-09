<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connect to bootstrap through a cdn-->
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
        <a class="nav-link" href="admin.php">Admin <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Subjects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminforms\adminaddsubject.php">Add</a>
          <a class="dropdown-item" href="adminforms\adminassignteachertosubject.php">Assign teacher</a>
          <a class="dropdown-item" href="adminforms\adminassignpupiltosubject.php">Assign pupil</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminforms\adminadduser.php">Add</a>
          <a class="dropdown-item" href="adminforms\admincreatetutorgroup.php">Create a tutor group</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pupils
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminforms\adminaddpupil.php">Add</a>
          <a class="dropdown-item" href="adminforms\adminassignpupiltotutorgroup.php">Assign to tutor group</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="jumbotron text-center">
  <h2>Admin</h2>
<!--these divs simply seperate the forms-->
    <div id="teachersubject" class="">
      <form action="teachersubjectscript.php" method="post">
        <!--this essentially assigns a teacher to a subject using the userid and subjectid keys-->
        Teacher:<select name="userid">
          <option value="null">Select a teacher</option>
          <?php
          $stmt=$conn->prepare("SELECT * FROM tblusers WHERE privilege=1");
          $stmt->execute(); //this selects all record in tblusers that have privilege 1, meaning they are a teacher
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            echo('<option value='.$row["Userid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
          }
          ?>
        </select><br>
        <br>
        Subject:<select name="subjectid">
          <option value="null">Select a subject</option>
          <?php
          $stmt=$conn->prepare("SELECT * FROM tblsubject");
          $stmt->execute(); //this selects all record in tblsubject
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            echo('<option value='.$row["Subjectid"].'>'.$row["Subjectname"].'</option>');//this prints them as options
          }
          ?>
        </select><br>
        <br>
        Set name:<input type="text" name="setid"><br>
        <input class="btn" type="Submit" value="Assign">
      </form>
    </div>

    <div id="pupilsubject" class="">
      <form action="pupilsubjectscript.php" method="post">

        Pupil:<select name="pupilid">
          <option value="null">Select a pupil</option>
          <?php
          $stmt=$conn->prepare("SELECT * FROM tblpupil");
          $stmt->execute(); //this selects all record in tblpupil

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            echo('<option value='.$row["Pupilid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
          }
          ?>
        </select><br>
        <br>
        Subject:<select name="subjectid">
          <option value="null">Select a subject</option>
          <?php
          $stmt=$conn->prepare("SELECT * FROM tblsubject");
          $stmt->execute(); //this selects all record in tblsubject
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            echo('<option value='.$row["Subjectid"].'>'.$row["Subjectname"].'</option>');//this prints them as options
          }
          ?>
        </select><br>
        <br>
        Set name:<input type="text" name="setid"><br>
        <input class="btn" type="Submit" value="Assign">
    </form>
    </div>
  </div>
  <br>
  <div id="userforms" class="row form-table">
    <div id="addinguser" class="">
    <form action="adduserscript.php" method="post">
      <!--This is for adding a new user to tbluser -->
      First name:<input type="text" name="firstname"><br>
      Surname: <input type="text" name="surname"><br>
      Username: <input type="text" name="username"><br>
      Password: <input type="password" name="password"><br>
      Privilege:<input type="radio" name="privilege" value=0>Admin<input type="radio" name="privilege" value=1>Teacher<input type="radio" name="privilege" value=2>Head<br>
      <input class="btn" type="Submit" value="Add">
    </form>
    </div>
  </div>
  <br>
  <div id="pupilforms" class="row form-table">
    <div id="addingpupil" class="">
    <form action="addpupilscript.php" method="post">
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
  </div>
  <br>
  <div id="tutorgroupforms" class="row form-table">
    <div id="tutorgroup" class="row">
      <form id=createtutorgroup action="createtutorgroup.php" method="post"> <!--this allows the admin to input a tutor group id and select a teacher in charge of the tutor group-->
        Tutorgroup:<input type="text" name="tutorgroupid"><br>
        Tutor:<select name="userid">
            <option value="null">Select a teacher</option>
            <?php
            $stmt=$conn->prepare("SELECT * FROM tblusers WHERE Privilege=1");
            $stmt->execute(); //this selects all records in tbluser
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              echo('<option value='.$row["Userid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this allows the admin to select a teacher
            }
            ?>
          </select><br>
        <input type="Submit" value="Create"><br>
      </form>
    </div>
    <form id=pupiltutorgroup action="addpupiltotutorgroup.php" method="post">
      Tutorgroup:
      <select name="tutorgroupid">
        <option value="null">Select a tutor group</option>
        <?php
        $stmt=$conn->prepare("SELECT * FROM tbltutorgroup");
        $stmt->execute(); //this selects all record in tbltutorgroup
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo('<option value='.$row["Tutorgroupid"].'>'.$row["Tutorgroupid"].'</option>');//this prints them as options
        }
        ?>
      </select><br>
      Pupil:<select name="pupilid">
        <option value="null">Select a pupil</option>
        <?php
        $stmt=$conn->prepare("SELECT * FROM tblpupil");
        $stmt->execute(); //this selects all record in tblpupil
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo('<option value='.$row["Pupilid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
        }
        ?>
      </select><br>
      <button type="submit" class="btn btn-default">Assign</button>
    </form>
  </div>
</div>
</body>
</html>
