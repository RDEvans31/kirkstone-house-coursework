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
  select {color:#000;}
  input {color:#000;}
  </style>
</head>
<body>
<?php include_once("connection.php"); ?>
<nav class="navbar">
<div class="container-fluid">

 <div class="navbar-header"><a class="navbar-brand" href="http://www.kirkstonehouseschool.co.uk/">KHS</a></div>

<ul class="nav navbar-nav">
  <li class="dropdown"><a class="dropdown-toggle" id="subjectsDropdown" role="button" data-toggle="dropdown">Subjects</a><!--this is the dropdown menu title-->
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#addingsubject" data-parent="#subjectforms">Add</a></li>
      <li><a class="nav-link" data-toggle="collapse" data-target="#teachersubject" data-parent="#subjectforms">Assign teacher</a></li>
      <li><a class="nav-link" data-toggle="collapse" data-target="#pupilsubject" data-parent="#subjectforms">Assign pupil</a></li>
    </ul>
  </li>
  <li class="dropdown"><a class="dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown">Users</a>
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#addinguser">Add</a></li>
    </ul>
  </li>
  <li class="dropdown"><a class="dropdown-toggle" id="pupilDropdown" role="button" data-toggle="dropdown">Pupil</a>
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#addingpupil">Add</a></li>
    </ul>
  </li>
  <li class="dropdown"><a class="dropdown-toggle" id="tutorDropdown" role="button" data-toggle="dropdown">Tutor Groups</a>
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#tutorgroup">Assign</a></li>
    </ul>
  </li>
</ul>

</div>
</nav>
<div class="jumbotron text-center">
  <h1>Welcome *insert user in here*</h1>
<!--these divs simply seperate the forms-->
  <div id="subjectforms" class="row">
    <div id="addingsubject">
      <form action="addsubjectscript.php" method="post">
        <!--This form is for adding a new subject to tblsubject, it sends the these variables to addsubjectscript.php-->
        Subject:<input type="text" name="subjectname"><br>
        Content:<input type="text" name="subjectcontents"><br>
        <input class="btn" type="Submit" value="Add">
      </form>
    </div>

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
      Privilege:<input type="radio" name="privilege" value=0>Admin<input type="radio" name="privilege" value=1>Teacher<br>
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
  </div>
</div>
</body>
</html>
