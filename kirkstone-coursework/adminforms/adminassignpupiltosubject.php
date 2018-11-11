<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
        function showSets(id){
          var xhttp;
          if (id == "") {
            document.getElementById("selectset").innerHTML = "<option value=''> No subject selected</option>";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("selectset").innerHTML = this.responseText;//finds the html element with id "selectset" changes the contents of that element accordingly.
            }
          };
          xhttp.open("GET", "../ajaxgetsetsforsubject.php?subjectid="+id, true);
          xhttp.send();
        }
  </script>
</head>
<body>
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
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
      <li class="nav-item">
        <a class="nav-link" href="..\logoutscript.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<div class="jumbotron text-center">
  <h3>Assign a pupil to a subject</h3>
  <form action="..\scripts\pupilsubjectscript.php" method="post">

    Pupil:<select name="pupilid">
      <option value="">Select a pupil</option>
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
    Subject:<select name="subjectidpupil" onchange="showSets(this.value)">
      <option value="">Select a subject</option>
      <?php
      $stmt=$conn->prepare("SELECT * FROM tblsubject");
      $stmt->execute(); //this selects all record in tblsubject
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        echo('<option value='.$row["Subjectid"].'>'.$row["Subjectname"].'</option>');//this prints them as options
      }
      ?>
    </select><br>
    Set:<select id="selectset" name="setidpupil"></select>
  </br>
    <input class="btn" type="Submit" value="Assign">
</form>
