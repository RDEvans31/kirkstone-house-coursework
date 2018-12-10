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
        <li class="nav-item">
          <a class="nav-link" href="teacheraddcmdd.php">Pupil awards<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pupil performance
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="teacherentergrades.php">Enter grades</a>
            <a class="dropdown-item" href="teachersubjectreports.php">Subject reports</a>
            <a class="dropdown-item" href="teachertutorreports.php">Enter Tutor Report</a>
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
<div id="tutorgroup" class="panel-group"><!--this will display the tutor group of the teacher that has logged in-->
  <?php
  $pupilidsintutorgroup=array();
  $stmt=$conn->prepare("SELECT * FROM tbltutorgroup WHERE Userid='$userid'");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $tutorgroup=$row["Tutorgroupid"];
  $stmt=$conn->prepare("SELECT * FROM tbltutorpupil WHERE Tutorgroupid='$tutorgroup'");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row["Tutorgroupidid"]=$tutorgroup) {
      array_push($pupilidsintutorgroup,$row["Pupilid"]);
    }
  }
  $_SESSION["tutorgroup"]=$tutorgroup;
  $_SESSION["tutorgrouppupils"]=$pupilidsintutorgroup;
  echo('Tutorgroup:'.$tutorgroup);
  ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      $stmt=$conn->prepare("SELECT * FROM tblusers");//this selects all sets that are associated with the subject selected.
      $stmt->execute();
      foreach ($pupilidsintutorgroup as $x) {
        $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo('<li>'.$row["Firstname"].' '.$row["Surname"].'</li>');
          }
      }
      ?>
    </div>
</div>
</div>
<div id="showsetstaught">
  <?php
    $setstaught=array();
    $stmt=$conn->prepare("SELECT Setid FROM tblset WHERE Userid='$userid'"); //returns sets taught by teacher that logged in
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($setstaught,$row["Setid"]); //adds the set id to an array of sets taught
    }
    $_SESSION["sets"]=$setstaught;
    foreach ($setstaught as $x) { //loops through each set taught by teacher
      echo("Set: ".$x);
      $pupilsinset=array(); // initialise here because needs to be cleared and re-initiated at the end of this loop.
      $stmt=$conn->prepare("SELECT Pupilid FROM tblpupilstudies WHERE Setid='$x'"); //fetches all the pupil id's in the set
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($pupilsinset,$row["Pupilid"]); //adds the pupil id's of pupils in the set to an array
      }
      foreach ($pupilsinset as $y) {
        $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$y'"); //loops through the pupils in the set, fetches their name.
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo ("<li>".$row["Firstname"].' '.$row["Surname"]."</li>"); //prints name as list item.
        }
       //clears all the students in this set from array so that it can be repopulated with studetns from the next set.
       unset($pupilsinset);
      }
    }
  ?>
<div id="tutorreport">
  <form name="tutorreportform" action="tutorreportscript.php" method="post">
    Pupil:<select name="pupilidreport">
      <option value="null">Select a tutee</option>
      <<?php
       //produces list of pupils within tutor group
       //makes use of the varibales in tutorgroup div
       $pupilidsintutorgroup=$_SESSION["tutorgroup"];
       foreach ($pupilidsintutorgroup as $x) {
         $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
         $stmt->execute();
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo ("<option value=".$x.">".$row["Firstname"].' '.$row["Surname"]."</option>");
           }
       }
      ?>
    </select><br>
    Tutor Comments:<input type="text" name="tutorcomments"><br>
    <input type="Submit" value="Enter">
  </form>
</div>

</body>
</html>
