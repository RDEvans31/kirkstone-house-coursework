<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
        function showPupilsinset(setid){//shows pupils in the selected set
          var xhttp;
          if (setid == "") {
            document.getElementById("selectpupil").innerHTML = "<option value=''> No pupil selected</option>";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("selectpupil").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "ajaxpupilsinset.php?setid="+setid, true);
          xhttp.send();
        }
  </script>
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  select {color:#000;}
  input {color:#000;}
  </style>
  <?php
  include_once("connection.php");
  session_start();
  $userid=$_SESSION["userid"];
  $pupilidsintutorgroup=$_SESSION["tutorgroup"];
  ?>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">KHS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="teacher.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pupil performance
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="teacherentergrades.php">Enter grades</a>
            <a class="dropdown-item" href="teachersubjectreports.php">Subject reports</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            View grades
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="teacherviewtuteegrades.php">Tutee</a>
            <a class="dropdown-item" href="teacherviewsetgrades.php">Sets</a>
          </div>
        </li>
        </li>
          <a class="nav-link" href="logoutscript.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
<div class="jumbotron text-center">
  <h3>Welcome</h3>
<div id="tutorgroupgrades"><!--this will display the grades of each tutee-->
  <?php

  foreach ($pupilidsintutorgroup as $x) {
    $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $name=$row["Firstname"].' '.$row["Surname"];//this gets the name of the pupil that we will output the grades for
      }
    echo(
  "Pupil: ".$name.
  '<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Subject</th>
      <th scope="col">Target</th>
      <th scope="col">Aut1A</th>
      <th scope="col">Aut1E</th>
      <th scope="col">Aut2A</th>
      <th scope="col">Aut2E</th>
      <th scope="col">Spr1A</th>
      <th scope="col">Spr1E</th>
      <th scope="col">Spr2A</th>
      <th scope="col">Spr2E</th>
      <th scope="col">Sum1A</th>
      <th scope="col">Sum1E</th>
      <th scope="col">Sum2A</th>
      <th scope="col">Sum2E</th>
      <th scope="col">Merits</th>
      <th scope="col">Commendations</th>
      <th scope="col">Debits</th>
      <th scope="col">Detentions</th>

    </tr>
  </thead>
  <tbody>
    ');
    $stmt=$conn->prepare("SELECT * FROM tblpupilstudies WHERE Pupilid='$x'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // for each of these records, I will print out the data but also get the subjectname based on the subject id of the record
        $subjectid=$row["Subjectid"];
        $getsubjectname=$conn->prepare("SELECT Subjectname FROM tblsubject WHERE Subjectid='$subjectid'");
        $getsubjectname->execute();
        while ($row2 = $getsubjectname->fetch(PDO::FETCH_ASSOC)) {
            $subjectname=$row2["Subjectname"];//this stores the subjectname of the subject we are dealing with in this row of the table.
          }
      echo('
      <tr>
        <th scope="row">'.$subjectname.'</th>
        <td>'.$row["Target"].'</td>
        <td>'.$row["Aut1A"].'</td>
        <td>'.$row["Aut1E"].'</td>
        <td>'.$row["Aut2A"].'</td>
        <td>'.$row["Aut2E"].'</td>
        <td>'.$row["Spr1A"].'</td>
        <td>'.$row["Spr1E"].'</td>
        <td>'.$row["Spr2A"].'</td>
        <td>'.$row["Spr2E"].'</td>
        <td>'.$row["Sum1A"].'</td>
        <td>'.$row["Sum1E"].'</td>
        <td>'.$row["Sum2A"].'</td>
        <td>'.$row["Sum2E"].'</td>
        <td>'.$row["Merits"].'</td>
        <td>'.$row["Commendations"].'</td>
        <td>'.$row["Debits"].'</td>
        <td>'.$row["Detentions"].'</td>

      </tr>
    ');
      }
  echo("
  </tbody>
  ");
  }
  ?>
</div>
</body>
</html>
