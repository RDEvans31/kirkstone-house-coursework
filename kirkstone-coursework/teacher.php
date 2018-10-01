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
</div>
</body>
</html>
