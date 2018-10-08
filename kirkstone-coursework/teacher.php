<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
        function showPupilsinset(setid){
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
  </style>
</head>
<body>
<?php
include_once("connection.php");
session_start();
?>
<nav class="navabar">
<div class="container-fluid">

 <div class="navbar-header"><a class="navbar-brand" href="http://www.kirkstonehouseschool.co.uk/">KHS</a></div>


</nav>
<div class="jumbotron text-center">
  <h1>Welcome</h1>
<div id="tutorgroup"><!--this will display the tutor group of the teacher that has logged in-->
  <?php
  $userid=$_SESSION["userid"];
  $pupilids=array();
  $stmt=$conn->prepare("SELECT * FROM tbltutorgroup WHERE Userid='$userid'");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $tutorgroup=$row["Tutorgroupid"];
  }
  $stmt=$conn->prepare("SELECT * FROM tbltutorpupil WHERE Tutorgroupid='$tutorgroup'");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row["Tutorgroupidid"]=$tutorgroup) {
      array_push($pupilids,$row["Pupilid"]);
    }
  }
  echo("Tutorgroup: ".$tutorgroup);
  echo "<ul>";
  foreach ($pupilids as $x) {
    $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo ("<li>".$row["Firstname"].' '.$row["Surname"]."</li>");
      }
  }
  echo "</ul>"
  ?>
</div>
<div name="showsetstaught">
  <?php
    $setstaught=array();
    $stmt=$conn->prepare("SELECT Setid FROM tblset WHERE Userid='$userid'"); //returns sets taught by teacher that logged in
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($setstaught,$row["Setid"]); //adds the set id to an array of sets taught
    }
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
<div name="entergrades">
<form action="entergradesscript.php">
  Set:<select onchange="showPupilsinset(this.value)">
  <option value="">Select a subject</option>
  <?php
  $stmt=$conn->prepare("SELECT Setid FROM tblset WHERE Userid='$userid'"); //returns sets taught by teacher that logged in
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo("<option value=".$row["Setid"].">".$row["Setid"]."</option>");
  }
  ?>
</select><br>
  Pupil: <select id="selectpupil" name="pupilid">
  </select><br>
  Term:<select name="term">
    <option value="Aut1">Autumn 1</option>
    <option value="Aut2">Autumn 2</option>
    <option value="Spr">Spring</option>
    <option value="Sum">Summer</option>
  </select><br>
  Effort:<input type="text"><br>
  Achieve:<input type="text"><br>
  <input type="Submit" value="Assign">
</form>
</div>

</div>
</body>
</html>
